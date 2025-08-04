<?php

use yii\db\Migration;

/**
 * Создание таблицы для хранения IP-адресов
 *
 * Содержит информацию о посетителях и счетчики их визитов.
 *
 * @author      Matvei Zaitsev <3au4uwkos@gmail.com>
 * @category    Migrations
 * @package     app\migrations
 */
class m250804_194046_create_ips_table extends Migration
{
    /**
     * Создает таблицу ips
     */
    public function safeUp()
    {
        $this->createTable('ips', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(45),
            'visit_count' => $this->integer()->defaultValue(0),
            'last_visit' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('idx_ip', 'ips', 'ip', true);
    }

    /**
     * Удаляет таблицу ips
     */
    public function safeDown()
    {
        $this->dropTable('ips');
    }
}