<?php
add_theme_support( 'menus' );

//$siteDir = '/wp-content/themes/w25th-build';
add_post_type_support('page', 'excerpt');


// Custom functions

// Tidy up the <head> a little. Full reference of things you can show/remove is here: http://rjpargeter.com/2009/09/removing-wordpress-wp_head-elements/
remove_action('wp_head', 'wp_generator');// Removes the WordPress version as a layer of simple security

add_theme_support('post-thumbnails');




add_action( 'admin_init', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {
    add_editor_style( 'css/editor-styles.css' );
}

// DIRECTORY REPLACER

function dirReplacer($string) {
  global $siteDir;
  $time = time();
  $newString = str_replace('***REPLACEWITHTHEMEDIRECTORY***', $siteDir, $string);
  $newString = str_replace('***TIMESTAMP***', $time ,$newString);
  echo $newString;
}
//CONTENT CLEANER
function content_cleaner($content) {

    // Remove inline styling
    $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);

    // Remove font tag
    $content = preg_replace('/<font[^>]+>/', '', $content);

    // Remove empty tags
    $post_cleaners = array('<p></p>' => '', '<p> </p>' => '', '<p>&nbsp;</p>' => '', '<span></span>' => '', '<span> </span>' => '', '<span>&nbsp;</span>' => '', '<span>' => '', '</span>' => '', '<font>' => '', '</font>' => '');
    $content = strtr($content, $post_cleaners);

    return $content;
}
// add_filter('the_content', 'content_cleaner',20);


//HOOK IN CUSTOM POST TYPES
include 'backend-modules/custom-post-types/properties-post.php';

include 'backend-modules/custom-post-types/team.php';
include 'backend-modules/custom-post-types/contacts.php';
//LOCATION META BOX
include 'backend-modules/location-meta-box/main-include.php';

//REMOVE ADD MEDIA BUTTON
include 'backend-modules/remove-add-media-button/remove-add-media-button.php';

//ADD MAP BUTTON
include 'backend-modules/add-map-button/include.php';
//ADD VIDEO BUTTON
include 'backend-modules/add-video-button/include.php';

//MAP COMPONENT
include 'backend-modules/map-component/entry-point.php';

//RENAME NEWS
include 'backend-modules/rename-news.php';

//POST TYPE SWITCHER
include 'backend-modules/post-type-switcher/include.php';
//SUPER ADMIN
include 'backend-modules/super-admin.php';


?>
