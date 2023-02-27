<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%developer}}`.
 */
class m230213_153351_create_developer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%developer}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'url' => $this->string(),
            'donate_url' => $this->string(),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%developer}}');
    }
}
