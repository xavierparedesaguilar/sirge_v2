/*------------------------------
 * Copyright 2016 Themejumbo
 * http://www.themejumbo.com
 *
 * Billboard theme v1.2
------------------------------*/

$(document).ready(function() {	
	
	/*------------------------------
		VEGAS BACKGROUND
	------------------------------*/
	$.vegas({src:'web/assets/images/background.jpg'});
	$.vegas('overlay', {src:'web/assets/images/overlays/05.png'});
	
	/*------------------------------
		CIRCLE COUNTDOWN
	------------------------------*/
	$("#countdown").TimeCircles({
		"animation": "ticks",
		"bg_width": 0.2,
		"fg_width": 0.017,
		"time": {
			"Days": {
				"text": "Days",
				"color": "#FFF",
				"show": true
			},
			"Hours": {
				"text": "Hours",
				"color": "#FFF",
				"show": true
			},
			"Minutes": {
				"text": "Minutes",
				"color": "#FFF",
				"show": true
			},
			"Seconds": {
				"text": "Seconds",
				"color": "#FFF",
				"show": true
			}
		}
	});
	
	/*------------------------------
		GOOGLE MAP
	------------------------------*/
	
	var mapInfoContact = {
		'lat' : 43.651071,
		'lng' : -79.378764,
		'zoom' : 16
	};
		
	/*------------------------------
		GOOGLE MAP - CONTACT
	------------------------------*/	
	var map;
		
	// GOOGLE MAP INIT
	function initialize($) {
		var mapOptions = {
			mapAddress: "Address, City, Country",
			zoom: mapInfoContact.zoom,
			center: mapInfoContact,
			navigationControl: false,
			mapTypeControl: false,
			scaleControl: false,
			draggable: true,
			scrollwheel: false,
			streetViewControl: false,
			zoomControl: true,
			zoomControlOptions: {
				position: google.maps.ControlPosition.LEFT_TOP
			}
		}
		
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		
		var marker = new google.maps.Marker({
			position: mapInfoContact, 
			map: map, 
			title: mapOptions.mapAddress
		});
		
	}
	
	if($("#map-canvas").length) {
		google.maps.event.addDomListener(window, 'load', initialize);
	}

	$("#contact").on("shown.bs.modal", function () {
		google.maps.event.trigger(map, "resize");
		map.setCenter(mapInfoContact);
	});
});

/*------------------------------
	CIRCLE COUNTDOWN - RESIZE
------------------------------*/
$(window).resize(function() {	
	$("#countdown").TimeCircles().rebuild(); 
});