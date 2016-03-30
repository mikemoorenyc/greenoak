<div class="clock-thing" data-diff="-4">
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
  NYC
</div>

<div class="clock-thing" data-diff="9">
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
  TOKYO
</div>

<div class="clock-thing" data-diff="-7">
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
  LA
</div>


<?php global $siteDir; global $homeURL;?>

  <script id="inline-scripts"><?php $inlinejs = file_get_contents($siteDir.'/js/inline-load.js'); dirReplacer($inlinejs);?></script>
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script  src="<?php echo $siteDir;?>/js/main.js?v=<?php echo time();?>"></script>


  </body>
</html>
