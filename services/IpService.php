<?php

namespace app\services;

use app\models\Ip;
use Yii;

class IpService
{
    public static function getOrCreate(string $ip): Ip
    {
        $model = Ip::findOne(['ip' => $ip]);

        if (!$model) {
            $model = new Ip(['ip' => $ip]);
            $model->save();
        }

        return $model;
    }

    public static function incrementCounter(int $ipId): void
    {
        Ip::updateAllCounters(['visit_count' => 1], ['id' => $ipId]);
    }
}