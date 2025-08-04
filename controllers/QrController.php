<?php

namespace app\controllers;

use app\models\UrlForm;
use app\services\QrService;
use Yii;
use yii\web\Controller;

/**
 * Контроллер для работы с QR-кодами
 *
 * Обрабатывает запросы на генерацию QR-кодов и коротких ссылок.
 * Работает через AJAX-запросы без перезагрузки страницы.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Controllers
 * @package     app\controllers
 *
 * @see \app\services\QrService
 */
class QrController extends Controller
{
    /**
     * Главная страница генератора
     *
     * @return string HTML-код страницы
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Возвращает HTML-форму для генерации (AJAX)
     *
     * @return string HTML-код формы
     */
    public function actionGetForm()
    {
        return $this->renderAjax('_form');
    }

    /**
     * Обрабатывает запрос на генерацию QR-кода (AJAX)
     *
     * @return array JSON-ответ с результатом генерации
     */
    public function actionGenerate()
    {
        try {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $model = new UrlForm();

            if ($model->load(Yii::$app->request->post())) {
                $data = QrService::generate($model->url);

                if ($data['ok'] == 0) {
                    return [
                        'html' => $this->renderAjax('_success', [
                            'qrCode' => $data['qr'],
                            'shortUrl' => $data['short']
                        ])
                    ];
                } else {
                    return [
                        'html' => $this->renderAjax('_error', [
                            'message' => $data['message']
                        ])
                    ];
                }
            } else {
                return [
                    'html' => $this->renderAjax('_error', [
                        'message' => 'Не удалось получить данные формы'
                    ])
                ];
            }
        } catch (\Exception $exception) {
            Yii::error($exception->getMessage());
            return [
                'html' => $this->renderAjax('_error', [
                    'message' => 'Произошла ошибка, повторите позже'
                ])
            ];
        }
    }
}