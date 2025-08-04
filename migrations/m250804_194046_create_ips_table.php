<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ips}}`.
 */
class m250804_194046_create_ips_table extends Migration
{
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

    public function safeDown()
    {
        $this->dropTable('ips');
    }
}
