<?php

/**
 * Created by PhpStorm.
 * User: Mathias
 * Date: 03.03.2016
 * Time: 16:40
 */

namespace App\Lib;

use Illuminate\Support\Facades\Session;

/**
 * Class Message
 * Define several helpers designed to flash specific named data on the Session.
 * The value of these data will be a custom message defined in the messages.php file.
 * Since the methods use the trans() helpers, the message value don't need to be translated manually.
 * @package App\Lib
 */
class Message {


    /**
     * Flashes data named 'error' on the Session.
     * The value of this data is a message identified with $name
     * and possibly containing as many placeholders as $placeholders
     * Note : it's assumed that the desired message is located on the messages.php file
     * @param $reference String name of the message to send
     * @param array $placeholders The placeholders to swap on the message
     */
    public static function error($reference) {
        $msg = self::get($reference);
        return ['msg' => __($msg)];
    }

    /**
     * Returns a simple string message based on the given $ref.
     * This $ref must correspond to an existing message in the messages.php file
     * @param $reference String The reference to the message to send
     * @param array|null $placeholders The placeholders to swap on the message
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public static function get($reference) {
        return trans('messages.' . $reference);
    }

}
