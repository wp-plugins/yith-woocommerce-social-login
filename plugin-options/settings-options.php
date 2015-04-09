<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


return array(

	'settings' => array(

        'section_general_settings_videobox'         => array(
            'name' => __( 'Upgrade to the PREMIUM VERSION', 'ywsl' ),
            'type' => 'videobox',
            'default' => array(
                'plugin_name'        => __( 'YITH WooCommerce Social Login', 'ywsl' ),
                'title_first_column' => __( 'Discover Advanced Features', 'ywsl' ),
                'description_first_column' => __('Upgrade to the PREMIUM VERSION
of YITH WooCommerce Social Login to benefit from all features!', 'ywsl'),
                'video' => array(
                    'video_id'           => '118792418',
                    'video_image_url'    =>  YITH_YWSL_ASSETS_URL.'/images/yith-woocommerce-social-login.jpg',
                    'video_description'  => __( 'YITH WooCommerce Social Login', 'yit' ),
                ),
                'title_second_column' => __( 'Get Support and Pro Features', 'ywsl' ),
                'description_second_column' => __('By purchasing the premium version of the plugin, you will benefit from the advanced features of the product and you will get one year of free update and support through our platform available 24h/24.', 'ywsl'),
                'button' => array(
                    'href' => 'http://yithemes.com/themes/plugins/yith-woocommerce-social-login/',
                    'title' => 'Get Support and Pro Features'
                )
            ),
            'id'   => 'ywsl_general_videobox'
        ),

		'section_general_settings'     => array(
			'name' => __( 'General settings', 'ywsl' ),
			'type' => 'title',
			'id'   => 'ywsl_section_general'
		),

        'social_label' => array(
            'name'    => __( 'Label', 'ywsl' ),
            'desc'    => __( 'Change content of the label to display above social login buttons', 'ywsl' ),
            'id'      => 'ywsl_social_label',
            'default' => __('Login with:', 'ywsl'),
            'type'    => 'text'
        ),

        'social_label_checkout' => array(
            'name'    => __( 'Description in checkout page', 'ywsl' ),
            'desc'    => __( 'Change content of the description in checkout page', 'ywsl' ),
            'id'      => 'ywsl_social_label_checkout',
            'default' => __('Social sign-in', 'ywsl'),
            'type'    => 'text'
        ),

        'section_general_settings_end' => array(
			'type' => 'sectionend',
			'id'   => 'ywsl_section_general_end'
		),

        'section_facebook_settings'     => array(
            'name' => __( 'Facebook settings', 'ywsl' ),
            'type' => 'title',
            'id'   => 'ywsl_section_facebook'
        ),

        'facebook_enable' => array(
            'name'    => __( 'Enable Facebook Login', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_facebook_enable',
            'default' => 'no',
            'type'    => 'checkbox'
        ),

        'facebook_id' => array(
            'name'    => __( 'Facebook App Id', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_facebook_id',
            'default' => '',
            'type'    => 'text'
        ),

        'facebook_secret' => array(
            'name'    => __( 'Facebook Secret', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_facebook_secret',
            'default' => '',
            'type'    => 'text'
        ),

        'section_facebook_settings_end' => array(
            'type' => 'sectionend',
            'id'   => 'ywsl_section_facebook_end'
        ),

        'section_twitter_settings'     => array(
            'name' => __( 'Twitter settings', 'ywsl' ),
            'desc'    =>  __( '<strong>Callback URL</strong>: '.YITH_YWSL_URL . 'includes/hybridauth/?hauth.done=Twitter', 'ywsl' ),
            'type' => 'title',
            'id'   => 'ywsl_section_twitter'
        ),

        'twitter_enable' => array(
            'name'    => __( 'Enable Twitter Login', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_twitter_enable',
            'default' => 'no',
            'type'    => 'checkbox'
        ),

        'twitter_key' => array(
            'name'    => __( 'Twitter Key', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_twitter_key',
            'default' => '',
            'type'    => 'text'
        ),

        'twitter_secret' => array(
            'name'    => __( 'Twitter Secret', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_twitter_secret',
            'default' => '',
            'type'    => 'text'
        ),

        'section_twitter_settings_end' => array(
            'type' => 'sectionend',
            'id'   => 'ywsl_section_twitter_end'
        ),
        'section_google_settings'     => array(
            'name' =>  __( 'Google settings', 'ywsl' ),
            'desc'    =>  __( '<strong>Callback URL</strong>: '.YITH_YWSL_URL . 'includes/hybridauth/?hauth.done=Google', 'ywsl' ),
            'type' => 'title',
            'id'   => 'ywsl_section_google'
        ),


        'google_enable' => array(
            'name'    => __( 'Enable Google Login', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_google_enable',
            'default' => 'no',
            'type'    => 'checkbox'
        ),

        'google_id' => array(
            'name'    => __( 'Google ID', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_google_id',
            'default' => '',
            'type'    => 'text'
        ),

        'google_secret' => array(
            'name'    => __( 'Google secret', 'ywsl' ),
            'desc'    => '',
            'id'      => 'ywsl_google_secret',
            'default' => '',
            'type'    => 'text'
        ),

        'section_google_settings_end' => array(
            'type' => 'sectionend',
            'id'   => 'ywsl_section_google_end'
        )
	)
);