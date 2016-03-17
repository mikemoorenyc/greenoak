<?php
add_theme_support( 'post-formats', array( 'link') );

function add_admin_scripts( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'post' === $post->post_type ) {
            wp_enqueue_script(  'editscript', get_stylesheet_directory_uri().'/backend-stuff/edit-post-scripts.js' );
		}
    }
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>';
  include 'backend-stuff/backend-css.css';
  echo '</style>';
}

add_filter('query_vars', 'add_my_var');

function add_my_var($public_query_vars) {
	$public_query_vars[] = 'newsid';
	return $public_query_vars;
}

add_action('admin_head', 'userhide');
function userhide() {
  ?>
<style>
#wpfooter {
  display: none !important;

}
</style>
  <?php
  global $current_user;
      get_currentuserinfo();
      $useremail = ($current_user->user_email );
      if(strpos($useremail,'realestatearts.com')=== false) {
        ?>
        <!-- HIDE EVERYTHING -->
        <style>
         #wp-admin-bar-wp-logo, #wp-admin-bar-comments, #wp-admin-bar-new-content, #adminmenu > li, #welcome-panel, #dashboard-widgets-wrap {
          display: none !important;
        }
        #adminmenu > li#toplevel_page_ninja-forms {
          display:block !important;
        }
        #adminmenu > li {
        	display:none;
        }
         #adminmenu > li#menu-posts, #adminmenu > li#collapse-menu, #adminmenu > li#menu-dashboard {
         	display:block !important;
         }
         #adminmenu li#menu-dashboard .wp-submenu {
         	display:none !important;
         }
         #wp-admin-bar-user-actions li {
         	display:none;
         }
         #wp-admin-bar-user-actions li#wp-admin-bar-logout {
         	display:block;
         }


        </style>

        <?php
      }
}

/*
#post-attachment.deactivated, #postdivrich.deactivated  {
	opacity: .05;
	pointer-events:none;
}
#post-attachment.deactivated *, #postdivrich.deactivated * {
	pointer-events:none;
}
*/

/*
jQuery(document).ready(function( $ ) {
$(window).load(function(){
     $('#post-formats-select input:radio[name="post_format"]').each(function(){
         if($(this).attr('checked') == 'checked') {
          postType = $(this).attr('value');
         }
     });
    console.log(postType);
    if (postType == 'link') {
        formEval();
        $("#postdivrich").addClass('deactivated');
    } else {
        $("#post-attachment").addClass('deactivated');
    }


   console.log('connected with jquery');
   $('#post-formats-select input:radio[name="post_format"]').change(function(){
      postType = $(this).val();
      if($(this).val() == 'link') {
          linkSwapper('link');

      } else {
          linkSwapper('post');
      }
   });

   setInterval(function(){
      formEval();
   },1000)



   function linkSwapper(state) {
        if(state=='post') {
            $("#post-attachment").addClass('deactivated');
            $("#postdivrich").removeClass('deactivated');
            $('#publishing-action input').removeAttr('disabled');
        }
        if(state == 'link') {
           $("#post-attachment").removeClass('deactivated');
            $("#postdivrich").addClass('deactivated');
            formEval();
        }
    }

    function formEval() {
        $attachment = $('#post-attachment input#attachmentfile').attr('value');
        $type = $('#post-attachment input#file-type').attr('value');
        //console.log($type);
        //console.log($attachment);
        if(postType == 'link') {
           if($type =='' || $attachment == '') {
                $('#publishing-action input').attr('disabled','');
            } else {
                $('#publishing-action input').removeAttr('disabled');
            }
        }

    }
});



});



*/
