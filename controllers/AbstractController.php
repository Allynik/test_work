<?php

namespace app\controllers;

use Yii;

/**
 * Abstract base controller with features.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
abstract class AbstractController extends \yii\web\Controller
{
    public $layout = '@views/layouts/main';

    /**
     * Flash-messages.
     *
     * @var array
     */
    public $messages = [];

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Add success message.
     *
     * @param $message
     */
    public function messageSuccess($message)
    {
        $this->message($message, 'success');
    }

    /**
     * Add info message.
     *
     * @param $message
     */
    public function messageInfo($message)
    {
        $this->message($message, 'info');
    }

    /**
     * Add error message.
     *
     * @param $message
     */
    public function messageError($message)
    {
        $this->message($message, 'error');
    }

    /**
     * Add flash message.
     *
     * @param $message
     * @param $type
     */
    public function message($message, $type)
    {
        $session = Yii::$app->session;
        $messagesList = $session->getFlash('messages', [], false);
        if (!isset($messagesList[$type]) || !is_array($messagesList[$type])) {
            $messagesList[$type] = [];
        }
        $messagesList[$type][] = $message;
        $session->setFlash('messages', $messagesList);
    }

    /**
     * Page render.
     *
     * @param string $view
     * @param array  $params
     *
     * @return string
     */
    public function render($view, $params = [])
    {
        $this->messages = Yii::$app->session->getFlash('messages', [], true);

        return parent::render($view, $params);
    }
}
