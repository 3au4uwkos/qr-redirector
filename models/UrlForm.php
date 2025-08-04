<?php

namespace app\models;

use yii\base\Model;

/**
 * Форма для ввода URL
 *
 * Используется для валидации URL перед генерацией QR-кода.
 * Добавляет схему по умолчанию (https) при необходимости.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Models
 * @package     app\models
 */
class UrlForm extends Model
{
    /** @var string Вводимый URL */
    public $url;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url', 'defaultScheme' => 'https'],
            ['url', 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'url' => 'Длинная ссылка'
        ];
    }
}