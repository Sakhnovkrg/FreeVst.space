<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stuff_format}}`.
 */
class m230214_110716_create_stuff_format_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stuff_format}}', [
            'stuff_id' => $this->integer()->notNull(),
            'format_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk_stuff_format}}', '{{%stuff_format}}', ['stuff_id', 'format_id']);

        $this->addForeignKey('{{%fk_stuff_format__stuff}}',
            '{{%stuff_format}}', 'stuff_id',
            '{{%stuff}}', 'id',
            'CASCADE', 'RESTRICT'
        );

        $this->addForeignKey('{{%fk_stuff_format__format}}',
            '{{%stuff_format}}', 'format_id',
            '{{%format}}', 'id',
            'CASCADE', 'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stuff_format}}');
    }
}
