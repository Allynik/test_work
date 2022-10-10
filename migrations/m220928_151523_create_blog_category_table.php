<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_category}}`.
 */
class m220928_151523_create_blog_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->unique(),
        ]);
        $this->createIndex(
            'index-blog_category-title',
            'blog_category',
            'title'
        );
        $this->insert('blog_category', [
            'id' => 1,
            'title' => 'foo',
        ]);
        $this->insert('blog_category', [
            'id' => 2,
            'title' => 'seo',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blog_category}}');
        $this->dropIndex('index-blog_category-title', 'blog_category');
    }
}
