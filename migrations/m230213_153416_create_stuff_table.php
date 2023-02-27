<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stuff}}`.
 */
class m230213_153416_create_stuff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stuff}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'developer_id' => $this->integer()->notNull(),
            'slug' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'text' => $this->text(),
            'url' => $this->string(),
            'download_url' => $this->string(),
            'youtube_url' => $this->string(),
            'version' => $this->string(),
            'image' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'active' => $this->boolean()->notNull()->defaultValue(1),
            'downloads' => $this->integer()->notNull()->defaultValue(0),
            'hits' => $this->integer()->notNull()->defaultValue(0),
            'likes' => $this->integer()->notNull()->defaultValue(0),
            'comments' => $this->integer()->notNull()->defaultValue(0),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey('{{%fk_stuff__category}}',
            '{{%stuff}}', 'category_id',
            '{{%category}}', 'id',
            'CASCADE', 'RESTRICT'
        );

        $this->addForeignKey('{{%fk_stuff__developer}}',
            '{{%stuff}}', 'developer_id',
            '{{%developer}}', 'id',
            'CASCADE', 'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stuff}}');
    }
}
