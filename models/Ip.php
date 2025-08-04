<?php

namespace app\models;

use yii\db\ActiveRecord;

class Ip extends ActiveRecord
{
    public static function tableName()
    {
        return 'ips';
    }

    public function rules()
    {
        return [
            [['ip'], 'required'],
            [['ip'], 'string', 'max' => 45],
            [['visit_count'], 'integer'],
            [['ip'], 'unique'],
        ];
    }
}