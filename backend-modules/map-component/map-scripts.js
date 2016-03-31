jQuery(document).ready(function( $ ) {
  var center = new google.maps.LatLng(initialStates.center.lat,initialStates.center.lng);
  var mapOptions = {
    zoom: initialStates.zoom,
    center: center,
    disableDefaultUI: true,
    zoomControl: true
  };

  map = new google.maps.Map(document.getElementById('selector-map'),
  mapOptions);

  //ADD IN THE CENTER PIN
  var infoBoxOptions = {
      content : '<div class="pin"><svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#location"></use></svg></div>'
      ,disableAutoPan: true
      ,maxWidth: 0
      ,boxStyle: {
        background: 'red',
        width: "1px",
        height: "1px",

      }
      ,zIndex: -1
      ,boxClass: 'centerPin'
      ,closeBoxMargin: "0"
      ,closeBoxURL: ''
      ,infoBoxClearance: new google.maps.Size(.5,.5)
      ,pixelOffset: new google.maps.Size(-.5,-.5)
      ,visible: true
      ,pane: 'floatPane'
      ,enableEventPropagation: true
      ,alignBottom: false
    }

    var centerPin = new InfoBox(infoBoxOptions);
    centerPin.setPosition(center);
    centerPin.open(map);


  //CHANGE CENTER PIN
  $('#set-map-center').click(function(){
    var center = map.getCenter(),
        lat = center.lat(),
        lng = center.lng(),
        latlng = lat+','+lng;

    $('input#google_coordinates').val(latlng);
    stateChange = true;
    centerPin.setPosition(center);


    return false;
  });
  //SET UP SEARCH BOX
  var input = document.getElementById('search-input');
  var searchBox = new google.maps.places.SearchBox(input);
  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


  //CHANGE ZOOM LEVEL
  $('#set-zoom-level').click(function(){
    var zoom = map.getZoom();


    $('input#zoom_level').val(zoom);
    stateChange = true;



    return false;
  });

  //SEARCH FUNCTIONALITY
  geocoder = new google.maps.Geocoder();

  $('#search-holder .search-btn').click(function(){
    //searchFetcher();

    return false;
  });
  function enterKeyDown() {
    return false;
  }
  $( "#search-input" ).keydown(function(event){
    if (event.keyCode == 13) {
    //  searchFetcher();
      return false;
    }

  });
  searchBox.addListener('places_changed', function() {
    console.log(searchBox.getPlaces());

    //https://developers.google.com/maps/documentation/javascript/examples/places-searchbox

  });
  function searchFetcher(location) {
    var location = $('#search-input').val();
    if(location == '') {
      return false
    }
    $('#search-holder').addClass('__page-loading');
    geocoder.geocode({'address': location}, function(results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        theLocation = results[0].geometry.location;
        map.setCenter(theLocation);
        $('#search-holder').removeClass('__page-loading');

      } else {
        $('#search-holder').removeClass('__page-loading');
        alert('We were unable to locate your address.');
      }
    });

  }


});
