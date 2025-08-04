<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Модель веб-сайтов
 *
 * Хранит оригинальные URL, короткие коды и пути к QR-файлам.
 * Включает счетчик использования и временные метки.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Models
 * @package     app\models
 *
 * @property int $id
 * @property string $url
 * @property string $name_of_qr_file
 * @property string $short_code
 * @property int $use_number
 * @property string $created_at
 * @property string $updated_at
 */
class Website extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'websites';
    }

    /**
     * {@inheritdoc}
     */
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