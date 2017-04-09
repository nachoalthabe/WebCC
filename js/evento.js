(function($){
	function init (){
		$('.mapContainer').each(function(i, elem){
			var dom = $(elem);
			var latlon = dom.text().split(',');
			var posicion = new google.maps.LatLng(parseFloat(latlon[0]), parseFloat(latlon[1]))
			
			var icon = null,
				iconSrc = false;

			if( false && ( iconSrc = dom.attr('icon') ) ){
				icon = new google.maps.MarkerImage(
							//URL
							iconSrc,
							// (width,height)
							new google.maps.Size( 150, 150 ),
							// The origin point (x,y)
							new google.maps.Point( 0, 0 ),
							// The anchor point (x,y)
							new google.maps.Point( 75, 150 )
						);
			};

			var mapOptions = {
			  center: posicion,
			  zoom: 15,
			  disableDefaultUI: true,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			};
  			
  			var directionsService = new google.maps.DirectionsService();
  			var directionsDisplay = new google.maps.DirectionsRenderer({
  				suppressMarkers: true
  			});

			var map = new google.maps.Map(elem,mapOptions);

			var marker = new google.maps.Marker({
		      position: posicion,
		      map: map,
		      icon: icon,
		      animation: google.maps.Animation.DROP,
		      title: dom.parent().find('h4').text(),
  			});

  			directionsDisplay.setMap(map);

  			function showRoute(position,btn){
				var start = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				var end = posicion;
				var request = {
					origin:start,
					destination:end,
					travelMode: google.maps.TravelMode.DRIVING
				};

				function makeMarker( position, title, icon) {
					new google.maps.Marker({
						 position: position,
						 map: map,
						 icon: icon,
						 title: title
					});
				}

				var icons = {
					start: new google.maps.MarkerImage(
						// URL
						'start.png',
						// (width,height)
						new google.maps.Size( 44, 32 ),
						// The origin point (x,y)
						new google.maps.Point( 0, 0 ),
						// The anchor point (x,y)
						new google.maps.Point( 22, 32 )
					),
					end: new google.maps.MarkerImage(
						// URL
						'end.png',
						// (width,height)
						new google.maps.Size( 44, 32 ),
						// The origin point (x,y)
						new google.maps.Point( 0, 0 ),
						// The anchor point (x,y)
						new google.maps.Point( 22, 32 )
					)
				};

				directionsService.route(request, function(result, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						console.log('Ruta',result);
						directionsDisplay.setDirections(result);
						var leg = result.routes[ 0 ].legs[ 0 ];
						makeMarker( leg.start_location, 'Vos' );
						makeMarker( leg.end_location, 'La Movida' );
						marker.setMap(null);
						showMsg(btn);
						var url = dom.parent().find('a.permalink').attr('href');
						btn.off('click');
						btn.attr('href',url+'?route=1');
					}else{
						showError(btn,'Imposible calcular la ruta...');
					}
				});
			};

			if(location.search.indexOf('route') != -1){
				navigator.geolocation.getCurrentPosition(showRoute);
			}

			function showError(btn,msg){
				var str = (typeof msg == 'String')?msg :'No puedo saber donde estas...';
				btn.text(str).addClass('error');
			}

			var hide = false;

			function showMsg(btn,msg){
				if(hide)
					btn.hide();	
				var str = (typeof msg == 'String')?msg :'Mas detalle?';
				btn.text(str).addClass('success');
			}

			function comollegar(ev,hideAfter){
				ev.stopPropagation();
				ev.preventDefault();
  				btn = $(ev.target);
  				hide = hideAfter;
  				if ( navigator['geolocation'] ){
    				navigator.geolocation.getCurrentPosition(function(position){
    					showRoute(position,btn)
    				},function(){
    					showError(btn);
    				});
    			} else {
    				showError(btn);
  				}
  			}

  			dom.parent().find('.mapBtn').click(comollegar);
		});
	}
	$(document).ready(init);
})(jQuery);