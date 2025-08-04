<?php

namespace app\services;

use app\components\QrGenerator;
use app\components\ShortCodeGenerator;
use app\components\UrlValidator;
use app\models\Website;
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
            $website = Website::findOne(['url' => $url]);

            if ($website) {
                return [
                    'ok' => 0,
                    'qr' => Yii::getAlias(Yii::$app->params['qrCodes']['webPath']) . '/' . $website->name_of_qr_file,
                    'short' => $website->short_code,
                ];
            }
            $qr_path = QrGenerator::generate($url);
            $qr_filename = basename($qr_path);
            $short_code = ShortCodeGenerator::generate($url);

            $website = new Website();
            $website->url = $url;
            $website->name_of_qr_file = $qr_filename;
            $website->short_code = $short_code;
            $website->use_number = 0;

            if (!$website->save()) {
                throw new \Exception('Не удалось сохранить данные в базу');
            }
            return [
                'ok' => 0,
                'qr' => $qr_path,
                'short' => $short_code,
            ];
        } catch (\Exception $exception) {
            return [
                'ok' => 1,
                'message' => $exception->getMessage()
            ];
        }
    }
}