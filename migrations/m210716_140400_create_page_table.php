<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%page}}`.
 */
class m210716_140400_create_page_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->comment('Id parent'),
            'name' => $this->string()->comment('Page name'),
            'path' => $this->string()->comment('Page path'),
            'priority' => $this->integer()->comment('Priority'),
            'redirect' => $this->string()->comment('Redirect url'),
            'content' => $this->text()->comment('Text'),
            'meta_title' => $this->string()->comment('Meta title'),
            'meta_description' => $this->text()->comment('Meta description'),
            'hidden' => $this->boolean()->comment('Hidden flag'),
            'disabled' => $this->boolean()->comment('Disabled flag'),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ]);

        // indexes
        $this->createIndex(
            'index-page-priority',
            'page',
            'priority'
        );
        $this->createIndex(
            'index-page-path',
            'page',
            'path'
        );
        $this->createIndex(
            'index-page-hidden',
            'page',
            'hidden'
        );
        $this->createIndex(
            'index-page-disabled',
            'page',
            'disabled'
        );
        $this->createIndex(
            'index-page-parent_id',
            'page',
            'parent_id'
        );
        $this->addForeignKey(
            'fkey-page-parent_id',
            'page',
            'parent_id',
            'page',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('index-page-priority', 'page');
        $this->dropIndex('index-page-path', 'page');
        $this->dropIndex('index-page-hidden', 'page');
        $this->dropIndex('index-page-disabled', 'page');
        $this->dropIndex('index-page-parent_id', 'page');
        $this->dropForeignKey('fkey-page-parent_id', 'page');
        $this->dropTable('{{%page}}');
    }
}
