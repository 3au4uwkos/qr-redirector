<?php

namespace app\models;

use yii\base\Model;

class UrlForm extends Model
{
    public $url;

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url', 'defaultScheme' => 'https'],
            ['url', 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'url' => 'Длинная ссылка'
        ];
    }
}