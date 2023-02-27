<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%os}}`.
 */
class m230213_153247_create_os_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%os}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'ord' => $this->integer()
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%os}}');
    }
}
