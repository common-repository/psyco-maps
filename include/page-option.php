<div id="psyco-maps" class="psyco-maps-create-short">
  <div class="setting">

    <h2 class="text-center"><?php echo __('General settings',PSYCO_MAPS_NAME); ?></h2>
    <hr>

    <div class="row">
      <div class="group col-md-3">
        <h4><?php echo __('Width',PSYCO_MAPS_NAME); ?> px or %</h4>
        <input type="text" name="width" value="250px">
      </div>

      <div class="group col-md-3">
        <h4><?php echo __('Height',PSYCO_MAPS_NAME); ?> px or %</h4>
        <input type="text" name="height" value="250px">
      </div>

      <div class="group col-md-3">
        <h4><?php echo __('Margin',PSYCO_MAPS_NAME); ?> px or %</h4>
        <input type="text" name="margin" value="15px 10px 15px 10px">
      </div>

      <div class="group col-md-3">
        <h4><?php echo __('Padding',PSYCO_MAPS_NAME); ?> px or %</h4>
        <input type="text" name="padding" value="15px 10px 15px 10px">
      </div>

    </div>

    <div class="row">
      <div class="group col-md-3">
        <h4>Draggable?</h4>
        <input type="radio" name="draggable" value="true" checked> Yes
        <input type="radio" name="draggable" value="false"> None
      </div>

      <div class="group col-md-3">
        <h4>Zoom</h4>
        <input type="number" name="zoom" value="14" min="0" max="99">
      </div>


      <div class="group col-md-3">
        <h4>Radius</h4>
        <input type="radio" name="radius" value="true" checked> Yes
        <input type="radio" name="radius" value="false"> None
      </div>

      <div class="group col-md-3">
        <h4>Radius distance</h4>
        <input type="number" name="rdistance">
      </div>
    </div>

<hr>
    <h2 class="text-center"><?php echo __('Markers',PSYCO_MAPS_NAME); ?></h2>
  </div><!--.setting-->

    <div class="row">
      <div class="group col-md-5">
        <label for="psyco-search-location"><?php echo __('Search location...',PSYCO_MAPS_NAME); ?></label>
        <input id="psyco-search-location" type="text" name="psyco-search-location" placeholder="<?php echo __('Add location marker',PSYCO_MAPS_NAME);?>">
      </div>
      <div class="col-md-7">
        <div class="markers" data-input-label="<?php echo __('Name',PSYCO_MAPS_NAME); ?>" data-err="<?php echo __('Please insert an address',PSYCO_MAPS_NAME); ?>"></div><!--.markers-->
      </div>
    </div>
<hr>
    <div class="row">
      <div class="col-md-12">
        <h4>Preview</h4>
        <div id="maps" style="height:300px;width:100%;"></div>
        <script>
            var myLatLng = {lat: -25.363, lng: 131.044};
            var map = new google.maps.Map(document.getElementById('maps'), {
              zoom: 12,
              center:myLatLng,
              <?php echo (psyco_maps_get_option('maps_c_style') ? 'styles:'.psyco_maps_get_option('maps_c_style') : ''); ?>
            });
            var marker =  new google.maps.Marker({
                position: myLatLng,
                map: map,
                animation: google.maps.Animation.DROP,
                scaledSize: new google.maps.Size(50, 50), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            });
        </script>
      </div>
    </div>
<hr>
    <div class="row">
      <div class="group col-md-12">
        <button type="button" name="getShortcodeMaps">Create shortcode</button>
        <div class="short"><code>[psyco_maps][/psyco_maps]</code></div>
      </div>
    </div>


</div><!--#psyco-maps-->
