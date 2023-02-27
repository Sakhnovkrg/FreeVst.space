<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stuff_os}}`.
 */
class m230214_110414_create_stuff_os_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stuff_os}}', [
            'stuff_id' => $this->integer()->notNull(),
            'os_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%pk_stuff_os}}', '{{%stuff_os}}', ['stuff_id', 'os_id']);

        $this->addForeignKey('{{%fk_stuff_os__stuff}}',
            '{{%stuff_os}}', 'stuff_id',
            '{{%stuff}}', 'id',
            'CASCADE', 'RESTRICT'
        );

        $this->addForeignKey('{{%fk_stuff_os__os}}',
            '{{%stuff_os}}', 'os_id',
            '{{%os}}', 'id',
            'CASCADE', 'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stuff_os}}');
    }
}
