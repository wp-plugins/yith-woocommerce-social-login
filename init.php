<?php
/*
Plugin Name: YITH WooCommerce Social Login
Description: YITH WooCommerce Social login is a plugin that allows you to login to your e-commerce site through your Facebook or Twitter or Google+ account.
Version: 1.0.1
Author: Yithemes
Author URI: http://yithemes.com/
Text Domain: ywsl
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
 * @package YITH WooCommerce Social Login
 * @since   1.0.0
 * @author  Yithemes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

// This version can't be activate if premium version is active  ________________________________________
if ( defined( 'YITH_YWSL_PREMIUM' ) ) {
    function yith_ywsl_install_free_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'You can\'t activate the free version of YITH Woocommerce Social Login while you are using the premium one.', 'ywraq' ); ?></p>
        </div>
    <?php
    }

    add_action( 'admin_notices', 'yith_ywsl_install_free_admin_notice' );

    deactivate_plugins( plugin_basename( __FILE__ ) );
    return;
}

// Registration hook  ________________________________________
if ( !function_exists( 'yith_plugin_registration_hook' ) ) {
    require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

if ( !function_exists( 'yith_ywsl_install_woocommerce_admin_notice' ) ) {
	function yith_ywsl_install_woocommerce_admin_notice() {
		?>
		<div class="error">
			<p><?php _e( 'YITH Woocommerce Social Login is enabled but not effective. It requires Woocommerce in order to work.', 'ywsl' ); ?></p>
		</div>
	<?php
	}
}

// Define constants ________________________________________
if ( defined( 'YITH_YWSL_VERSION' ) ) {
    return;
}else{
    define( 'YITH_YWSL_VERSION', '1.0.1' );
}

if ( ! defined( 'YITH_YWSL_FREE_INIT' ) ) {
    define( 'YITH_YWSL_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_YWSL_INIT' ) ) {
    define( 'YITH_YWSL_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_YWSL_FILE' ) ) {
    define( 'YITH_YWSL_FILE', __FILE__ );
}

if ( ! defined( 'YITH_YWSL_DIR' ) ) {
    define( 'YITH_YWSL_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YITH_YWSL_URL' ) ) {
    define( 'YITH_YWSL_URL', plugins_url( '/', __FILE__ ) );
}

if ( ! defined( 'YITH_YWSL_ASSETS_URL' ) ) {
    define( 'YITH_YWSL_ASSETS_URL', YITH_YWSL_URL . 'assets' );
}

if ( ! defined( 'YITH_YWSL_TEMPLATE_PATH' ) ) {
    define( 'YITH_YWSL_TEMPLATE_PATH', YITH_YWSL_DIR . 'templates' );
}

if ( ! defined( 'YITH_YWSL_INC' ) ) {
    define( 'YITH_YWSL_INC', YITH_YWSL_DIR . '/includes/' );
}


if ( ! function_exists( 'yith_ywsl_install' ) ) {
	function yith_ywsl_install() {

		if ( !function_exists( 'WC' ) ) {
			add_action( 'admin_notices', 'yith_ywsl_install_woocommerce_admin_notice' );
		} else {
			do_action( 'yith_ywsl_init' );
		}
	}

	add_action( 'plugins_loaded', 'yith_ywsl_install', 11 );
}


function yith_ywsl_constructor() {

    // Load YWSL text domain ___________________________________
    load_plugin_textdomain( 'ywsl', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


	if(session_id() == '') {
		session_start();
	}

    require_once( YITH_YWSL_INC . 'functions.yith-social-login.php' );
    require_once( YITH_YWSL_INC . 'class-yith-social-login.php' );
    if ( is_admin() ) {
        require_once( YITH_YWSL_INC . 'class-yith-social-login-admin.php' );
        YITH_WC_Social_Login_Admin();
    }
    else {
        require_once( YITH_YWSL_INC . 'class-yith-social-login-frontend.php' );
        YITH_WC_Social_Login_Frontend();
    }

    YITH_WC_Social_Login();

}
add_action( 'yith_ywsl_init', 'yith_ywsl_constructor' );