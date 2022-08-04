<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%setting}}`.
 */
class m210707_122816_create_setting_table extends Migration
{
    use \app\lib\db\TextTypeTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Setting name'),
            'module' => $this->string()->comment('Module name'),
            'value' => $this->mediumText()->comment('Value'),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ]);

        // indexes
        $this->createIndex(
            'index-setting-name',
            'setting',
            'name'
        );
        $this->createIndex(
            'index-setting-module',
            'setting',
            'module'
        );
        $this->createIndex(
            'index-setting-created',
            'setting',
            'created'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('index-setting-created', 'setting');
        $this->dropIndex('index-setting-module', 'setting');
        $this->dropIndex('index-setting-name', 'setting');
        $this->dropTable('{{%setting}}');
    }
}
