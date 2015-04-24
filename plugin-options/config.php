<?php
/**
 * Config file for HybridAuth Class
 *
 * @author Yithemes
 * @package YITH WooCommerce Social Login
 * @version 1.0.0
 */

return array(
	'base_url' => YITH_YWSL_URL . 'includes/hybridauth/',
	'providers' => array (
		'Google' => array (
			'enabled' => ( get_option('ywsl_google_enable') == 'yes') ? true: false,
			'keys'    => array (
				'id'     => get_option( 'ywsl_google_id' ),
				'secret' => get_option( 'ywsl_google_secret' )
			)
		),

		'Facebook' => array (
			'enabled' => ( get_option('ywsl_facebook_enable') == 'yes') ? true: false,
			'keys'    => array (
				'id'     => get_option( 'ywsl_facebook_id' ),
				'secret' => get_option( 'ywsl_facebook_secret' ))
		),

		'Twitter' => array (
			'enabled' => ( get_option('ywsl_twitter_enable') == 'yes') ? true: false,
			'keys'    => array (
				'key'    => get_option( 'ywsl_twitter_key' ),
				'secret' => get_option( 'ywsl_twitter_secret' )
			)
		)
	),
	'debug_mode' => false,
	'debug_file' => YITH_YWSL_DIR.'logs/log.txt',
);