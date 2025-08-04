<?php

namespace app\models;

use AllowDynamicProperties;
use yii\db\ActiveRecord;

#[AllowDynamicProperties] class Website extends ActiveRecord
{
    public static function tableName()
    {
        return 'websites';
    }

    public function rules()
    {
        return [
            [['url', 'name_of_qr_file', 'short_code'], 'required'],
            [['url'], 'string'],
            [['use_number'], 'integer'],
            [['name_of_qr_file'], 'string', 'max' => 255],
            [['short_code'], 'string', 'max' => 8],
            [['short_code'], 'unique'],
        ];
    }
}