<?php

namespace app\services;

use app\components\QrGenerator;
use app\components\ShortCodeGenerator;
use app\components\UrlValidator;
use Yii;

class QrService
{
    public static function generate($url)
    {
        $validationResult = UrlValidator::process($url);

        switch ($validationResult) {
            case 0:
                return self::process($url);

            case 1:
                return [
                    'ok' => 1,
                    'message' => 'Некорректный URL. Проверьте формат ссылки.'
                ];

            case 2:
                return [
                    'ok' => 1,
                    'message' => 'URL недоступен. Проверьте работоспособность сайта.'
                ];
        }
    }

    private static function process(string $url): array
    {
        try {
            $qr_path = QrGenerator::generate($url);
            $code = ShortCodeGenerator::generate($url);
            return [
                'ok' => 0,
                'qr' => $qr_path,
                'short' => $code,
            ];
        } catch (\Exception $exception) {
            return [
                'ok' => 1,
                'message' => $exception->getMessage()
            ];
        }
    }
}