var marker_<?php echo $a['id']; ?> =  new google.maps.Marker({
    position: {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>},
    map: map_<?php echo $a['map_id']; ?>,
    title: '<?php echo $a['name']; ?>',
    animation: google.maps.Animation.DROP,
    scaledSize: new google.maps.Size(50, 50), // scaled size
    origin: new google.maps.Point(0,0), // origin
    anchor: new google.maps.Point(0, 0) // anchor
});
var infowindow_<?php echo $a['id']; ?> = new google.maps.InfoWindow({
          content: "<div><b><?php echo $a['title']; ?></b><br><?php echo strip_tags($content,'<br>'); ?></div>"
});
marker_<?php echo $a['id']; ?>.addListener('click', function() {
  infowindow_<?php echo $a['id']; ?>.open(map_<?php echo $a['map_id']; ?>, marker_<?php echo $a['id']; ?>);
});
<?php if($a['radius'] == 'true'): ?>
var cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map_<?php echo $a['map_id']; ?>,
            center: {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>},
            <?php echo ( $a['rdistance'] ? 'radius:'.$a['rdistance'].',' : '' ); ?>
});
<?php endif; ?>
