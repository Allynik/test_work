<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog}}`.
 */
class m220928_154254_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->comment('Blog title'),
            'category_id' => $this->integer()->comment('id category'),
            'content' => $this->text()->comment('Content'),
            'image' => $this->string()->comment('Path to img'),
            'created' => $this->dateTime(),
            'flag' => $this->getDb()->getSchema()->createColumnSchemaBuilder('BIT'),
        ]);

        // indexes
        $this->createIndex(
            'index-blog-title',
            'blog',
            'title'
        );
        $this->createIndex(
            'index-blog-content',
            'blog',
            'content'
        );
        $this->createIndex(
            'index-blog-image',
            'blog',
            'image'
        );
        $this->createIndex(
            'index-blog-created',
            'blog',
            'created'
        );
        $this->createIndex(
            'index-blog-flag',
            'blog',
            'flag'
        );
        $this->createIndex(
            'index-blog-category_id',
            'blog',
            'category_id'
        );
        $this->addForeignKey(
            'fkey-blog-category_id',
            'blog',
            'category_id',
            'blog_category',
            'id'
        );
        $this->insert('blog', [
            'id' => 1,
            'title' => 'some title',
            'category_id' => '1',
            'content' => 'content mb',
            'image' => 'd8058baac1b0cab2f8e800c7c9fcc73e.jpg',
            'created' => '2022-10-09 12:04:38',
            'flag' => true
        ]);
        $this->insert('blog', [
            'id' => 2,
            'title' => 'new blog',
            'category_id' => '2',
            'content' => 'Wow!',
            'image' => '8dd97cf1b97b05b9663cabebcdce5c1e.jpg',
            'created' => '2022-10-05 12:04:38',
            'flag' => false
        ]);
        $this->insert('blog', [
            'id' => 3,
            'title' => 'Запись',
            'category_id' => '1',
            'content' => 'Старая запись...',
            'image' => '03f3527b38157163f2cf2c4a57047f8f.webp',
            'created' => '2022-10-02 12:04:38',
            'flag' => true
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blog}}');
        $this->dropIndex('index-blog-title', 'blog');
        $this->dropIndex('index-blog-category_id', 'blog');
        $this->dropIndex('index-blog-content', 'blog');
        $this->dropIndex('index-blog-image', 'blog');
        $this->dropIndex('index-blog-created', 'blog');
        $this->dropIndex('index-blog-flag', 'blog');
        $this->dropForeignKey('fkey-blog-category_id', 'blog');
    }
}
