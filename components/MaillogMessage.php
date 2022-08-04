<?php

namespace app\components;

use app\modules\admin\models\Maillog;
use Swift_SwiftException;
use yii\mail\MailerInterface;
use yii\swiftmailer\Message;

class MaillogMessage extends Message
{
    public function send(MailerInterface $mailer = null)
    {
        $message = $this->getSwiftMessage();

        $log = new Maillog();
        $log->mailto = implode(', ', array_keys($message->getTo()));
        $log->subject = $message->getSubject();
        $log->message = $message->toString();
        $log->result = false;
        $log->save();

        try {
            $result = parent::send($mailer);
            $log->message = $message->toString();
            $log->result = $result;
            $log->save();

            return $result;
        } catch (Swift_SwiftException $exception) {
            $log->response = $exception->getMessage();
            $log->result = false;
            $log->save();

            throw $exception;
        }
    }

    public function fixExceptionMessage($message)
    {
        if (DIRECTORY_SEPARATOR == '\\' && function_exists('mb_check_encoding')) {
            if (!@mb_check_encoding($message, 'utf-8')) {
                $message = addcslashes($message, "\0..\37!@\177..\377");
            }
        }

        return $message;
    }
}
