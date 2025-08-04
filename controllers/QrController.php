<?php

namespace app\controllers;

use app\models\UrlForm;
use app\services\QrService;
use Yii;
use yii\web\Controller;

class QrController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGetForm()
    {
        return $this->renderAjax('_form');
    }

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