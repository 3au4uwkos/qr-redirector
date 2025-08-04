<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель для работы с IP-адресами
 *
 * Содержит информацию о посетителях и количество их визитов.
 * Используется для статистики переходов по ссылкам.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Models
 * @package     app\models
 *
 * @property int $id
 * @property string $ip
 * @property int $visit_count
 * @property string $last_visit
 */
class Ip extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ips';
    }

    /**
     * {@inheritdoc}
     */
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