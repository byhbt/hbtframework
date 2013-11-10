<?php

class Gmap {
	public $apiKey; //Google API Key
	public $mapZoom = 8; //
	public $mapCenter;
	public $googleMapTypes;
	public $mapType = 'normal';
	public $markerPoints = array();
	public $mapDivID;


	public function __construct($apiKey=null){
		$this->apiKey = is_null( $apiKey ) ? '' : $apiKey;
	}


	/*
	 * get pinpoint mark by latitude or longitude
	 */
	public function addMarker($lat, $long, $html)
	{
		//$pointer = sizeof( $this->markerPoints );
		$this->markerPoints[0]['lat']  = $lat;
		$this->markerPoints[0]['long'] = $long;
		$this->markerPoints[0]['html'] = $html;
	}


	/*
	 *
	 * @The javascript for google to connect
	 *
	 * @access public
	 * @return string
	 */
	public function googleJS(){
		$js .= '<script type="text/javascript">
				function initialize() {
					var myLatlng = new google.maps.LatLng('. $this->markerPoints[0]['lat'] .', '. $this->markerPoints[0]['long'] .');
					var mapOptions = {
					zoom: '.$this->mapZoom.',
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				console.log(myLatlng);
				var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
				});';

		$js .= 'var contentString = "<div id=\'content\'>'. $this->markerPoints[0]['html']  .'</div>";

				var infoWindow = new google.maps.InfoWindow({
					content: contentString,
					position: myLatlng
				});

				infoWindow.open(map, marker);

				google.maps.event.addListener(marker, "click", function() {
					infoWindow.open(map, marker);
				}); google.maps.event.addDomListener(window, "load", initialize);';
		$js .= '} ';

		//end
		$js .= 		' </script>';

		return $js;
	}

	private function noJavascript() {
		return '<noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b>
				However, it seems JavaScript is either disabled or not supported by your browser.
				To view Google Maps, enable JavaScript by changing your browser options, and then
				try again.
				</noscript>';
	}
}