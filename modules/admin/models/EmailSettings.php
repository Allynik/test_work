<?php

namespace app\modules\admin\models;

use yii\base\Model;

/**
 * Email settings form.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class EmailSettings extends Model
{
    public $fromAddress;
    public $fromName;
    public $transport;
    public $host;
    public $port;
    public $encryption;
    public $username;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fromAddress', 'username'], 'email'],
            ['port', 'integer'],
            [['host', 'fromName', 'password', 'encryption', 'transport'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fromAddress' => 'Email отправителя',
            'fromName' => 'Имя отправителя',
            'transport' => 'Транспорт',
            'host' => 'SMTP хост',
            'port' => 'SMTP порт',
            'encryption' => 'Тип шифрования',
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }
}
