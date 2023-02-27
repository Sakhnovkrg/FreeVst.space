<?php

use yii\db\Migration;

/**
 * Class m230215_043540_add_base_content
 */
class m230215_043540_add_base_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%category}}', ['slug', 'name', 'ord'], [
            ['instruments', 'Instruments', 0],
            ['effects', 'Effects', 1],
            ['midi', 'Midi', 2],
            ['bundles', 'Bundles', 3],
        ]);

        $this->batchInsert('{{%os}}', ['slug', 'name', 'ord'], [
            ['win32', 'Win32', 0],
            ['win64', 'Win64', 1],
            ['osx', 'OSX', 2],
            ['linux', 'Linux', 3],
        ]);

        $this->batchInsert('{{%format}}', ['slug', 'name', 'ord'], [
            ['vst', 'VST', 0],
            ['vst3', 'VST3', 1],
            ['au', 'AU', 2],
            ['aax', 'AAX', 3],
            ['rtas', 'RTAS', 4],
            ['clap', 'Clap', 5],
            ['lv2', 'LV2', 6],
        ]);

        $this->insert('{{%developer}}', [
            'name' => 'Unknown',
            'slug' => 'unknown'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
