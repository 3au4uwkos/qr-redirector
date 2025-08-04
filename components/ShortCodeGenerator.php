<?php

namespace app\components;

class ShortCodeGenerator
{
    public static function generate($url){
        return substr(md5(uniqid()), 0, 8);
    }
}