//    google map start
    (function($) {
        "use strict";

        google.maps.event.addDomListener(window, 'load', init);

        var map;

        function init() {
            var mapOptions = {
                center: new google.maps.LatLng(23.825527, 90.429862),
                zoom: 15,
                zoomControl: false,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.DEFAULT,
                },
                disableDoubleClickZoom: false,
                mapTypeControl: false,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                },
                scaleControl: true,
                scrollwheel: false,
                streetViewControl: false,
                draggable : true,
                overviewMapControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [ 
                    { featureType: "administrative", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -100 }, { lightness: 20 } ] },
                    { featureType: "road", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -100 }, { lightness: 40 } ] },
                    { featureType: "water", elementType: "all", stylers: [ { visibility: "on" }, { saturation: -10 }, { lightness: 30 } ] },
                    { featureType: "landscape.man_made", elementType: "all", stylers: [ { visibility: "simplified" }, { saturation: -60 }, { lightness: 10 } ] },
                    { featureType: "landscape.natural", elementType: "all", stylers: [ { visibility: "simplified" }, { saturation: -60 }, { lightness: 60 } ] },
                    { featureType: "poi", elementType: "all", stylers: [ { visibility: "off" }, { saturation: -100 }, { lightness: 60 } ] }, 
                    { featureType: "transit", elementType: "all", stylers: [ { visibility: "off" }, { saturation: -100 }, { lightness: 60 } ] }
                ]

            }

            var mapElement = document.getElementById('mapBox');
            var map = new google.maps.Map(mapElement, mapOptions);
            var locations = [
                ['', 23.825527, 90.429862]
            ]
        }    
    })(jQuery);
//    google map end