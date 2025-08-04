<?php

namespace app\models;

use yii\db\ActiveRecord;

class RedirectLog extends ActiveRecord
{
    public static function tableName()
    {
        return 'logs';
    }

    public function rules()
    {
        return [
            [['website_id', 'ip_id'], 'required'],
            [['website_id', 'ip_id'], 'integer'],
        ];
    }

    public function getWebsite()
    {
        return $this->hasOne(Website::class, ['id' => 'website_id']);
    }

    public function getIp()
    {
        return $this->hasOne(Ip::class, ['id' => 'ip_id']);
    }
}