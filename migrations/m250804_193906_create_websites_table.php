<?php

use yii\db\Migration;

/**
 * Создание таблицы для хранения веб-сайтов
 *
 * Содержит оригинальные URL, QR-коды и короткие ссылки.
 * Включает счетчик использования и временные метки.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Migrations
 * @package     app\migrations
 */
class m250804_193906_create_websites_table extends Migration
{
    /**
     * Создает таблицу websites
     */
    public function safeUp()
    {
        $this->createTable('websites', [
            'id' => $this->primaryKey(),
            'url' => $this->text()->notNull(),
            'name_of_qr_file' => $this->string(255)->notNull(),
            'short_code' => $this->string(8)->unique()->notNull(),
            'use_number' => $this->integer()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('idx_short_code', 'websites', 'short_code', true);
    }

    /**
     * Удаляет таблицу websites
     */
    public function safeDown()
    {
        $this->dropTable('websites');
    }
}