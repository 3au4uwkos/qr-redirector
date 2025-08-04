<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%websites}}`.
 */
class m250804_193906_create_websites_table extends Migration
{
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

    public function safeDown()
    {
        $this->dropTable('websites');
    }
}
