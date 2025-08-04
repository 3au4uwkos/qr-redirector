<?php

namespace app\components;

use yii\base\Component;
use yii\web\HttpException;

class UrlValidator extends Component
{
    /**
     * Основной метод обработки URL
     * @param string $url
     * @return int
     *   0 - URL валиден и доступен
     *   1 - невалидный URL
     *   2 - URL недоступен
     */
    public static function process(string $url): int
    {
        if (!self::validate($url)) {
            return 1;
        }

        if (!self::checkAvailability($url)) {
            return 2;
        }

        return 0;
    }

    /**
     * Проверка валидности формата URL
     * @param string $url
     * @return bool
     */
    private static function validate(string $url): bool
    {
        return (bool)filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Проверка доступности URL
     * @param string $url
     * @return bool
     */
    private static function checkAvailability(string $url): bool
    {
        $headers = @get_headers($url);

        if ($headers === false) {
            return false;
        }

        $responseCode = substr($headers[0], 9, 3);
        return $responseCode >= 200 && $responseCode < 400;
    }
}