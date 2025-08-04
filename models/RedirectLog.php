<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель логов перенаправлений
 *
 * Связывает веб-сайты и IP-адреса с временем перехода.
 * Использует AR-связи для доступа к связанным данным.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Models
 * @package     app\models
 *
 * @property int $id
 * @property int $website_id
 * @property int $ip_id
 * @property string $accessed_at
 * @property Website $website
 * @property Ip $ip
 */
class RedirectLog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['website_id', 'ip_id'], 'required'],
            [['website_id', 'ip_id'], 'integer'],
        ];
    }

    /**
     * Связь с моделью Website
     */
    public function getWebsite()
    {
        return $this->hasOne(Website::class, ['id' => 'website_id']);
    }

    /**
     * Связь с моделью Ip
     */
    public function getIp()
    {
        return $this->hasOne(Ip::class, ['id' => 'ip_id']);
    }
}