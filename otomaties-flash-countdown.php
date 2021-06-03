<?php
/**
 * Plugin Name:     Otomaties Flash Countdown
 * Description:     Add a message at the top of your website with a countdown. Add [flash_message] right after the opening body tag.
 * Author:          Tom Broucke
 * Author URI:      https://tombroucke.be
 * Text Domain:     flash-countdown
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Control
 */

namespace Otomaties\FlashCountdown;

defined('ABSPATH') || exit;

/**
 * Init Flash Countdown
 */
class Control
{

    /**
     * Control Instance
     * @var null
     */
    private static $_instance = null;

    /**
     * Return $_instance
     * @return Object
     */
    public static function instance()
    {
        if (! isset(self::$_instance)) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    /**
     * Initialize plugin
     */
    private function __construct()
    {
        $this->includes();
        $this->init();
        $this->load_textdomain();
    }

    /**
     * Include files
     */
    private function includes()
    {
        include 'includes/functions.php';
        include 'includes/class-admin.php';
        include 'includes/class-frontend.php';
        include 'includes/class-flash-message.php';
    }

    /**
     * Init
     */
    private function init()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    /**
     * Load plugin textdomain
     */
    public function load_textdomain()
    {
        load_plugin_textdomain('flash-countdown', false, basename(dirname(__FILE__)) . '/languages');
    }

    /**
     * Enqueue & localize scripts
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('jquery-countdown', plugins_url('/assets/js/jquery.countdown.min.js', __FILE__), array('jquery'), null, true);
        wp_enqueue_script('flash-countdown', plugins_url('/assets/js/main.js', __FILE__), array('jquery', 'jquery-countdown'), null, true);
        wp_localize_script('flash-countdown', 'flash_countdown', array(
            'strings' => array(
                'day' => __('day', 'flash-countdown'),
                'days' => __('days', 'flash-countdown'),
                'week' => __('week', 'flash-countdown'),
                'weeks' => __('weeks', 'flash-countdown'),
            )
        ));
    }
}

add_action('plugins_loaded', '\Otomaties\FlashCountdown\Control::instance');
