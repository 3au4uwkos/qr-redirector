<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%logs}}`.
 */
class m250804_194121_create_logs_table extends Migration
{
    public function safeUp()
    {
        // Создаём таблицу logs
        $this->createTable('logs', [
            'id' => $this->primaryKey(),
            'website_id' => $this->integer()->notNull(),  // Ссылка на websites.id
            'ip_id' => $this->integer()->notNull(),      // Ссылка на ips.id
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

    public function safeDown()
    {
        $this->dropTable('logs');
    }
}
