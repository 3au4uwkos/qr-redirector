<?php

namespace app\services;

class QrService
{
    public static function generate($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return [
                'ok' => 1,
                'message' => 'Некорректный URL'
            ];
        }

        return [
            'ok' => 0,
            'qr' => 'qr.png',
            'short' => 'shortlink_example'
        ];
    }
}