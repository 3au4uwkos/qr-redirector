<?php

namespace app\services;

use app\models\RedirectLog;

class LogService
{
    public static function createLog(int $websiteId, int $ipId): void
    {
        $log = new RedirectLog([
            'website_id' => $websiteId,
            'ip_id' => $ipId,
        ]);

        $log->save();
    }
}