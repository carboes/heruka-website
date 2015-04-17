<!-- TODO: Make sure post type is meditation-class for menu to work -->
<?php
$post_id = url_to_postid( $_SERVER['REQUEST_URI'] );

//$post_id = get_the_ID();
$post_region = get_post_meta($post_id, 'wpcf-region', true); ?>
<div class="class-location <?php echo $accordion ? 'accordion' : ''; ?>">

  <?php if( $map AND $map == '1' AND get_post($post_id)->post_type != "event") {
    echo "<section class='map'>";
    echo do_shortcode('[googlemapsmashup query="post_type=meditation-class&amp;nopaging=true"]');
    echo "</section>";
  } ?>

  <?php
    $days=array("Central","North","Herts");
    foreach ($days as $value) {
    $current_region = ($post_region == $value); ?>
    
    <section>
      <h5 class="<?php echo $current_region ? 'active' : ''; ?>">
        <?php
          echo $value == "Central" ? "Central London <em>(Zone 1)</em>" : "";
          echo $value == "North" ? "North & West London <em>(Zone 2-6)</em>" : "";
          echo $value == "Herts" ? "Hertfordshire" : "" ?>
      </h5>
      
      <ul class="<?php echo $current_region ? 'current-region' : ''; ?>">
        
        <?php
          $query = new WP_Query( array( 'post_type' => 'meditation-class', 'meta_key' => 'wpcf-region', 'meta_value' => $value, 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => '100', ) );
          $branches = $query->get_posts();
          foreach ($branches as $branch) {
            $current_post = ($post_id == $branch->ID);
            $parent_id = wpcf_pr_post_get_belongs($branch->ID, 'meditation-class');
            if (get_post_meta($branch->ID, 'wpcf-hidden', true) != 1) {  
              $childargs = array(
                'post_type' => 'gp-class',
                'numberposts' => -1,
                'meta_key' => 'wpcf-day',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(array('key' => '_wpcf_belongs_meditation-class_id', 'value' => $branch->ID))
              );
              $classes = get_posts($childargs);
              if (get_post_meta($branch->ID, 'wpcf-closed', true) == 1) {
                ?>
                  
                  <li class="<?php echo $current_post ? 'current-post' : ''; ?>">
                    <a href="<?php echo get_permalink($branch->ID); ?>"><?php echo get_the_title($branch->ID); ?></a> - closed
                  </li>

                <?php 
              } else { ?>
                <li class="<?php echo $current_post ? 'current-post' : ''; echo $closed ? 'closed' : ' '; ?>">
                  <a href="<?php echo get_permalink($branch->ID); ?>"><?php echo get_the_title($branch->ID);?></a>
                  
                  <?php
                    $pieces = array();
                    foreach ($classes as $class) {
                      if (get_post_meta($class->ID, 'wpcf-non-gp', true) != 1 && get_post_meta($class->ID, 'wpcf-closed', true) != 1) {
                        $daytime = do_shortcode("[types id='".$class->ID."' field='daytime']");
                        $day = do_shortcode("[types id='".$class->ID."' field='day']");
                        array_push($pieces, substr($day, 0, 3) . $daytime);
                      }
                    }
                    echo implode( "/", $pieces );
                  ?>

                </li>

            <?php }
            }
          } ?>

      </ul>
    </section>

  <?php
  } ?>

</div>

<?php
  if ($accordion) {
    echo do_shortcode("[types field='sidebar-content' output='html']");
  }
?>