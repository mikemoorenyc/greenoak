<?php
function post_types_init() {

//PROPERTY
$propargs = array(
  'label' => 'Portfolio',
  'public' => true,
  'labels' => array(
    'add_new_item' => 'Add New Property'
  ),
  'show_ui' => true,
  'capability_type' => 'page',
  'hierarchical' => true,
  'has_archive' => false,
  'rewrite' => array('slug' => 'portfolio'),
  'query_var' => true,
//  'menu_icon' => get_bloginfo('template_url').'/assets/imgs/post-property.png',
  'supports' => array(
      'title',
      'revisions',
      'thumbnail'
    )
  );
register_post_type( 'portfolio', $propargs );



}

add_action( 'init', 'post_types_init' );
?>
