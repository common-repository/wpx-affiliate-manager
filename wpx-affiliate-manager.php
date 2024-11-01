<?php
/*
Plugin Name: WPX Affiliate Manager
Plugin URI: http://wpxprt.com/wpx-affiliate-manager/
Description: WPX Affiliate Manager allows you to integrate affiliate 125 x 125 images side by side into your site through a widget.
Version: 0.4.1
Author: Wordpress Expert
Author URI: http://wpxprt.com

------------------------------------------------------------------------
Copyright 2012 Wordpress Expert (wpxprt.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/
	
// define constants
define('WPXAM_VERSION', '0.4.1');

if (!defined('WPXAM_PLUGIN_BASENAME')) {
    define('WPXAM_PLUGIN_BASENAME', plugin_basename(__FILE__));
}
if (!defined('WPXAM_PLUGIN_NAME')) {
    define('WPXAM_PLUGIN_NAME', trim(dirname(WPXAM_PLUGIN_BASENAME), '/'));
}
if (!defined('WPXAM_PLUGIN_URL')) {
    define('WPXAM_PLUGIN_URL', WP_PLUGIN_URL . '/' . WPXAM_PLUGIN_NAME);
}

add_action('admin_menu', 'wpx_am_menu');

function wpx_am_GetReturnLocation(){
	$currentLocation = "http";
	$currentLocation .= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? "s" : "")."://";
	$currentLocation .= $_SERVER['SERVER_NAME'];
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
		if($_SERVER['SERVER_PORT']!='443') {
			$currentLocation .= ":".$_SERVER['SERVER_PORT'];
		}
	}
	else {
		if($_SERVER['SERVER_PORT']!='80') {
			$currentLocation .= ":".$_SERVER['SERVER_PORT'];
		}
	}
	$currentLocation .= $_SERVER['REQUEST_URI'];
	echo $currentLocation;
}
	
function wpx_am_menu() {
	add_options_page('WPX Affiliate Manager Options', 'WPX Affiliate Manager', 'manage_options', WPXAM_PLUGIN_BASENAME, 'wpx_am_options');
}

function wpx_am_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	if (isset($_POST['submitted'])) {

		$widget_title=(!isset($_POST['WidgTit'])? '': $_POST['WidgTit']);

		$ad1_url=(!isset($_POST['Ad1Destination'])? '': $_POST['Ad1Destination']);
		$ad1_img=(!isset($_POST['Ad1Img'])? '': $_POST['Ad1Img']);
		$ad2_url=(!isset($_POST['Ad2Destination'])? '': $_POST['Ad2Destination']);
		$ad2_img=(!isset($_POST['Ad2Img'])? '': $_POST['Ad2Img']);
		$ad3_url=(!isset($_POST['Ad3Destination'])? '': $_POST['Ad3Destination']);
		$ad3_img=(!isset($_POST['Ad3Img'])? '': $_POST['Ad3Img']);
		$ad4_url=(!isset($_POST['Ad4Destination'])? '': $_POST['Ad4Destination']);
		$ad4_img=(!isset($_POST['Ad4Img'])? '': $_POST['Ad4Img']);
		$ad5_url=(!isset($_POST['Ad5Destination'])? '': $_POST['Ad5Destination']);
		$ad5_img=(!isset($_POST['Ad5Img'])? '': $_POST['Ad5Img']);
		$ad6_url=(!isset($_POST['Ad6Destination'])? '': $_POST['Ad6Destination']);
		$ad6_img=(!isset($_POST['Ad6Img'])? '': $_POST['Ad6Img']);

		update_option('WidgTit', $widget_title);

		update_option('Ad1Destination', $ad1_url );
		update_option('Ad1Img', $ad1_img );
		update_option('Ad2Destination', $ad2_url );
		update_option('Ad2Img', $ad2_img );
		update_option('Ad3Destination', $ad3_url );
		update_option('Ad3Img', $ad3_img );
		update_option('Ad4Destination', $ad4_url );
		update_option('Ad4Img', $ad4_img );
		update_option('Ad5Destination', $ad5_url );
		update_option('Ad5Img', $ad5_img );
		update_option('Ad6Destination', $ad6_url );
		update_option('Ad6Img', $ad6_img );
		
		$msg_status = 'WPX Affiliate Manager options saved.';

	   _e('<div id="message" class="updated fade"><p>' . $msg_status . '</p></div>');

	}

	$widget_title = get_option('WidgTit');
	
	$ad1_img = get_option('Ad1Img');
	$ad1_url = get_option('Ad1Destination');
	$ad2_img = get_option('Ad2Img');
	$ad2_url = get_option('Ad2Destination');
	$ad3_img = get_option('Ad3Img');
	$ad3_url = get_option('Ad3Destination');
	$ad4_img = get_option('Ad4Img');
	$ad4_url = get_option('Ad4Destination');
	$ad5_img = get_option('Ad5Img');
	$ad5_url = get_option('Ad5Destination');
	$ad6_img = get_option('Ad6Img');
	$ad6_url = get_option('Ad6Destination');
	
	?>
		<div class="wrap">
			<div>
			<?php screen_icon(); ?>
			<h2>WPX Affiliate Manager Settings</h2>
			<br class="clear"/>
			
			<div class="postbox-container" style="width: 69%;">
			<div id="poststuff">
				<div id="wpx-am-settings" class="postbox">
					<h3 id="settings">Settings</h3>
		
					<div class="inside">
                    	<strong>Currently We Only Support 125x125 Size Images.<br/>
                        We strongly recommend you host the images to bypass ad blockers.</strong>
						<form name="wpx-am-settings-update" method="post">
                        <input type="hidden" name="submitted" value="1" />
						
						<table class="form-table">
							<tr>
								<th scope="row">
									<label for="WidgTit">Widget Title:</label>
								</th>
								<td>
									<input id="WidgTit" class="WPXAMUrl" type="text" size="50" name="WidgTit" value="<?php echo $widget_title ?>" />
								</td>
							</tr>
                            
							<tr>
								<th scope="row">
									<label for="Ad1Img">Ad1 Image:</label>
								</th>
								<td>
									<input id="Ad1Img" class="WPXAMUrl" type="text" size="50" name="Ad1Img" value="<?php echo $ad1_img ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="Ad1Destination">Ad1 Destination:</label>
								</th>
								<td>
									<input id="Ad1Destination" class="WPXAMUrl" type="text" size="50" name="Ad1Destination" value="<?php echo $ad1_url ?>" />
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="Ad2Img">Ad2 Image:</label>
								</th>
								<td>
									<input id="Ad2Img" class="WPXAMUrl" type="text" size="50" name="Ad2Img" value="<?php echo $ad2_img ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="Ad2Destination">Ad2 Destination:</label>
								</th>
								<td>
									<input id="Ad2Destination" class="WPXAMUrl" type="text" size="50" name="Ad2Destination" value="<?php echo $ad2_url ?>" />
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="Ad3Img">Ad3 Image:</label>
								</th>
								<td>
									<input id="Ad3Img" class="WPXAMUrl" type="text" size="50" name="Ad3Img" value="<?php echo $ad3_img ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="Ad3Destination">Ad3 Destination:</label>
								</th>
								<td>
									<input id="Ad3Destination" class="WPXAMUrl" type="text" size="50" name="Ad3Destination" value="<?php echo $ad3_url ?>" />
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="Ad4Img">Ad4 Image:</label>
								</th>
								<td>
									<input id="Ad4Img" class="WPXAMUrl" type="text" size="50" name="Ad4Img" value="<?php echo $ad4_img ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="Ad4Destination">Ad4 Destination:</label>
								</th>
								<td>
									<input id="Ad4Destination" class="WPXAMUrl" type="text" size="50" name="Ad4Destination" value="<?php echo $ad4_url ?>" />
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="Ad5Img">Ad5 Image:</label>
								</th>
								<td>
									<input id="Ad5Img" class="WPXAMUrl" type="text" size="50" name="Ad5Img" value="<?php echo $ad5_img ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="Ad5Destination">Ad5 Destination:</label>
								</th>
								<td>
									<input id="Ad5Destination" class="WPXAMUrl" type="text" size="50" name="Ad5Destination" value="<?php echo $ad5_url ?>" />
								</td>
							</tr>
							
							<tr>
								<th scope="row">
									<label for="Ad6Img">Ad6 Image:</label>
								</th>
								<td>
									<input id="Ad6Img" class="WPXAMUrl" type="text" size="50" name="Ad6Img" value="<?php echo $ad6_img ?>" />
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="Ad6Destination">Ad6 Destination:</label>
								</th>
								<td>
									<input id="Ad6Destination" class="WPXAMUrl" type="text" size="50" name="Ad6Destination" value="<?php echo $ad6_url ?>" />
								</td>
							</tr>
						</table>
						
					</div>
				</div>
			</div>
            
            <div class="submit">
				<input type="submit" name="submitted" class="button-primary" value="Update options &raquo;" />
			</div>
            </form>
		
			<div id="poststuff">
				<div id="wpx-am-tips" class="postbox">
					<h3 id="MoreInfo">More Information</h3>
		
					<div class="inside">
					  <table class="form-table">
						<tr>
							<th scope="row">
								<label for="PluginSite">Plugin Site:</label>
							</th>
							<td id="PluginSite">
								<a href="http://wpxprt.com/" target="_blank">Official Site</a>.
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="PluginForums">Plugin Social:</label>
							</th>
							<td id="PluginForums">
								<a href="http://facebook.com/wpxprt/" target="_blank">Facebook Page</a>
                                <a href="http://twitter.com/wpxprt/" target="_blank">Twitter Page</a>
							</td>
						</tr>
					  </table>
					</div>
				</div>
			</div>
			<div class="clear">
            <p>
            	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="EWM7CSB98D4M2">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </p>
				<p>
					<br/>&copy; Copyright 2012 - <?php echo date("Y"); ?> <a href="http://wpxprt.com">Wordpress Expert</a>
				</p>
			</div>
		
		</div>
		
<?php
}

class wpx_am_widget extends WP_Widget {

    function wpx_am_widget() {
        $widget_options = array( 'classname' => 'widget_wpx_am', 'description' => __( 'Display Affiliate Ads.', 'wpx_am_widget' ) );
        $this->WP_Widget( 'wpx_am_widget', __( 'WPX Affiliate Manager', 'wpx_am_widget' ), $widget_options );
		wp_enqueue_style('wpx_am_widget', plugins_url('/css/wpx-affiliate-manager.css',__FILE__) );
    }

    function widget($args, $instance) {
        extract($args, EXTR_SKIP);
        $title = get_option('WidgTit');
        $ads = array();

        if(get_option('Ad1Img')) {
            $ads[] = array (
                'img' => get_option('Ad1Img'),
                'link' => get_option('Ad1Destination')
            );
        }

        if(get_option('Ad2Img')) {
            $ads[] = array (
                'img' => get_option('Ad2Img'),
                'link' => get_option('Ad2Destination')
            );
        }

        if(get_option('Ad3Img')) {
            $ads[] = array (
                'img' => get_option('Ad3Img'),
                'link' => get_option('Ad3Destination')
            );
        }

        if(get_option('Ad4Img')) {
            $ads[] = array (
                'img' => get_option('Ad4Img'),
                'link' => get_option('Ad4Destination')
            );
        }

        if(get_option('Ad5Img')) {
            $ads[] = array (
                'img' => get_option('Ad5Img'),
                'link' => get_option('Ad5Destination')
            );
        }

        if(get_option('Ad6Img')) {
            $ads[] = array (
                'img' => get_option('Ad6Img'),
                'link' => get_option('Ad6Destination')
            );
        }
		
        $i = 1;
        $ad_num = count($ads);

        if($title) {
                echo '<h4>' . $title . '</h4>';
        }

        echo '<div class="ad-square-buttons">';
		foreach($ads as $ad) {
			echo '<a href="' . $ad['link'] . '" target="_blank">';
			echo '<img src="' . $ad['img'] .'" alt="img" width="125" height="125">';
			echo '</a>';

			if($i%2 == 0 || $i == $ad_num) {
				echo '<div class="clear"></div>';
			}
			$i++;
		}
        echo '</div>';
    }

    function form($instance) {
        $defaults = '';
?>
<p>Setup this widget in Settings > WPX Affiliate Manager</p>
<?php
    }
}
add_action( 'widgets_init', create_function('', 'return register_widget("wpx_am_widget");') );

?>