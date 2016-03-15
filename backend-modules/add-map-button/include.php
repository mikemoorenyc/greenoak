<?php

function add_map_button() {
  global $post;
  if($post->post_type !== 'portfolio') {
    return;
  }
  ?>
  <button href="#" id="add-a-map" class="button" type="button">Add a map</button>
  <?php
}

add_action('media_buttons', 'add_map_button');

?>
