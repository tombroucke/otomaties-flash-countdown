<?php
namespace Otomaties\FlashCountdown;

class Frontend
{
    public function __construct()
    {
        add_shortcode('flash_message', array($this, 'flashMessage'));
        add_shortcode('flash_message_countdown', array($this, 'flashMessageCountdown'));
		add_filter('body_class', array($this, 'addBodyClass'));
    }

    /**
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

        ob_start(); ?>
		<?php do_action('before_flash_message'); ?>
		<div class="flash-message text-center" style="background-color: <?php echo $message->background_color(); ?>">
			<div class="container">
				<?php do_action('before_flash_message_content'); ?>
				<span class="flash-message__content" style="color: <?php echo $message->text_color(); ?>;">
					<?php echo str_replace(['<p>', '</p>'], '', apply_filters('the_content', $message->message())); ?>
				</span>
				<?php do_action('after_flash_message_content'); ?>
			</div>
		</div>
		<?php do_action('after_flash_message'); ?>
		<?php
        return ob_get_clean();
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

	public static function addBodyClass($classes) {
        $message = new FlashMessage();
        if ($message->enabled()) {
			$classes[] = 'has-flash-message';
		}
		return $classes;
	}
}

new Frontend();
