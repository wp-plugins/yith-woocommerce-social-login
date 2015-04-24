<?php
/**
 * Main class
 *
 * @author Yithemes
 * @package YITH WooCommerce Social Login
 * @version 1.0.0
 */

if ( ! defined( 'YITH_YWSL_INIT' ) ) {
	exit;
} // Exit if accessed directly

if( ! class_exists( 'YITH_WC_Social_Login' ) ){
	/**
	 * YITH WooCommerce Social Login main class
	 *
	 * @since 1.0.0
	 */
	class YITH_WC_Social_Login {

		/**
		 * Single instance of the class
		 *
		 * @var \YITH_WC_Social_Login
		 * @since 1.0.0
		 */
		protected static $instance;

		/**
		 * Array with accessible variables
		 */
		protected $_data = array();

		/**
		 * Array with config parameters
		 */
		protected $config = array();

		/**
		 * HybridAuth Object
		 */
		protected $hybridauth;

		/**
		 * Returns single instance of the class
		 *
		 * @return \YITH_WC_Social_Login
		 * @since 1.0.0
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @return \YITH_WC_Social_Login
		 * @since 1.0.0
		 */
		public function __construct() {
			/* plugin */
			add_action( 'after_setup_theme', array( $this, 'plugin_fw_loader' ), 1 );
			require_once(YITH_YWSL_INC.'hybridauth/Hybrid/Auth.php');

			$this->_set_config();
			$this->_set_social_list();
			$this->_set_social_list_enabled();

            if( defined('YITH_YWSL_FREE_INIT') ) {
                add_shortcode( 'yith_wc_social_login', array( $this, 'yith_wc_social_login_shortcode' ) );
            }
			$this->hybridauth = new Hybrid_Auth( $this->config );
			add_action('init', array($this,'get_login_request'));
		}

		/**
		 * Return a $property defined in this class
		 *
		 * @since   1.0.0
		 * @author  Emanuela Castorina <emanuela.castorina@yithemes.com>
		 * @return  mix
		 */
		public function __get( $property ){
			if ( isset( $this->_data[$property] ) ) {
				return $this->_data[$property];
			}
		}

		/**
		 * Load YIT Plugin Framework
		 *
		 * @since  1.0.0
		 * @return void
		 * @author Andrea Grillo <andrea.grillo@yithemes.com>
		 */
		public function plugin_fw_loader() {
			if ( !defined( 'YIT' ) || !defined( 'YIT_CORE_PLUGIN' ) ) {
				require_once( YITH_YWSL_DIR.'/plugin-fw/yit-plugin.php' );
			}
		}

		/**
		 * Set the configuration array for Hybrid Class
		 *
		 * @since  1.0.0
		 * @return void
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		private function _set_config() {
			$this->config = include( YITH_YWSL_DIR . '/plugin-options/config.php' );
		}

		/**
		 * Set an array with the social list
		 *
		 * @since  1.0.0
		 * @return void
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		private function _set_social_list() {
			$this->_data['social_list'] = include( YITH_YWSL_DIR . '/plugin-options/socials.php' );
		}

		/**
		 * Main function to login with social providers
		 *
		 * @since  1.0.0
		 * @return void
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		public function get_login_request(){
			if ( isset( $_REQUEST['ywsl_social'] ) && isset( $this->_data['social_list'] [$_REQUEST['ywsl_social']] ) ) {
				$social = $_REQUEST['ywsl_social'];
				$social_name = $this->_data['social_list'] [$_REQUEST['ywsl_social']]['label'];

				if ( ! isset( $this->config['providers'][$social_name]) || get_option( 'ywsl_'.$social.'_enable' ) != 'yes' ) {
					return;
				}

				try {
					$adapter      = $this->hybridauth->authenticate( $social_name );
					$user_profile = $adapter->getUserProfile();

				} catch ( Exception $e ) {
					echo $this->get_error( $e->getCode() );
					$this->hybridauth->logoutAllProviders();
					exit;
				}



				$registration_check = $this->verify_user( $social, $user_profile->identifier );


				if ( $registration_check ) {
					//registration with this provider exists
					wp_set_auth_cookie( $registration_check, true );

					wp_safe_redirect( $this->get_redirect_to() );
					exit;
				}
				else {

					$hyb_email                = sanitize_email($user_profile->email);
					$hyb_user_login           = sanitize_user($user_profile->displayName, true);
					$hyb_user_avatar          = $user_profile->photoURL;

					$yith_user_login          = $this->get_username( $hyb_user_login, $hyb_email );
					$yith_user_email          = $this->get_email( $hyb_email );

					$yith_user_login_validate = validate_username ( $yith_user_login );
					$yith_user_email_validate = filter_var( $yith_user_email, FILTER_VALIDATE_EMAIL ) ;


					if( empty( $yith_user_login ) ) $yith_user_login_validate = false;
					if( empty( $yith_user_email ) ) $yith_user_email_validate = false;

					$show_form        = false;
					$show_email       = false;
					$show_username    = false;
					$show_form_errors = array();

					if( ! $yith_user_email || ! $yith_user_email_validate ){
						$show_form          = true;
						$show_email         = true;
						$show_form_errors[] = __('Your email address is not valid!', 'ywsl') ;
					}

					if( ! $yith_user_login || ! $yith_user_login_validate ){
						$show_form          = true;
						$show_username      = true;
						$show_form_errors[] = __('Username is not valid!', 'ywsl') ;
					}

					if( $show_form ){
						$args = array(
							'errors'     => $show_form_errors,
							'avatar'     => $hyb_user_avatar,
							'show_user'  => $show_username,
							'show_email' => $show_email,
							'provider'   => $social,
							'redirect'   => $this->get_redirect_to()
						);


						yit_plugin_get_template( YITH_YWSL_DIR,'request-info.php', $args);
						exit;
					}else{
						//verify if exist an user with that email
						$current_customer_id = $this->verify_email_exists( $yith_user_email );

						if(! $current_customer_id){
							//create user
							$current_customer_id = $this->add_user( $yith_user_login, $yith_user_email, $user_profile );
						}

						//link account
						add_user_meta( $current_customer_id, $social.'_login_id', $user_profile->identifier, true );
						add_user_meta( $current_customer_id, $social.'_login_data', (array) $user_profile, true );

						wp_set_auth_cookie( $current_customer_id, true );
						wp_safe_redirect( $this->get_redirect_to() );
						exit;

					}

				}

			}
		}

		/**
		 * Return the username of user
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function get_username( $hyb_user_login, $hyb_user_email ) {

			$yith_user_login = isset( $_REQUEST["yith_user_login"] ) ? $_REQUEST["yith_user_login"] : '';

			if ( !empty( $yith_user_login ) ) {
				if ( get_option( 'woocommerce_registration_generate_username' ) == 'yes' && !empty( $hyb_user_email ) ) {
					$yith_user_login = sanitize_user( current( explode( '@', $hyb_user_email ) ) );
					if ( username_exists( $yith_user_login ) ) {
						$append     = 1;
						$o_username = $yith_user_login;

						while ( username_exists( $yith_user_login ) ) {
							$yith_user_login = $o_username . $append;
							$append ++;
						}
					}
				}
			} else {
				$yith_user_login = sanitize_user( $hyb_user_login, true );
				$yith_user_login = trim( str_replace( array( ' ', '.' ), '_', $yith_user_login ) );
				$yith_user_login = trim( str_replace( '__', '_', $yith_user_login ) );
			}

			return $yith_user_login;

		}

		/**
		 * Return the email of user
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function get_email( $hyb_user_email ) {

			$yith_user_email = isset( $_REQUEST["yith_user_email"] ) ? $_REQUEST["yith_user_email"] : '';

			if ( empty( $yith_user_email ) ) {
				$yith_user_email = $hyb_user_email;
			} else {
				$yith_user_email = sanitize_email( $yith_user_email );
			}

			return $yith_user_email;

		}

		/**
		 * Check if the customer has a connection with the provider
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		public function verify_user( $social, $identifier ) {
			global $wpdb;

			$usermeta_table = $wpdb->prefix . 'usermeta';
			$query          = $wpdb->prepare( 'SELECT user_id FROM ' . $usermeta_table . ' WHERE meta_key = "%s" AND  meta_value= "%s"', $social . '_login', $identifier );
			$user_id        = $wpdb->get_var( $query );
			if ( $user_id ) {
				return $user_id;
			} else {
				return false;
			}

		}

		/**
		 * Check if exists an user with an email like $user_email
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		public function verify_email_exists( $user_email ) {
			global $wpdb;
			$use_table = $wpdb->prefix . 'users';
			$query     = $wpdb->prepare( 'SELECT ID FROM ' . $use_table . ' WHERE user_email = "%s"', $user_email );
			$user_id   = $wpdb->get_var( $query );
			if ( $user_id ) {
				return $user_id;
			} else {
				return false;
			}
		}

		/**
		 * Add a new user
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		public function add_user( $username, $user_email, $user_info ){

			$password = wp_generate_password();
			$args = array(
				'user_login' => $username,
				'user_pass'  => $password,
				'user_email' => $user_email,
				'role'       => apply_filters('ywsl_new_user_role','customer')
			);
			$customer_id = wp_insert_user( $args );

			$this->add_user_meta( $customer_id, $user_info, $user_email );

			return $customer_id;
		}

		/**
		 * Add meta to user from provider's user info
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		public function add_user_meta( $user_id, $user_info, $user_email ){

			add_user_meta( $user_id, 'billing_email', $user_email, true );

			if ( isset( $user_info->description ) ) {
				add_user_meta( $user_id, 'description', $user_info->description, true );
			}
			if ( isset( $user_info->firstName ) ) {
				add_user_meta( $user_id, 'billing_first_name', $user_info->firstName, true );
				add_user_meta( $user_id, 'shipping_first_name', $user_info->firstName, true );
			}
			if ( isset( $user_info->lastName ) ) {
				add_user_meta( $user_id, 'billing_last_name', $user_info->firstName, true );
				add_user_meta( $user_id, 'shipping_last_name', $user_info->firstName, true );
			}
			if ( isset( $user_info->phone ) ) {
				add_user_meta( $user_id, 'billing_phone', $user_info->phone, true );
			}
			if ( isset( $user_info->address ) ) {
				add_user_meta( $user_id, 'billing_address_1', $user_info->address, true );
				add_user_meta( $user_id, 'shipping_address_1', $user_info->address, true );
			}
			if ( isset( $user_info->country ) ) {
				add_user_meta( $user_id, 'billing_country', $user_info->country, true );
				add_user_meta( $user_id, 'shipping_country', $user_info->country, true );
			}
			if ( isset( $user_info->region ) ) {
				add_user_meta( $user_id, 'billing_state', $user_info->region, true );
				add_user_meta( $user_id, 'shipping_state', $user_info->region, true );
			}
			if ( isset( $user_info->city ) ) {
				add_user_meta( $user_id, 'billing_city', $user_info->city, true );
				add_user_meta( $user_id, 'shipping_city', $user_info->city, true );
			}
			if ( isset( $user_info->zip ) ) {
				add_user_meta( $user_id, 'billing_postcode', $user_info->zip, true );
				add_user_meta( $user_id, 'shipping_postcode', $user_info->zip, true );
			}

		}

		/**
		 * Return the string of error
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		public function get_error($e_code){
			$error = '';
			switch( $e_code ){
				case 0 :
					$error = __( 'Unspecified error.', 'ywsl' );
					break;
				case 1 :
					$error = __( 'Hybriauth configuration error.', 'ywsl' );
					break;
				case 2 :
					$error = __( 'Provider not properly configured.', 'ywsl' );
					break;
				case 3 :
					$error = __( 'Unknown or disabled provider.', 'ywsl' );
					break;
				case 4 :
					$error = __( 'Missing provider application credentials.', 'ywsl' );
					break;
				case 5 :
					$error = __( 'Authentification failed. The user has canceled the authentication or the provider refused the connection.', 'ywsl' );
					break;
				case 6 :
					$error = __( 'User profile request failed. User might not be connected to the provider and have to authenticate again.', 'ywsl' );
					break;
				case 7 :
					$error = __( 'User not connected to the provider.', 'ywsl' );
					break;
				case 8 :
					$error = __( 'Provider does not support this feature.', 'ywsl' );
					break;
			}
			return $error;
		}

		/**
		 * Return the page to redirect the user
		 *
		 * @since  1.0.0
		 * @return string
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		function get_redirect_to() {

			$redirect_to = site_url();

			// get a valid $redirect_to
			if ( isset( $_REQUEST['redirect'] ) && $_REQUEST['redirect'] != '' ) {
				$redirect_to_url = $_REQUEST['redirect'];

				if ( !( strpos( $redirect_to_url, 'wp-admin' ) || strpos( $redirect_to_url, 'wp-login.php' ) ) ) {
					$redirect_to = $redirect_to_url;
					// Redirect to https if user wants ssl
					if ( isset( $secure_cookie ) && $secure_cookie && false !== strpos( $redirect_to, 'wp-admin' ) ) {
						$redirect_to = preg_replace( '|^http://|', 'https://', $redirect_to );
					}
				}

			}

			return apply_filters( 'ywsl_redirect_to_after_login', $redirect_to );
		}

		/**
		 * Set the social providers enabled
		 *
		 * @since  1.0.0
		 * @return void
		 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
		 */
		private function _set_social_list_enabled(){
			$enabled_social = array();
			foreach( $this->social_list as $key=>$value){
				$enabled = get_option('ywsl_'.$key.'_enable');
				if( $enabled == 'yes'){
					$enabled_social[$key] = $value;
				}
			}

			$this->_data['enabled_social'] = $enabled_social;
		}

        /**
         * Print the Social Login Buttons
         *
         * @since  1.0.0
         * @return string
         * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
         */
        public function yith_wc_social_login_shortcode( $atts  ){
            return YITH_WC_Social_Login_Frontend()->social_buttons( '', true);
        }

	}

	/**
	 * Unique access to instance of YITH_WC_Social_Login class
	 *
	 * @return \YITH_WC_Social_Login
	 */
	function YITH_WC_Social_Login() {
		return YITH_WC_Social_Login::get_instance();
	}

}

