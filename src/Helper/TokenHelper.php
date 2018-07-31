<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 08:54
 */

namespace App\Helper;


class TokenHelper
{
    /**
     * @param int $length
     * @return string
     */
    public function generateConfirmationToken(int $length) :string
    {
        $strToRandom = ('abcdefghijklmnoptqrdtuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $expireOn = date('Y-m-d', strtotime(' + 3 days'));
        return $expireOn.'-'.substr(str_shuffle(str_repeat($strToRandom, $length)), 0, $length);
    }
}