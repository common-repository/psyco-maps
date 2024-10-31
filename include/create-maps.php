<?php
  $center = explode(',',$a['center']);
?><div id="psyco-map-<?php echo $rand; ?>" class="psyco-map-<?php echo $rand; ?>" style="margin:<?php echo $a['margin']; ?>;padding:<?php echo $a['padding']; ?>;width:<?php echo $a['width']; ?>;height:<?php echo $a['height']; ?>;"></div>
<!--psyco maps script-->
<script>
    var latlng = new google.maps.LatLng(<?php echo $center[0]; ?>, <?php echo $center[1]; ?>);
    var map_<?php echo $a['map_id']; ?> = new google.maps.Map(document.getElementById('psyco-map-<?php echo $rand; ?>'), {
      zoom: <?php echo $a['zoom']; ?>,
      draggable: <?php echo $a['draggable']; ?>,
      center: latlng,
      <?php echo (psyco_maps_get_option('maps_c_style') ? 'styles:'.psyco_maps_get_option('maps_c_style') : ''); ?>
    });
    <?php echo $content; ?>
</script>
