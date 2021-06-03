<?php
namespace Otomaties\FlashCountdown;

/**
 * Flash message object
 */
class FlashMessage
{

    /**
     * Get theme mod for parameter
     * @param  string $parameter
     * @return string
     */
    private function value($parameter)
    {
        return get_theme_mod('flash_message_' . $parameter);
    }

    /**
     * Check if flash message is enabled
     * @return boolean
     */

    public function enabled()
    {
		$now = new \DateTime();
        if (!$this->value('enabled') || $now > $this->dateTime(false)) {
            return false;
        }
        return true;
    }

    /**
     * Get flash message background color
     * @return string
     */
    public function background_color()
    {
        return $this->value('background_color');
    }

    /**
     * Get flash message text color
     * @return string
     */
    public function text_color()
    {
        return $this->value('text_color');
    }

    /**
     * Get flash message content
     * @return string
     */
    public function message()
    {
        return $this->value('content');
    }

    /**
     * Get flash message deadline
     * @return string
     */
    public function dateTime($format = true)
    {
        $datetime = \DateTime::createFromFormat('Y-m-d H:i:s', $this->value('date_time'));
        if ($format) {
            return $datetime->format('m/d/Y H:i:s');
        }
        return $datetime;
    }
}
