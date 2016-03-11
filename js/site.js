function siteInit() {
  //DECLARE GLOBAL APP HERE
    var myApp = {
      siteDir: phpvars_siteDir,
      ww: $(window).width(),
      wh: $(window).height(),
      dt: 801,
      tab: 401,
      ts: 500,
      orientation : function() {
        function decider(w,x) {
          if (w >= x) {
          $('html').addClass('_orientation-landscape').removeClass('_orientation-portrait');
          }else {
           $('html').removeClass('_orientation-landscape').addClass('_orientation-portrait');
          }
        }
        decider(this.ww,this.wh);

        $(window).resize(function(){
          this.ww = $(window).width();
          this.wh = $(window).height();
          decider(this.ww,this.wh);
        }.bind(this));

      }
    }.orientation();
  //theHistory();

  var date = new Date();
  hour = date.getHours();
  minute = date.getMinutes();
  angle = (hour * 30) + (minute / 2);

  $('.clock-thing .hours').css(
    {
      'transform' : 'rotate('+angle+'deg)'
    }
  )
  $('.clock-thing .minutes').css('transform', 'rotate('+(minute * 6)+'deg)')



  //CHECK IF CSS IS LOADED
  var thechecker = setInterval(function(){
    var ztest = $('#css-checker').css('height');

    if(ztest == '1px') {
      cssLoaded = true;
      clearInterval(thechecker);
      console.log('css loaded');
    }
  }, 10);







  pageLoader();

  $('html').addClass('_page-loaded');
  console.log('scripts loaded');
}









//DON'T TOUCH
siteScriptsLoaded = true;
siteInit();
