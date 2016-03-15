<?php
function post_types_init() {

//PROPERTY
$propargs = array(
  'label' => 'Portfolio',
  'public' => true,
  'labels' => array(
    'add_new_item' => 'Add New Property',
    'name' => 'Portfolio',
    'edit_item' => 'Edit Property',
    'search_items' => 'Search Portfolio',
    'not_found' => 'No properties found.',
    'all_items' => 'All Properties'
  ),
  'show_ui' => true,
  'capability_type' => 'page',
  'hierarchical' => true,
  'has_archive' => false,
  'rewrite' => array('slug' => 'portfolio'),
  'query_var' => true,
  'menu_icon' => get_bloginfo('template_url').'/assets/imgs/icon-portfolio.png',
  'supports' => array(
      'title',
      'revisions',
      'thumbnail',
      'editor'
    )
  );
register_post_type( 'portfolio', $propargs );



}

add_action( 'init', 'post_types_init' );
?>
