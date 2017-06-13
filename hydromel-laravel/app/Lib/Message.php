<?php

/**
 * User: Spat
 * Date: 12.06.2017
 */

namespace App\Lib;

/**
 * Class Message
 * Generate an error message do be displayed if any error has been encountered during a process.
 * @package App\Lib
 */
class Message {

    public static $ERROR_KEY = 'error';

    /**
     * Create a json element with 'msg' as key and the message to be displayed in the correct locale as value.
     * @return array Json msg element with error
     */
    public static function error($reference) {
        $msg = self::get($reference);
        return ['msg' => ($msg)];
    }

    /**
     * Returns a simple string message based on the given $ref.
     * This $ref must correspond to an existing message in the messages.php file
     * @param $reference String The reference to the message to send
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public static function get($reference) {
        return trans('messages.' . $reference);
    }

}
