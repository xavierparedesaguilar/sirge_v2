<?php
/*
  CakePHP Google Map V3 - Helper to CakePHP framework that integrates a Google Map in your view
  using Google Maps API V3.

  Copyright (c) 2012 Marc Fernandez Girones: marc.fernandezg@gmail.com

  MIT LICENSE:
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.

  @author      Marc Fernandez Girones <marc.fernandezg@gmail.com>
  @version     3.0
  @license     OPPL

  Date       May 13, 2010

  This helper uses the latest Google API V3 so you don't need to provide or get any Google API Key

*/

namespace App\View\Helper;
use Cake\View\Helper;
use Cake\View\View;

class GoogleMapHelper extends Helper {

  private static $version = '0.2.0';

  public static function getVersion(){
    return self::$version;
  }


  //DEFAULT MAP OPTIONS (method map())
  // Map canvas ID
  var $defaultId            = "map_canvas";
  // Width of the map
  var $defaultWidth         = "800px";
  // Height of the map
  var $defaultHeight        = "800px";
  // CSS style for the map canvas
  var $defaultStyle         = "style";
  // Default zoom
  var $defaultZoom          = 6;
  // Type of map (ROADMAP, SATELLITE, HYBRID or TERRAIN)
  var $defaultType          = 'ROADMAP';
  // Any other map option not mentioned before and available for the map.
  // For example 'mapTypeControl: true' (http://code.google.com/apis/maps/documentation/javascript/controls.html)
  var $defaultCustom        = "";
  // Default latitude if the browser doesn't support localization or you don't want localization
  var $defaultLatitude      = 40.69847032728747;
  // Default longitude if the browser doesn't support localization or you don't want localization
  var $defaultLongitude     = -73.9514422416687;
  // Boolean to localize your position or not
  var $defaultLocalize      = true;
  // Boolean to put a marker in the position or not
  var $defaultMarker        = true;
  // Default marker title (HTML title tag)
  var $defaultMarkerTitle   = 'My Position';
  // Default icon of the marker
  var $defaultMarkerIcon    = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';//'http://google-maps-icons.googlecode.com/files/home.png';
  // Default shadow for the marker icon
  var $defaultMarkerShadow  = '';
  // Boolean to show an information window when you click the marker or not
  var $defaultInfoWindow    = true;
  // Default text inside the information window
  var $defaultWindowText    = 'My Position';

  //DEFAULT MARKER OPTIONS (method addMarker())
  // Boolean to show an information window when you click the marker or not
  var $defaultInfoWindowM   = true;
  // Default text inside the information window
  var $defaultWindowTextM   = 'Marker info window';
  // Default marker title (HTML title tag)
  var $defaultmarkerTitleM  = "Title";
  // Default icon of the marker
  var $defaultmarkerIconM   = "http://maps.google.com/mapfiles/marker.png";
  // Default shadow for the marker icon
  var $defaultmarkerShadowM = "http://maps.google.com/mapfiles/shadow50.png";
    // Indicate if marker is draggable
  var $defaultDraggableMarker  = false;

  //DEFAULT DIRECTIONS OPTIONS (method getDirections())
  // Default travel mode (DRIVING, BICYCLING, TRANSIT, WALKING)
  var $defaultTravelMode    = "DRIVING";
  // Div ID to dump the step by step directions
  var $defaultDirectionsDiv = null;

  //DEFAULT POLYLINES OPTION (method addPolyline())
  // Line color
  var $defaultStrokeColor   = "#FF0000";
  // Line opacity 0.1 - 1
  var $defaultStrokeOpacity = 1.0;
  // Line Weight in pixels
  var $defaultStrokeWeight  = 2;

  //DEFAULT CIRCLE OPTIONS (method addCircle())
  var $defaultFillColor = "";
  var $defaultFillOpacity = 0;


  /*
  * Method map
  *
  * This method generates a div tag and inserts
  * a google maps.
  *
  *
  * @author Marc Fernandez <marc.fernandezg (at) gmail (dot) com>
  * @param array $options - options array
  * @return string - will return all the javascript script to generate the map
  *
  */
  public function map($options = null) {
    if ($options != null) {
      extract($options);
    }
    if (!isset($id))               $id              = $this->defaultId;
    if (!isset($width))            $width           = $this->defaultWidth;
    if (!isset($height))           $height          = $this->defaultHeight;
    if (!isset($style))            $style           = $this->defaultStyle;
    if (!isset($zoom))             $zoom            = $this->defaultZoom;
    if (!isset($type))             $type            = $this->defaultType;
    if (!isset($custom))           $custom          = $this->defaultCustom;
    if (!isset($localize))         $localize        = $this->defaultLocalize;
    if (!isset($marker))           $marker          = $this->defaultMarker;
    if (!isset($markerIcon))       $markerIcon      = $this->defaultMarkerIcon;
    if (!isset($markerShadow))     $markerShadow    = $this->defaultMarkerShadow;
    if (!isset($markerTitle))      $markerTitle     = $this->defaultMarkerTitle;
    if (!isset($infoWindow))       $infoWindow      = $this->defaultInfoWindow;
    if (!isset($windowText))       $windowText      = $this->defaultWindowText;
    if (!isset($draggableMarker))  $draggableMarker = $this->defaultDraggableMarker;


    $map = "<div id='$id' style='width:$width; height:$height; $style'></div>";
    $map .="
      <script>

      function initMap() {

        mapOptions = {
            center: {lat: -9.31497671943395, lng: -74.99041654999996},
            zoom: 6,
            streetViewControl: false,
            mapTypeControl: false,
            fullscreenControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('$id'), mapOptions);

        setMarkers(map);

        Export(map);
      }

      var beaches = $rutas;

      function setMarkers(map) {

        var image = {
          url   : '$markerIcon',
          size  : new google.maps.Size(20, 32),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 32)
        };

        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };

        var infowindow = new google.maps.InfoWindow();
        var marker;
        var markers = new Array();

        for (var i = 0; i < beaches.length; i++) {
          var beach = beaches[i];
          var marker = new google.maps.Marker({
            position: {lat: beach[1], lng: beach[2]},
            map: map,
            // icon: image,
            // icon  : '/sirge/webroot/img/ic_marker.png',
            shape: shape,
            title: beach[0],
            zIndex: beach[3]
          });

          markers.push(marker);
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent('<strong>Código Nacional   : '+beaches[i][0]+'</strong><br>' +
                                    '<strong>Nombre Científico : '+beaches[i][4]+'</strong><br>' +
                                    '<strong>Latitud  : '+beaches[i][1]+'</strong><br>' +
                                    '<strong>Longitud : '+beaches[i][2]+'</strong>');
              infowindow.open(map, marker);
            }
          })(marker, i));
        }

        function AutoCenter() {
          var bounds = new google.maps.LatLngBounds();
          $.each(markers, function (index, marker) {
              bounds.extend(marker.position);
          });

          map.fitBounds(bounds);
        } AutoCenter();
      }

      function Export(map) {

          google.maps.event.addListener(map, 'bounds_changed', function() {
              var bounds = map.getBounds();
              var ne = bounds.getNorthEast();
              var sw = bounds.getSouthWest();

              var latitud  = (parseFloat(ne.lat())+parseFloat(sw.lat()))/2;
              var longitud = (parseFloat(ne.lng())+parseFloat(sw.lng()))/2;

              var staticMapUrl = 'https://maps.googleapis.com/maps/api/staticmap';
              staticMapUrl += '?center=' + latitud + ',' + longitud;
              staticMapUrl += '&size=594x280';
              staticMapUrl += '&zoom=' + (parseInt(map.getZoom())-1);
              staticMapUrl += '&maptype=' + mapOptions.mapTypeId;
              staticMapUrl += '&key=AIzaSyCdGE7pCB0ydBOlrzpsbiHoh8ax29SFY7M';

              for (var i = 0; i < beaches.length; i++) {
                  // staticMapUrl += '&markers=icon:$markerIcon|' + beaches[i][1] + ',' + beaches[i][2];
                  staticMapUrl += '&markers=color:red|' + beaches[i][1] + ',' + beaches[i][2];
              }

              var imgMap = document.getElementById('url_mapa');
              imgMap.value = staticMapUrl;
          });
      }
    ";

    $map .= "</script>";

      return $map;
    }
  }
?>
