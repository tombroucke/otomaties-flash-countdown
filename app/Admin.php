<?php

namespace Otomaties\FlashCountdown;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @subpackage FlashCountdown/admin
 */

class Admin
{

    /**
     * The ID of this plugin.
     *
     * @var      string    $pluginName    The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param      string    $pluginName       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     */
    public function enqueueStyles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->pluginName, Assets::find('css/admin.css'), array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     */
    public function enqueueScripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->pluginName, Assets::find('js/admin.js'), array( 'jquery' ), $this->version, false);
    }

    public function flashMessageInCustomizer($customizer)
    {
        $customizer->add_section('flash_countdown', array(
            'title' => __('Flash countdown', 'flash-countdown'),
            'priority' => 199
        ));

        $customizer->add_setting('flash_message_enabled', array(
            'default' => false,
            'sanitize_callback' => [$this, 'sanitizeCheckbox'],
        ));

        $customizer->add_control(
            'flash_message_enabled',
            array(
                'type'       => 'checkbox',
                'label'      => __('Flash message enabled', 'flash-countdown'),
                'section'    => 'flash_countdown',
            )
        );

        $customizer->add_setting('flash_message_background_color', array(
            'default' => '#000',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $customizer->add_control(new \WP_Customize_Color_Control(
            $customizer,
            'flash_message_background_color',
            array(
                'label'      => __('Background Color', 'flash-countdown'),
                'section'    => 'flash_countdown',
            )
        ));

        $customizer->add_setting('flash_message_text_color', array(
            'default' => '#fff',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        $customizer->add_control(new \WP_Customize_Color_Control(
            $customizer,
            'flash_message_text_color',
            array(
                'label'      => __('Text Color', 'flash-countdown'),
                'section'    => 'flash_countdown',
            )
        ));

        $customizer->add_setting('flash_message_content', array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ));

        $customizer->add_control(
            'flash_message_content',
            array(
                'type'          => 'textarea',
                'label'         => __('Flash message', 'flash-countdown'),
                'section'       => 'flash_countdown',
                'description'   => __('Use the [flash_message_countdown] shortcode to display the countdown')
            )
        );

        $customizer->add_setting('flash_message_date_time', array(
            'default' => '',
            'sanitize_callback' => [$this, 'sanitizeDateTime'],
        ));

        $customizer->add_control(new \WP_Customize_Date_Time_Control(
            $customizer,
            'flash_message_date_time',
            array(
                'label'      => __('Count down to', 'flash-countdown'),
                'section'    => 'flash_countdown',
            )
        ));
    }

    /**
     * Sanitize date time value
     * @param $input
     * @return string
     */
    public function sanitizeDateTime($input)
    {
        $date = new \DateTime($input);
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Sanitize checkbox
     * @param $input
     * @return boolean
     */
    public function sanitizeCheckbox($checked)
    {
        return ((isset($checked) && true == $checked) ? true : false);
    }
}
