<?php

namespace app\components;

use app\models\Website;

/**
 * Генератор коротких кодов для URL
 *
 * Создает уникальные 8-символьные коды для длинных URL.
 * Гарантирует уникальность кода в системе.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Components
 * @package     app\components
 *
 * @see \app\models\Website
 */
class ShortCodeGenerator
{
    /**
     * Генерирует уникальный короткий код
     *
     * @param string $url Оригинальный URL для кодирования
     * @return string Уникальный 8-символьный код
     */
    public static function generate($url): string
    {
        $code = substr(md5(uniqid()), 0, 8);

        // Проверяем уникальность кода
        while (Website::findOne(['short_code' => $code])) {
            $code = substr(md5(uniqid()), 0, 8);
        }

        return $code;
    }
}