jQuery(document).ready(function() {

  function makeid() {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

      return text;
  }

    jQuery('#psyco-maps').find('[name="save_maps"]').click(function() {
        var $this = jQuery(this);
        $this.removeClass('on');
        var data = {
            'action': 'psyco_maps_save',
            'apimaps': jQuery('[name="apimaps"]').val(),
            'maps_postorpage': jQuery('[name="maps_postorpage"]:checked').val(),
            'maps_yesornot' : jQuery('[name="maps_yesornot"]:checked').val(),
            'maps_c_style'  : jQuery('[name="maps_c_style"]').val()
        };
        jQuery.post(ajaxurl, data, function() {
            jQuery('.response').fadeIn();
            setTimeout(function() {
                jQuery('.response').fadeOut();
            }, 2500)
        });
    });

    jQuery('#psyco-maps').find('input').change(function(){
      jQuery(this).closest('#psyco-maps').find('[name="save_maps"]').addClass('on');
    });

    jQuery('.psyco-maps-create-short').find('.setting').find('input,textarea').change(function(){
      if (jQuery(this).val() != 0) {
        switch (jQuery(this).attr('name')) {
          case 'draggable':
            if (jQuery(this).val() == 'true') {
              map.set(jQuery(this).attr('name'),true);
            }else{
              map.set(jQuery(this).attr('name'),false);
            }
            break;
          case 'styles':
            if(jQuery(this).val() != 0){
              map.set(jQuery(this).attr('name'),JSON.parse(jQuery(this).val()));
            }else{
              map.set(jQuery(this).attr('name'),'[...]');
            }
            break;
          default:
              map.set(jQuery(this).attr('name'),JSON.parse(jQuery(this).val()));
        }
      }
    });


        var input = jQuery('#psyco-search-location')[0];
        var searchBox = new google.maps.places.SearchBox(input);

        var markers = [];
        var $i_m = 0;
        searchBox.addListener('places_changed', function() {

          $i_m++;
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });

          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {

            var locGeo = place.geometry.location,
                locName = place.name,
                label_input_marker = jQuery('.markers').attr('data-input-label');



            jQuery('.markers').append('<dl data-id="'+$i_m+'" class="marker"><dt><i class="fas fa-times"></i><span class="marker-name">Marker '+locName+'</span></dt><dd><div class="col-xs-12"><span class="col-xs-4 name">'+locName+'</span><span class="col-xs-8 loc">'+locGeo+'</span><input type="text" placeholder="'+label_input_marker+'"></div></dd></dl>');

            jQuery('#psyco-search-location').val('');

            jQuery('.marker').each(function(){
              var $this = jQuery(this);
                  $this.find('i').click(function(){
                    $this.closest('.marker').remove();
                    if (jQuery('.marker').length == 0) {
                      $i_m = 0;
                    }
                  });
            });

            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              title: place.name,
              position: place.geometry.location
            }));

          });
        });// end event places_changed


        jQuery('[name="getShortcodeMaps"]').click(function(){
          var $this    =  jQuery(this),
              $map_id  = makeid(),
              response =  jQuery('.short').find('code'),
              width     =  (jQuery('[name="width"]').val() ? ' width="'+jQuery('[name="width"]').val()+'" ' : ''),
              zoom     =  (jQuery('[name="zoom"]').val() ? ' zoom="'+jQuery('[name="zoom"]').val()+'" ' : ''),
              height     =  (jQuery('[name="height"]').val() ? ' height="'+jQuery('[name="height"]').val()+'" ' : ''),
              margin     =  (jQuery('[name="margin"]').val() ? ' margin="'+jQuery('[name="margin"]').val()+'" ' : ''),
              padding     =  (jQuery('[name="padding"]').val() ? ' padding="'+jQuery('[name="padding"]').val()+'" ' : ''),
              rdistance     =  (jQuery('[name="rdistance"]').val() ? ' rdistance="'+jQuery('[name="rdistance"]').val()+'" ' : ''),
              radius     =  (jQuery('[name="radius"]:checked').val() ? ' radius="'+jQuery('[name="radius"]:checked').val()+'" ' : ''),
              draggable   =  (jQuery('[name="draggable"]:checked').val() ? ' draggable="'+jQuery('[name="draggable"]:checked').val()+'" ' : '');


              if ( jQuery('.markers').find('.marker').length == 0 ) {
                  response.text(jQuery('.markers').attr('data-err'));
              }else{
                var $marker = [];
                var center = jQuery('.marker:first-child').find('.loc').html().replace(/\(|\)/g, "").replace(' ','');
                jQuery('.marker').each(function(){
                  var m_name = jQuery(this).find('.marker-name').html(),
                      m_loc  = jQuery(this).find('.loc').html().replace(/\(|\)/g, "").replace(' ',''),
                      m_loc_name = jQuery(this).find('.name').html(),
                      m_title = (jQuery(this).find('input').val() ? jQuery(this).find('input').val() : m_loc_name),
                      dataID = jQuery(this).attr('data-id');

                      $marker += '[psyco_maps_marker '+radius+' '+rdistance+' map_id="'+$map_id+'" id="'+dataID+'" position="'+m_loc+'" name="'+m_loc_name+'" title="'+m_title+'"][/psyco_maps_marker]';
                });

                response.text('[psyco_maps map_id="'+$map_id+'" center="'+center+'" '+margin+padding+height+width+zoom+draggable+']'+$marker+'[/psyco_maps]');
              }

        });

});
