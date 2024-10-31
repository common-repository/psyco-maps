<div id="psyco-maps">

  <div class="header">
    <h1>Psyco maps <sup><?php echo psyco_maps_get_option('psyco-maps-version'); ?></sup></h1>
  </div>
  <div class="h">

  </div>
  <div class="section">

    <h3><?php echo __('General Setting',PSYCO_MAPS_NAME); ?></h3>

    <div class="row">
      <div class="group col-md-4">
        <label>Google maps api</label>
        <input spellcheck="false"  type="text" name="apimaps" value="<?php echo ( !empty(psyco_maps_get_option('apimaps')) ? psyco_maps_get_option('apimaps') : '' ) ?>">
      </div>

      <div class="group col-md-4">
        <label><?php echo __('Active on post or page',PSYCO_MAPS_NAME); ?></label>
        <input type="radio" name="maps_postorpage" value="0" <?php echo (psyco_maps_get_option('maps_postorpage') == '0' || empty(psyco_maps_get_option('maps_yesornot')) ? 'checked' :''); ?>> Page
        <input type="radio" name="maps_postorpage" value="1" <?php echo (psyco_maps_get_option('maps_postorpage') == '1' ? 'checked' :''); ?>> Post
        <input type="radio" name="maps_postorpage" value="2" <?php echo (psyco_maps_get_option('maps_postorpage') == '2' ? 'checked' :''); ?>> Both
      </div>

      <div class="group col-md-4">
        <label for="overlay"><?php echo __('Active plugin Google Maps javascript API',PSYCO_MAPS_NAME); ?></label>
        <input type="radio" name="maps_yesornot" value="0" <?php echo (psyco_maps_get_option('maps_yesornot') == '0' || empty(psyco_maps_get_option('maps_yesornot')) ? 'checked' :''); ?>> Yes
        <input type="radio" name="maps_yesornot" value="1" <?php echo (psyco_maps_get_option('maps_yesornot') == '1' ? 'checked' :''); ?>> none
      </div>
    </div>

    <div class="row">
      <div class="group col-md-12">
        <label for="styles">Styles</label>
        <textarea name="maps_c_style" rows="8" cols="80" placeholder="Your custom json for maps style"><?php echo ( !empty(psyco_maps_get_option('maps_c_style')) ? psyco_maps_get_option('maps_c_style') : '' ) ?></textarea>
      </div>
    </div>

    <div class="response">
        <div>
          <i class="fas fa-check"></i> <?php echo __('Saved',PSYCO_MAPS_NAME); ?>
        </div>
    </div>

<button class="save" type="button" name="save_maps">SAVE</button>

</div><!--psyco-maps-->
