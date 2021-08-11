<?php


namespace App\Helper;


class Helper
{
    /**
     * @param $email
     * @return false|string
     */
    public static function getNameByEmail($email)
    {
        return substr($email, 0, strrpos($email, '@'));
    }
}
