<?php

function psyco_maps_admin_enqueue($hook) {
    wp_enqueue_style( 'psyco_f_family','https://fonts.googleapis.com/css?family=Fira+Sans:300,400,700' );
    wp_enqueue_style('fontawesome','https://use.fontawesome.com/releases/v5.0.10/css/all.css');
    wp_enqueue_style( 'psyco_maps_admin_css', plugins_url(PSYCO_MAPS_NAME.'/include/css/psyco_maps_admin.css') );
    if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' )
      return;
    if (psyco_maps_get_option('maps_yesornot') == '0') {
      wp_register_script('apimapsjs','http://maps.google.com/maps/api/js?libraries=places&sensor=false');
      wp_enqueue_script('apimapsjs');
    }
    wp_register_script('psyco_maps_admin_js', plugins_url(PSYCO_MAPS_NAME.'/include/js/psyco_maps_admin.js'));
    wp_enqueue_script( 'psyco_maps_admin_js' );
}

add_action( 'admin_enqueue_scripts', 'psyco_maps_admin_enqueue' );



add_action( 'admin_menu', 'psyco_maps_menu_cb' );
function psyco_maps_menu_cb() {
  add_menu_page(
    'Psyco maps',
     'psyco maps',
      'manage_options',
       'psyco-maps-settings',
        'psyco_maps_settings_cb',
         plugins_url(PSYCO_MAPS_NAME.'/map.png')
    );
}

function psyco_maps_settings_cb() {
    	if ( !current_user_can( 'manage_options' ) )  {
    		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    	}
    	include (PSYCO_MAPS_DIR.'/include/settings.php');
}

function psyco_maps_update_option( $name, $value ) {
  $option = get_option( 'psyco_maps' );
  $option = ( false === $option ) ? array() : (array) $option;
  $option = array_merge( $option, array( $name => $value ) );
  update_option( 'psyco_maps', $option );
}

function psyco_maps_get_option( $name,$default = false ) {
  $option = get_option( "psyco_maps" );
  if ( !isset($option) ) {
    return $default;
  }
  if ( isset( $option[$name] ) ) {
    return $option[$name];
  } else {
    return $default;
  }
}

if ( psyco_maps_get_option('psyco-maps-version') != false ) {
  psyco_maps_update_option('psyco-maps-version',PSYCO_MAPS_VERSION);
}

add_action( 'wp_ajax_psyco_maps_save', 'psyco_maps_save' );
add_action( 'wp_ajax_nopriv_psyco_maps_save', 'psyco_maps_save' );

function psyco_maps_save(){
      psyco_maps_update_option( 'apimaps', $_POST['apimaps']);
      psyco_maps_update_option( 'maps_postorpage', $_POST['maps_postorpage'] );
      psyco_maps_update_option( 'maps_yesornot', $_POST['maps_yesornot'] );
      psyco_maps_update_option( 'maps_c_style', stripslashes($_POST['maps_c_style']) );
      echo "Saved";
    exit();
}

function adding_psyco_maps_meta_boxes( $post_type, $post ) {

  if ( psyco_maps_get_option('maps_postorpage') == 2 ) {
    $arr_p_o_p = array('post','page');
  }elseif ( psyco_maps_get_option('maps_postorpage') == 1 ) {
    $arr_p_o_p = array('post');
  }else{
    $arr_p_o_p = array('page');
  }

  add_meta_box(
          'psyco-maps-box',
          __( 'psyco maps' ),
          'psyco_maps_meta_cb',
          $arr_p_o_p,
          'normal',
          'default'
  );
}
add_action( 'add_meta_boxes', 'adding_psyco_maps_meta_boxes', 10, 2 );

function psyco_maps_meta_cb(){
   include 'include/page-option.php';
}

function psyco_maps_short_cb( $atts,$content="null" ) {
     $a = shortcode_atts( array(
	      'width' => '250px',
	      'height' => '250px',
        'padding' => '15px 10px 15px 10px',
        'margin' => '15px 10px 15px 10px',
        'center' => '',
        'style' => 'null',
	      'zoom' => '14',
        'description' => '',
        'draggable'=> 'true',
        'streetviewcontrol' => 'true',
        'map_id' => ''
     ), $atts );

     $rand = rand(1,100);
$content = do_shortcode($content);
    ob_start();

       include 'include/create-maps.php';

    return ob_get_clean();
}
add_shortcode( 'psyco_maps', 'psyco_maps_short_cb' );

function psyco_maps_marker_cb( $atts,$content="null" ) {
     $a = shortcode_atts( array(
        'position'=>'',
        'name'=>'aversa',
        'id'  => '',
        'map_id' => '',
        'title'  => '',
        'radius'=> 'true',
        'rdistance'=> '',
           ), $atts );

     $content = $content;
     $LatLng = explode(',',$a['position']);
     $lat = $LatLng[0];
     $lng = $LatLng[1];

     ob_start();

       include 'include/marker-maps.php';

    return ob_get_clean();
}
add_shortcode( 'psyco_maps_marker', 'psyco_maps_marker_cb' );

function psyco_maps_enqueue_script() {
  if (psyco_maps_get_option('maps_yesornot') == '0') {
    wp_enqueue_script('apimapsjs','http://maps.google.com/maps/api/js?key='.psyco_maps_get_option('apimaps'));
  }
  wp_enqueue_style( 'psyco_maps_css', plugins_url(PSYCO_MAPS_NAME.'/include/css/psyco_maps.css') );
}
add_action( 'wp_enqueue_scripts', 'psyco_maps_enqueue_script');
?>
