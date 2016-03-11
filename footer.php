<div class="clock-thing">
  <article class="clock">
    <div class="hours-container">
      <div class="hours"></div>
    </div>
    <div class="minutes-container">
      <div class="minutes"></div>
    </div>
    <div class="seconds-container">
      <div class="seconds"></div>
    </div>
  </article>

</div>


<?php global $siteDir; global $homeURL;?>

  <script id="inline-scripts"><?php $inlinejs = file_get_contents($siteDir.'/js/inline-load.js'); dirReplacer($inlinejs);?></script>
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script  src="<?php echo $siteDir;?>/js/main.js?v=<?php echo time();?>"></script>


  </body>
</html>
