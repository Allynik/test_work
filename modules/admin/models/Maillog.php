<?php

namespace app\modules\admin\models;

use app\models\BaseActiveRecord;

/**
 * Userlog model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 *
 * @version   $Id$
 *
 * @property int         $id
 * @property string      $mailto
 * @property string      $subject
 * @property string      $message
 * @property bool        $result
 * @property string      $response
 * @property string|null $created
 * @property string|null $updated
 */
class Maillog extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maillog';
    }

    public function getHtmlBody()
    {
        $matches = [];
        $messageRaw = quoted_printable_decode($this->message);
        preg_match('|<body(?:\s.*)?>(.*)</body>|isU', $messageRaw, $matches);

        return $matches[1] ?? '';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mailto' => 'Email',
            'subject' => 'Тема',
            'message' => 'Сообщение',
            'htmlBody' => 'Сообщение',
            'result' => 'Отправлен',
            'response' => 'Ответ сервера',
            'created' => 'Создано',
            'updated' => 'Обновлено',
        ];
    }
}
