<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userlog}}`.
 */
class m210714_102622_create_userlog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%userlog}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->comment('Id user'),
            'username' => $this->string()->comment('Username'),
            'model' => $this->string()->comment('Model name'),
            'table' => $this->string()->comment('Table name'),
            'entity_id' => $this->integer()->comment('Id entity'),
            'action' => $this->string()->comment('Action name'),
            'comment' => $this->text()->comment('Comment'),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ]);

        // indexes
        $this->createIndex(
            'index-userlog-username',
            'userlog',
            'username'
        );
        $this->createIndex(
            'index-userlog-user_id',
            'userlog',
            'user_id'
        );
        $this->createIndex(
            'index-userlog-model',
            'userlog',
            'model'
        );
        $this->createIndex(
            'index-userlog-table',
            'userlog',
            'table'
        );
        $this->createIndex(
            'index-userlog-action',
            'userlog',
            'table'
        );
        $this->createIndex(
            'index-userlog-created',
            'userlog',
            'created'
        );
        $this->addForeignKey(
            'fkey-userlog-user_id',
            'userlog',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('index-userlog-username', 'userlog');
        $this->dropIndex('index-userlog-user_id', 'userlog');
        $this->dropIndex('index-userlog-model', 'userlog');
        $this->dropIndex('index-userlog-table', 'userlog');
        $this->dropIndex('index-userlog-action', 'userlog');
        $this->dropIndex('index-userlog-created', 'userlog');

        $this->dropTable('{{%userlog}}');
    }
}
