<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stuff_tag}}`.
 */
class m230214_111209_create_stuff_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stuff_tag}}', [
            'stuff_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
            'ord' => $this->integer()->notNull()->defaultValue(0)
        ]);

        $this->addPrimaryKey('{{%pk_stuff_tag}}', '{{%stuff_tag}}', ['stuff_id', 'tag_id']);

        $this->addForeignKey('{{%fk_stuff_tag__stuff}}',
            '{{%stuff_tag}}', 'stuff_id',
            '{{%stuff}}', 'id',
            'CASCADE', 'RESTRICT'
        );

        $this->addForeignKey('{{%fk_stuff_tag__tag}}',
            '{{%stuff_tag}}', 'tag_id',
            '{{%tag}}', 'id',
            'CASCADE', 'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stuff_tag}}');
    }
}
