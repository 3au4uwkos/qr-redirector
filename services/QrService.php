<?php

namespace app\services;

use app\components\UrlValidator;

class QrService
{
    public static function generate($url)
    {
        $validationResult = UrlValidator::process($url);

        switch ($validationResult) {
            case 0: // Всё OK
                return [
                    'ok' => 0,
                    'qr' => self::generateQrCode($url),
                    'short' => self::generateShortCode()
                ];

            case 1: // Невалидный URL
                return [
                    'ok' => 1,
                    'message' => 'Некорректный URL. Проверьте формат ссылки.'
                ];

            case 2: // URL недоступен
                return [
                    'ok' => 1,
                    'message' => 'URL недоступен. Проверьте работоспособность сайта.'
                ];
        }
    }

    private static function generateQrCode(string $url): string
    {
        // Здесь будет логика генерации QR-кода
        return 'qr.png';
    }

    private static function generateShortCode(): string
    {
        // Здесь будет логика генерации короткой ссылки
        return substr(md5(uniqid()), 0, 8);
    }
}