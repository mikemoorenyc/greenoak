<?php

function add_video_button() {
  global $post;
  if($post->post_type !== 'portfolio') {
    return;
  }
  ?>
  <button href="#" id="add-a-video" class="button" type="button">Add a video</button>
  <?php
}

add_action('media_buttons', 'add_video_button');

?>
