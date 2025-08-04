<?php

namespace app\services;

use app\models\Website;
use yii\web\NotFoundHttpException;

class WebsiteService
{
    public static function findByShortCode(string $code): Website
    {
        $website = Website::findOne(['short_code' => $code]);

        if (!$website) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        return $website;
    }

    public static function incrementCounter(int $websiteId): void
    {
        Website::updateAllCounters(['use_number' => 1], ['id' => $websiteId]);
    }
}