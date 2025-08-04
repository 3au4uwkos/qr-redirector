<?php

namespace app\services;

use app\components\QrGenerator;
use app\components\ShortCodeGenerator;
use app\components\UrlValidator;
use app\models\Website;
use Yii;

/**
 * Сервис для генерации QR-кодов и коротких ссылок
 *
 * Обрабатывает URL, валидирует их и генерирует QR-коды с короткими кодами.
 * Использует внешние компоненты для генерации QR и коротких ссылок.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Services
 * @package     app\services
 *
 * @see \app\models\Website
 * @see \app\components\QrGenerator
 * @see \app\components\ShortCodeGenerator
 * @see \app\components\UrlValidator
 */
class QrService
{
    /**
     * Основной метод для генерации QR-кода и короткой ссылки
     *
     * @param string $url URL для обработки
     * @return array Результат операции с QR-кодом и короткой ссылкой или сообщение об ошибке
     */
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

    /**
     * Обрабатывает валидный URL и создает соответствующие записи
     *
     * @param string $url Валидный URL для обработки
     * @return array Результат операции с QR-кодом и короткой ссылкой
     * @throws \Exception Если не удалось сохранить данные
     */
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