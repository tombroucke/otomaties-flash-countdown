<?php
namespace Otomaties\FlashCountdown;

class Admin
{
	public function __construct()
	{
		add_action('customize_register', array( __CLASS__, 'add_flash_message_to_customizer' ));
	}

    /**
     * Add flash message settings to customizer
     * @param object $wp_customize
     */
    public static function add_flash_message_to_customizer($wp_customize)
    {
    	$wp_customize->add_section('flash_countdown', array(
    		'title' => __('Flash countdown', 'flash-countdown'),
    		'priority' => 199
    	));

    	$wp_customize->add_setting('flash_message_enabled', array(
    		'default' => false,
    		'sanitize_callback' => 'flash_countdown_sanitize_checkbox',
    	));

    	$wp_customize->add_control(
    		'flash_message_enabled',
    		array(
    			'type' 		 => 'checkbox',
    			'label'      => __('Flash message enabled', 'flash-countdown'),
    			'section'    => 'flash_countdown',
    		)
    	);

    	$wp_customize->add_setting('flash_message_background_color', array(
    		'default' => '#000',
    		'sanitize_callback' => 'sanitize_hex_color',
    	));

    	$wp_customize->add_control(new \WP_Customize_Color_Control(
    		$wp_customize,
    		'flash_message_background_color',
    		array(
    			'label'      => __('Background Color', 'flash-countdown'),
    			'section'    => 'flash_countdown',
    		)
    	));

    	$wp_customize->add_setting('flash_message_text_color', array(
    		'default' => '#fff',
    		'sanitize_callback' => 'sanitize_hex_color',
    	));

    	$wp_customize->add_control(new \WP_Customize_Color_Control(
    		$wp_customize,
    		'flash_message_text_color',
    		array(
    			'label'      => __('Text Color', 'flash-countdown'),
    			'section'    => 'flash_countdown',
    		)
    	));

    	$wp_customize->add_setting('flash_message_content', array(
    		'default' => '',
    		'sanitize_callback' => 'wp_kses_post',
    	));

    	$wp_customize->add_control(
    		'flash_message_content',
    		array(
    			'type' 		 	=> 'textarea',
    			'label'      	=> __('Flash message', 'flash-countdown'),
    			'section'    	=> 'flash_countdown',
    			'description' 	=> __('Use the [flash_message_countdown] shortcode to display the countdown')
    		)
    	);

    	$wp_customize->add_setting('flash_message_date_time', array(
    		'default' => '',
    		'sanitize_callback' => 'flash_countdown_sanitize_date_time',
    	));

    	$wp_customize->add_control(new \WP_Customize_Date_Time_Control(
    		$wp_customize,
    		'flash_message_date_time',
    		array(
    			'label'      => __('Count down to', 'flash-countdown'),
    			'section'    => 'flash_countdown',
    		)
    	));
    }
}

new Admin();
