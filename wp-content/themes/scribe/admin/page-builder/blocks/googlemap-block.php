<?php
/** Googlemap block **/

if(!class_exists('PG_Googlemap_Block')) {
	class PG_Googlemap_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Google Map',
				'size' => 'span6',
			);
			
			//create the block
			parent::__construct('pg_googlemap_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'maptitle' => '',
				'lat' => '',
				'long' => '',
				'pop_title' => '',
				'pop_text' => '',
				
				'zoom' => 8,
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>
			
			<p class="description half">
				<label for="<?php echo $this->get_field_id('maptitle') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('maptitle', $block_id, $maptitle) ?>
				</label>
			</p>
			<p class="description half last">
				<label for="<?php echo $this->get_field_id('lat') ?>">
					Latitude (required)<br/>
					<?php echo aq_field_input('lat', $block_id, $lat) ?>
				</label>
			</p>
			<p class="description half">
				<label for="<?php echo $this->get_field_id('long') ?>">
					Longitude (required)<br/>
					<?php echo aq_field_input('long', $block_id, $long) ?>
				</label>
			</p>
			<p class="description fourth">
				<label for="<?php echo $this->get_field_id('zoom') ?>">
					Zoom Level<br/>
					<?php echo aq_field_input('zoom', $block_id, $zoom) ?>
				</label>
			</p>
      <p class="description fourth">
				<label for="<?php echo $this->get_field_id('pop_title') ?>">
					Pop-Up Title<br/>
					<?php echo aq_field_input('pop_title', $block_id, $pop_title) ?>
				</label>
			</p>
		<p class="description fourth">
				<label for="<?php echo $this->get_field_id('pop_text') ?>">
					Pop-Up Text<br/>
					<?php echo aq_field_input('pop_text', $block_id, $pop_text) ?>
				</label>
			</p>
	        <p>
	  				<input class="checkbox" type="checkbox" value="true" id="<?php echo $this->get_field_id( 'stretch_map' ); ?>" name="<?php echo $this->get_field_name( 'stretch_map' ); ?>"<?php checked( $instance['stretch_map'], 'true' ); ?> />
	  				<label for="<?php echo $this->get_field_id( 'featured_price' ); ?>"><?php _e( 'Stretch to full width?', 'scribe' ); ?></label>
	  			</p>
			<?php
			
		}
		
		function block($instance) {
			$defaults = array(
				'maptitle' => '',
				'lat' => 49.25,
				'long' => -123.11,
				'zoom' => 8
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?><?php
			 if( isset( $stretch_map ) && $stretch_map == true) {
			echo '</div></div></div></div></div>';
		};
		echo '<div id="map"></div>'; 
		 echo '<div class="container"><div class="row"><div class="col-md-12">';
		?>
	
		<!-- MAP SCRIPTS -->
		    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false"></script>
			<script type="text/javascript">
	        // When the window has finished loading create our google map below
	        google.maps.event.addDomListener(window, 'load', init);

	        function init() {
	            // Basic options for a simple Google Map
	            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
				 var scMap = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>);
	            var mapOptions = {
	                // How zoomed in you want the map to start at (always required)
	                zoom: <?php echo $zoom; ?>,
            
	                scrollwheel: false,

	                // The latitude and longitude to center the map (always required)
	                center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>), // New York
				    
	                // How you would like to style the map. 
	                // This is where you would paste any style found on Snazzy Maps.
	                styles: [	{		
						featureType:'water',		
						stylers:[{color:'#c7defc'},{visibility:'on'}]	},
						{		featureType:'landscape',		stylers:[{color:'#f2f2f2'}]	},
						{		featureType:'road',		stylers:[{saturation:-100},{lightness:45}]	},
						{		featureType:'road.highway',		stylers:[{visibility:'simplified'}]	},
						{		featureType:'road.arterial',		
								elementType:'labels.icon',		
								stylers:[{visibility:'off'}]	},
								{		featureType:'administrative',		
								elementType:'labels.text.fill',		
								stylers:[{color:'#444444'}]	},
								{		featureType:'transit',		
								stylers:[{visibility:'off'}]	},
								{		featureType:'poi',		stylers:[{visibility:'off'}]	}]
	            };
				
	            // Get the HTML DOM element that will contain your map 
	            // We are using a div with id="map" seen below in the <body>
	            var mapElement = document.getElementById('map');
		        
	            // Create the Google Map using out element and options defined above
	            var map = new google.maps.Map(mapElement, mapOptions);
				
			    var marker = new google.maps.Marker({
		            position: scMap,
		            map: map,
		            title:"Hello World!",
					
		 });
		 //Content structure of info Window for the Markers
		        var contentString = $('<div class="marker-info-win">'+
		        '<div class="marker-inner-win"><span class="info-content">'+
		        '<h1 class="marker-heading">New Marker</h1>'+
		        'This is a new marker infoWindow'+ 
		        '</span>'+
		        '</div></div>');
            
		        //Create an infoWindow
		        var infowindow = new google.maps.InfoWindow();
        
		        //set the content of infoWindow
		        infowindow.setContent(contentString[0]);
        
		        //add click event listener to marker which will open infoWindow          
		        google.maps.event.addListener(marker, 'click', function() {
		            infowindow.open(map,marker); // click on marker opens info window 
		        });
	        }
		   
	    </script>
		<!-- /MAP SCRIPTS -->
 <?php
}}
} ?>
