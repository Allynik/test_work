<?php

namespace app\components;

/**
 * ReCaptcha component.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class ReCaptcha extends \yii\base\Component
{
    public $enabled = null;

    public $siteKey = null;

    public $secretKey = null;

    public $recaptcha = null;

    public function init()
    {
        $this->recaptcha = new \ReCaptcha\ReCaptcha($this->secretKey);
        $this->recaptcha->setExpectedHostname(\Yii::$app->request->getHostName());
    }

    public function verify()
    {
        if (!$this->enabled) {
            return [];
        }
        $recaptchaResponse = (string) \Yii::$app->request->post('g-recaptcha-response');
        $remoteIp = \Yii::$app->request->getUserIP();

        $response = $this->recaptcha->verify($recaptchaResponse, $remoteIp);
        if ($response->isSuccess()) {
            return [];
        } else {
            return $response->getErrorCodes();
        }
    }
}
