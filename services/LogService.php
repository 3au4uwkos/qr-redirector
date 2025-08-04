<?php

namespace app\services;

use app\models\RedirectLog;

/**
 * Сервис для логирования перенаправлений
 *
 * Записывает в лог информацию о перенаправлениях по коротким ссылкам.
 * Связывает веб-сайты с IP-адресами посетителей.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Services
 * @package     app\services
 *
 * @see \app\models\RedirectLog
 */
class LogService
{
    /**
     * Создает запись в логе перенаправлений
     *
     * @param int $websiteId ID веб-сайта в базе данных
     * @param int $ipId ID IP-адреса в базе данных
     * @return void
     */
    public static function createLog(int $websiteId, int $ipId): void
    {
        $log = new RedirectLog([
            'website_id' => $websiteId,
            'ip_id' => $ipId,
        ]);

        $log->save();
    }
}