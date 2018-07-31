<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 31/07/2018
 * Time: 08:54
 */

namespace App\Helper;


class IdentifierHelper
{
    /**
     * @param int $length
     * @return string
     */
    public function generateToken(int $length) :string
    {
        $strToRandom = ('abcdefghijklmnoptqrdtuvwxyABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        $expireOn = date('Y-m-d', strtotime(' + 3 days'));
        return $expireOn.'-'.substr(str_shuffle(str_repeat($strToRandom, $length)), 0, $length);
    }

    /**
     * @param int $length
     * @return string
     */
    public function generateTempPassword(int $length): string
    {
       return substr(uniqid('temp_'),$length);
    }
}