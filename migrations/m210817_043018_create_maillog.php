<?php

use yii\db\Migration;

/**
 * Class m210817_043018_create_maillog.
 */
class m210817_043018_create_maillog extends Migration
{
    use \app\lib\db\TextTypeTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%maillog}}', [
            'id' => $this->primaryKey(),
            'mailto' => $this->string()->comment('Mail to'),
            'subject' => $this->string()->comment('Subject'),
            'message' => $this->longText()->comment('Message'),
            'result' => $this->boolean()->comment('Result'),
            'response' => $this->longText()->comment('Response'),
            'created' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ]);
        $this->createIndex(
            'index-maillog-result',
            'maillog',
            'result'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('index-maillog-result', 'maillog');
        $this->dropTable('{{%maillog}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210817_043018_create_maillog cannot be reverted.\n";

        return false;
    }
    */
}
