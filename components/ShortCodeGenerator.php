<?php

namespace app\components;

use app\models\Website;

class ShortCodeGenerator
{
    public static function generate($url)
    {
        $code = substr(md5(uniqid()), 0, 8);

        // Проверяем уникальность кода
        while (Website::findOne(['short_code' => $code])) {
            $code = substr(md5(uniqid()), 0, 8);
        }

        return $code;
    }
}