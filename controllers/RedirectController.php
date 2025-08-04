<?php

namespace app\controllers;

use app\services\IpService;
use app\services\WebsiteService;
use app\services\LogService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RedirectController extends Controller
{
    public function actionIndex($code)
    {
        try {
            $ip = $this->getUserIp();

            $ipModel = IpService::getOrCreate($ip);
            IpService::incrementCounter($ipModel->id);

            $website = WebsiteService::findByShortCode($code);
            WebsiteService::incrementCounter($website->id);

            LogService::createLog($website->id, $ipModel->id);

            return $this->redirect($website->url);

        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (\Exception $e) {
            \Yii::error("Redirect error: " . $e->getMessage());
            throw new NotFoundHttpException('Произошла ошибка при обработке запроса');
        }
    }

    /**
     * Получаем IP пользователя из заголовков
     */
    private function getUserIp(): string
    {
        $ip = \Yii::$app->request->getUserIP();

        if (empty($ip)) {
            $ip = 'unknown';
        }

        return $ip;
    }
}