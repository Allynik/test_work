<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text_block}}`.
 */
class m210707_144838_create_text_block_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%text_block}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Block name'),
            'widget' => $this->string()->comment('Widget'),
            'config' => $this->text()->comment('Widget config'),
            'content' => $this->text()->comment('Content'),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ]);

        // indexes
        $this->createIndex(
            'index-blocks-name',
            'text_block',
            'name'
        );
        $this->createIndex(
            'index-blocks-widget',
            'text_block',
            'widget'
        );
        $this->createIndex(
            'index-blocks-created',
            'text_block',
            'created'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('index-blocks-created', 'text_block');
        $this->dropIndex('index-blocks-widget', 'text_block');
        $this->dropIndex('index-blocks-name', 'text_block');
        $this->dropTable('{{%text_block}}');
    }
}
