<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

/**
 * Контроллер обработки ошибок приложения
 *
 * Обрабатывает HTTP-ошибки и отображает соответствующие страницы.
 * Использует стандартный механизм обработки ошибок Yii2.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Controllers
 * @package     app\controllers
 */
class ErrorController extends Controller
{
    /**
     * Действия контроллера
     *
     * @return array Массив конфигураций действий
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}