<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%application}}`.
 */
class m221005_074212_create_application_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%application}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->comment('First name'),
            'company' => $this->string()->comment('Company name'),
            'phone' => $this->string()->comment('Phone number'),
            'email' => $this->string()->notNull()->comment('Email'),
            'comment' => $this->text()->comment('Comment'),
            'created' => $this->dateTime()->notNull()->comment('Created'),
        ]);
        $this->createIndex(
            'index-application-first_name',
            'application',
            'first_name'
        );
        $this->createIndex(
            'index-application-company',
            'application',
            'company'
        );
        $this->createIndex(
            'index-application-phone',
            'application',
            'phone'
        );
        $this->createIndex(
            'index-application-email',
            'application',
            'email'
        );
        $this->createIndex(
            'index-application-comment',
            'application',
            'comment'
        );
        $this->insert('application', [
            'id' => 1,
            'first_name' => 'Vyacheslav',
            'company' => 'Some company',
            'phone' => '89138362165',
            'email' => 'erema_ssss@mail.ru',
            'comment' => 'some comment',
            'created' => '2022-10-09 12:04:38',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%application}}');
        $this->dropIndex('index-application-first_name', 'blog');
        $this->dropIndex('index-application-company', 'blog');
        $this->dropIndex('index-application-phone', 'blog');
        $this->dropIndex('index-application-email', 'blog');
        $this->dropIndex('index-application-comment', 'blog');
    }
}
