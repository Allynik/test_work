<?php

use yii\db\Migration;

/**
 * Class m210706_074851_init.
 */
class m210706_074851_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('Login'),
            'first_name' => $this->string()->comment('First name'),
            'last_name' => $this->string()->comment('Last name'),
            'middle_name' => $this->string()->comment('Middle name'),
            'photo' => $this->string()->comment('Photo'),
            'birth_date' => $this->dateTime()->comment('Birth date'),

            'auth_key' => $this->string(32)->notNull()->comment('Authorization key'),
            'password_hash' => $this->string()->notNull()->comment('Password hash'),
            'password_reset_token' => $this->string()->unique()->comment('Password reset token'),
            'phone' => $this->string()->comment('Phone number'),
            'email' => $this->string()->notNull()->unique()->comment('Email'),
            'verification_token' => $this->string()->notNull()->unique()->comment('Verification token for email'),

            'status' => $this->string()->notNull()->defaultValue('active'),
            'created' => $this->dateTime()->notNull()->comment('Created'),
            'updated' => $this->dateTime()->notNull()->comment('Updated'),
        ]);

        $this->insert('user', [
            'id' => 1,
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
            'email' => 'test@test.test',
            'status' => 'active',
            'created' => '2021-01-01 01:00:00',
            'updated' => '2021-01-01 01:00:00',
            'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('user', ['id' => 1]);
        $this->dropTable('{{%user}}');
    }
}
