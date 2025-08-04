<?php

namespace app\services;

use app\models\Website;
use yii\web\NotFoundHttpException;

/**
 * Сервис для работы с веб-сайтами
 *
 * Предоставляет методы для поиска сайтов по коротким кодам и учета статистики использования.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Services
 * @package     app\services
 *
 * @see \app\models\Website
 */
class WebsiteService
{
    /**
     * Находит веб-сайт по короткому коду
     *
     * @param string $code Короткий код для поиска
     * @return Website Найденная модель веб-сайта
     * @throws NotFoundHttpException Если веб-сайт не найден
     */
    public static function findByShortCode(string $code): Website
    {
        $website = Website::findOne(['short_code' => $code]);

        if (!$website) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        return $website;
    }

    /**
     * Увеличивает счетчик использования веб-сайта
     *
     * @param int $websiteId ID веб-сайта в базе данных
     * @return void
     */
    public static function incrementCounter(int $websiteId): void
    {
        Website::updateAllCounters(['use_number' => 1], ['id' => $websiteId]);
    }
}