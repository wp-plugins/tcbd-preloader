<?php

	// Exit if accessed directly
	defined( 'ABSPATH' ) || exit;

	function tcbd_preloader_settings() {
		add_plugins_page( 'Preloader Settings', 'TCBD Preloader', 'update_core', 'tcbd_preloader_settings', 'tcbd_preloader_settings_page');
	}
	add_action( 'admin_menu', 'tcbd_preloader_settings' );
	
	function tcbd_preloader_register_settings() {
		register_setting( 'tcbd_preloader_register_setting', 'tcbdpreloader_bg_color' );
		register_setting( 'tcbd_preloader_register_setting', 'tcbdpreloader_image' );
	}
	add_action( 'admin_init', 'tcbd_preloader_register_settings' );
		
	function tcbd_preloader_settings_page(){ // settings page function
		if( get_option('tcbdpreloader_bg_color') ){
			$background_color = get_option('tcbdpreloader_bg_color');
		}else{
			$background_color = '#FFFFFF';
		}
		
		if( get_option('tcbdpreloader_image') ){
			$preloader_image = get_option('tcbdpreloader_image');
		}else{
			$preloader_image = plugins_url( '/img/loader-grey.GIF', __FILE__ );
		}
		?>
			<div class="wrap">
				<h2>TCBD Preloader Settings</h2>
                
				<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ){ ?>
					<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
						<p><strong>Settings saved.</strong></p>
                        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
					</div>
				<?php } ?>
                
            	<form method="post" action="options.php">
                	<?php settings_fields( 'tcbd_preloader_register_setting' ); ?>
                    
                	<table class="form-table">
                		<tbody>
                        
                    		<tr>
                        		<th scope="row"><label for="tcbdpreloader_bg_color">Background Color</label></th>
                            	<td>
                                    <input class="regular-text" name="tcbdpreloader_bg_color" type="text" id="tcbdpreloader_bg_color" value="<?php echo esc_attr( $background_color ); ?>">
                                    <p class="description">Enter background color code, default color is white #FFFFFF.</p>
								</td>
                        	</tr>
                            
                    		<tr>
                        		<th scope="row"><label for="tcbdpreloader_image">Preloader Image</label></th>
                            	<td>
                                    <input class="regular-text" name="tcbdpreloader_image" type="text" id="tcbdpreloader_image" value="<?php echo esc_attr( $preloader_image ); ?>">
                                    <p class="description">Enter preloader image link, image size must to be 128x128 to be retina ready, <a href="http://preloaders.net" target="_blank">get free preloader image</a>.</p>
								</td>
                        	</tr>
                            
                    	</tbody>
                    </table>
                    
                    <p class="submit"><input id="submit" class="button button-primary" type="submit" name="submit" value="Save Changes"></p>
                </form>
                
            </div>
        <?php
	} // settings page function






?>