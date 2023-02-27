<?php

use yii\db\Migration;

/**
 * Class m230227_010458_add_head_scripts_setting
 */
class m230227_010458_add_head_scripts_setting extends \sakhnovkrg\yii2\settings\migrations\Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addSetting(
            \sakhnovkrg\yii2\settings\types\TextType::class,
            'Layout', 'Head scripts',
            ['field' => ''],
            ['field' => 'Code'],
            [
                ['field', 'string']
            ],
            ['rows' => '15']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropSetting('Layout', 'Head scripts');
    }
}
