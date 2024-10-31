<div id="cds-map-<?php echo $maps_id; ?>" class="cds-maps" style="margin: 30px 0px;width:<?php echo $width; ?>;height:<?php echo $height; ?>;"></div>
<script id="cds-maps-script">
        var address_<?php echo $maps_id; ?> = "<?php echo $address; ?>";
        var geocoder_<?php echo $maps_id; ?> = new google.maps.Geocoder();
        var map_<?php echo $maps_id; ?> = new google.maps.Map(document.getElementById('cds-map-<?php echo $maps_id; ?>'), {
          zoom: <?php echo $zoom; ?>,
          maxZoom: <?php echo $maxzoom; ?>  ,
          minZoom: <?php echo $minzoom; ?>  ,
          streetViewControl:<?php echo $streetviewcontrol; ?>,
          mapTypeControl: true,
          zoomControl:<?php echo $zoomcontrol; ?>,
          <?php if( !empty($maptypecontroloptions) ): ?>
          mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            mapTypeIds: ['roadmap', 'terrain','satellite','hybrid']
          },
          <?php endif; ?>
          <?php echo ( !empty($style) && $style != '' ? 'styles:'.$style.',' : ''); ?>
          <?php echo ($draggable ? 'draggable:'.$draggable.',' : 'draggable:true,') ?>
        });
        geocoder_<?php echo $maps_id; ?>.geocode( { 'address': address_<?php echo $maps_id; ?>}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
            map_<?php echo $maps_id; ?>.setCenter(results[0].geometry.location);
            var addresses_<?php echo $maps_id; ?> = [<?php foreach ($locations as $key){
              echo '"'.$key.'",';
            } ?>];
            var infowindow = new google.maps.InfoWindow();
            var values = [];
            for (var x = 0; x < addresses_<?php echo $maps_id; ?>.length; x++) {
                $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address='+addresses_<?php echo $maps_id; ?>[x]+'&sensor=false', null, function (data) {
                    var p = data.results[0].geometry.location;
                    var latlng = new google.maps.LatLng(p.lat, p.lng);
                    var name_address = data.results[0].formatted_address;
                    var description = "<?php echo $description; ?>";
                    var icon = {
                      url: <?php echo '"'.$icon.'"'; ?>, // url
                      scaledSize: new google.maps.Size(50, 50), // scaled size
                      origin: new google.maps.Point(0,0), // origin
                      anchor: new google.maps.Point(0, 0) // anchor
                    };


                    <?php //echo do_shortcode($content); ?>


                     marker.addListener('click', function() {
                        infowindow.setContent('<div class="cds-maps-infowindow"><?php echo ($title ?  '<h1>'.$title.'</h1>' : ''); ?><address>'+name_address+'</address><p>'+description+'</p><p><a style="margin-top:10px;" target="_blank" href="https://maps.google.com?saddr=Current+Location&daddr='+name_address.replace(' ','+')+'">Get directions</a></p></div>');
                        infowindow.open(map_<?php echo $maps_id; ?>, this);
                     });

                       function toggleBounce() {
                         if (marker.getAnimation() !== null) {
                           marker.setAnimation(null);
                         } else {
                           marker.setAnimation(google.maps.Animation.BOUNCE);
                         }
                       }
                     google.maps.event.addListener(marker, 'click', function() {
                         infowindow.open(map_<?php echo $maps_id; ?>,marker);
                     });


                });
            }
          } else {
            alert("No results found");
          }
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
</script>
