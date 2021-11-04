<?php

namespace Otomaties\FlashCountdown;

use Otomaties\FlashCountdown\Models\FlashMessage;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @subpackage FlashCountdown/public
 */

class Frontend
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
     * @param      string    $pluginName       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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
        wp_enqueue_style($this->pluginName, Assets::find('css/main.css'), array(), null);
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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
        
        wp_enqueue_script('jquery.countdown', plugins_url('public/js/jquery.countdown.min.js', dirname(__FILE__)), array( 'jquery' ), null);
        wp_enqueue_script($this->pluginName, Assets::find('js/main.js'), array( 'jquery.countdown', 'jquery' ), null);
        wp_localize_script($this->pluginName, 'flash_countdown_vars', array(
            'strings' => array(
                'day' => __('day', 'otomaties-flash-countdown'),
                'days' => __('days', 'otomaties-flash-countdown'),
                'week' => __('week', 'otomaties-flash-countdown'),
                'weeks' => __('weeks', 'otomaties-flash-countdown'),
            )
        ));
    }/**
     * Shortcode to display flash message
     * @return string
     */
    public static function flashMessage()
    {
        date_default_timezone_set('Europe/Brussels');
        $message = new FlashMessage();
        if (!$message->enabled()) {
            return;
        }
        ?>
        <?php do_action('before_flash_message'); ?>
        <div class="flash-message text-center" style="background-color: <?php echo $message->backgroundColor(); ?>">
            <div class="container">
                <?php do_action('before_flash_message_content'); ?>
                <div class="flash-message__content" style="color: <?php echo $message->textColor(); ?>;">
                    <?php echo str_replace(['<p>', '</p>'], '', apply_filters('the_content', $message->message())); ?>
                </div>
                <?php do_action('after_flash_message_content'); ?>
            </div>
        </div>
        <?php do_action('after_flash_message'); ?>
        <?php
    }

    /**
     * Shortcode to display flash message countdown
     * @return [type] [description]
     */
    public static function flashMessageCountdown()
    {
        $message = new FlashMessage();
        return sprintf('<span class="flash-message__countdown" data-countdown-to="%s"></span>', $message->dateTime());
    }

    public static function addBodyClass($classes)
    {
        $message = new FlashMessage();
        if ($message->enabled()) {
            $classes[] = 'has-flash-message';
        }
        return $classes;
    }
}
