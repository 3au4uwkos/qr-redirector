<?php

namespace app\services;

use app\models\Ip;
use Yii;

/**
 * Сервис для работы с IP-адресами
 *
 * Обеспечивает создание и обновление записей об IP-адресах.
 * Используется для отслеживания посещений и статистики.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Services
 * @package     app\services
 *
 * @see \app\models\Ip
 */
class IpService
{
    /**
     * Находит или создает запись об IP-адресе
     *
     * @param string $ip IP-адрес для поиска или создания
     * @return Ip Найденная или созданная модель IP
     */
    public static function getOrCreate(string $ip): Ip
    {
        $model = Ip::findOne(['ip' => $ip]);

        if (!$model) {
            $model = new Ip(['ip' => $ip]);
            $model->save();
        }

        return $model;
    }

    /**
     * Увеличивает счетчик посещений для указанного IP
     *
     * @param int $ipId ID записи IP в базе данных
     * @return void
     */
    public static function incrementCounter(int $ipId): void
    {
        Ip::updateAllCounters(['visit_count' => 1], ['id' => $ipId]);
    }
}