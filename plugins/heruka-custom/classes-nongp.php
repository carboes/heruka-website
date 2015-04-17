<?php
  $post_id = url_to_postid( $_SERVER['REQUEST_URI'] );

  $non_gp_classes = get_posts(
    array(
      'post_type' => 'gp-class',
      'numberposts' => -1,
      'meta_query' => array(
        array('key' => '_wpcf_belongs_meditation-class_id', 'value' => $post_id),
        array('key' => 'wpcf-non-gp', 'value' => true)
      ),
      //'meta_key'=>'wpcf-order-num-class',
      //'orderby'=>'meta_value',
      'order'=>'ASC'
    )
  );
  if (!empty($non_gp_classes)) { ?>
    <br/>
    <br/>
    <hr/>
    <p><?php echo get_the_title().' also offers the following in-depth study programmes:' ?></p>
    <ul><?php 
      foreach ($non_gp_classes as $class) {
        $time = get_post_meta($class->ID, "wpcf-time", true);

        if ($time != 'NA') {
          $linkname = get_post_meta($class->ID, "wpcf-sidebar-link-name", true);
          if (empty($linkname)) {
            $linkname = get_post_meta($class->ID, "wpcf-link-name", true);
          }
          $linkurl = get_post_meta($class->ID, "wpcf-link-url", true);
          
          $day = explode("_", get_post_meta($class->ID, "wpcf-day", true));
          $title = $day[1];
        
          $title .= get_post_meta($class->ID, "wpcf-daytime", true) ? " daytime " : " evening ";
          $title .= $time;
        
          echo '<li><a href="'.$linkurl.'">'.$linkname.'</a> '.$title.'</li>';
        }
      }
    ?></ul>
<?php } ?>