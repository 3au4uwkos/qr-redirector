<?php

namespace app\controllers;

use app\services\IpService;
use app\services\WebsiteService;
use app\services\LogService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Контроллер редиректов по коротким ссылкам
 *
 * Обрабатывает переходы по коротким ссылкам, ведёт статистику
 * переходов и перенаправляет на оригинальные URL.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Controllers
 * @package     app\controllers
 *
 * @see \app\services\IpService
 * @see \app\services\WebsiteService
 * @see \app\services\LogService
 */
class RedirectController extends Controller
{
    /**
     * Обрабатывает переход по короткой ссылке
     *
     * @param string $code Короткий код URL
     * @return \yii\web\Response Перенаправление на оригинальный URL
     * @throws NotFoundHttpException Если код не найден или произошла ошибка
     */
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
     * Получает IP-адрес пользователя из запроса
     *
     * @return string IP-адрес или 'unknown', если не удалось определить
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