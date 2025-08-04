<?php

use yii\db\Migration;

/**
 * Создание таблицы логов перенаправлений
 *
 * Связывает веб-сайты и IP-адреса для учета переходов.
 * Использует внешние ключи для обеспечения целостности данных.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Migrations
 * @package     app\migrations
 */
class m250804_194121_create_logs_table extends Migration
{
    /**
     * Создает таблицу logs
     */
    public function safeUp()
    {
        $this->createTable('logs', [
            'id' => $this->primaryKey(),
            'website_id' => $this->integer()->notNull(),
            'ip_id' => $this->integer()->notNull(),
            'accessed_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->addForeignKey(
            'fk_logs_website',
            'logs',
            'website_id',
            'websites',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_logs_ip',
            'logs',
            'ip_id',
            'ips',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * Удаляет таблицу logs
     */
    public function safeDown()
    {
        $this->dropTable('logs');
    }
}