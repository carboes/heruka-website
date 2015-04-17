<div class="class-weekday">
<?php
$days=array("1_Monday","2_Tuesday","3_Wednesday","4_Thursday","5_Friday","6_Saturday","7_Sunday");

$query = new WP_Query( array(
  'post_type' => 'meditation-class',
  'nopaging'=> true,
  'orderby' => array( 'title' => 'ASC' )
  ) );
$branches = array();
$branches1 = $query->get_posts();
$branches = array_merge(
  array_filter($branches1, function($branch) { return get_post_meta($branch->ID, "wpcf-centre", true) == 1; }),
  array_filter($branches1, function($branch) { return get_post_meta($branch->ID, "wpcf-centre", true) != 1; })
);


foreach ($days as $value) {
  $day = explode("_",$value);
?>

  <section class="day-<?php echo $day[1]; ?>">
    <h5><?php  echo $day[1]; ?></h5>
    <ul>

    <?php
      foreach ($branches as $branch) {
        $parent_id = $branch->ID;//wpcf_pr_post_get_belongs($post->ID, 'meditation-class');
        
        if (get_post_meta($branch->ID, 'wpcf-hidden', true) != 1) {
          $classes = get_posts(
            array(
              'post_type' => 'gp-class',
              'numberposts' => -1,
              'meta_key' => 'wpcf-time',
              'orderby'  => 'meta_value',
              'order' => 'ASC',
              'meta_query' => array(
                array(
                  'key' => '_wpcf_belongs_meditation-class_id',
                  'value' => $parent_id
                ),
                array(
                  'key' => 'wpcf-day',
                  'value' => $value
                )
              )
            )
          );

          $centre1 = get_post_meta($branch->ID, "wpcf-centre", true);
          foreach ($classes as $class) {
            $closed = get_post_meta($class->ID, 'wpcf-closed', true);
            $nongp = get_post_meta($class->ID, 'wpcf-non-gp', true);
            ?>

            <li class="<?php echo ($closed ? 'closed' : '').($nongp ? ' non-gp' : '').($centre1 ? ' centre' : ''); ?>">
              <?php
                $linkname = get_post_meta($class->ID, "wpcf-link-name", true);
                $linkurl = get_post_meta($class->ID, "wpcf-link-url", true);
                $query = "?target=".do_shortcode("[types field='day' id='".$class->ID."']s [types field='time' id='".$class->ID."']");
              ?>
              
              <a href="<?php echo empty($linkurl) ? get_permalink($branch->ID).$query : $linkurl; ?>">
                
                <?php
                  if (!empty($linkname)) {
                    echo $linkname;
                  } else { 
                    echo get_the_title($parent_id);
                  }
                  echo do_shortcode("[types id='".$class->ID."' field='daytime']");
                ?></a>
              
              <?php
                $time = do_shortcode("[types id='".$class->ID."' field='time']");
                if ($time != 'NA') {
                  $array2 = explode("-", $time);
                  echo $array2[0];
                  if (!strpos($array2[0],'m')) {
                    echo substr($time, -2); ;
                  }
                }
                echo $closed ? " - closed" : "";
              ?>

              </li>
        
        <?php } }
      }/*endwhile;*/ ?>

    </ul>
  </section>

<?php } ?>
  <div class="fp-note"><?php echo $note; ?></div> 
</div>