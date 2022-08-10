<?php

namespace Otomaties\FlashCountdown;

/**
 * Plugin Name:       Otomaties Flash Countdown
 * Description:       Add a message at the top of your website with a countdown. Add &lt;?php do_action('flash_message'); ?&gt; right after the opening body tag.
 * Plugin URI:        https://github.com/tombroucke/otomaties-flash-countdown
 * Version:           1.0.0
 * Author:            Tom Broucke
 * Author URI:        http://tombroucke.be/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       otomaties-flash-countdown
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

// Autoload files
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once('vendor/autoload.php');
}

// Setup / teardown
register_activation_hook(__FILE__, '\\Otomaties\\FlashCountdown\\Activator::activate');
register_deactivation_hook(__FILE__, '\\Otomaties\\FlashCountdown\\Deactivator::deactivate');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function init()
{
    if (! function_exists('get_plugin_data')) {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    $pluginData = \get_plugin_data(__FILE__);
    $pluginData['pluginName'] = basename(__FILE__, '.php');

    $plugin = new Plugin($pluginData);
    $plugin->run();
}
init();
