<?php

namespace app\modules\admin\controllers;

use app\helpers\EnvHelper;
use app\modules\admin\models\{EmailSettings, EmailTest};
use Exception;
use Yii;

/**
 * Email controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class EmailController extends DefaultController
{
    /**
     * Edit email settings.
     *
     * @return string
     */
    public function actionIndex()
    {
        $assign = [];

        $request = Yii::$app->request;
        $model = new EmailSettings();
        dotenv()->required([
            'MAIL_TRANSPORT',
            'MAIL_FROMADDRESS',
            'MAIL_FROMNAME',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_ENCRYPTION',
            'MAIL_USERNAME',
            'MAIL_PASSWORD',
        ]);
        $model->transport = env('MAIL_TRANSPORT');
        $model->fromAddress = env('MAIL_FROMADDRESS');
        $model->fromName = env('MAIL_FROMNAME');
        $model->host = env('MAIL_HOST');
        $model->port = env('MAIL_PORT');
        $model->encryption = env('MAIL_ENCRYPTION');
        $model->username = env('MAIL_USERNAME');
        $model->password = env('MAIL_PASSWORD');

        if (!EnvHelper::isEnvWritable()) {
            $this->messageError('.env файл защищен от записи');
        }

        if ($request->isPost && $model->load($request->post())) {
            $envVars = [];
            foreach ($model->attributes as $configKey => $configValue) {
                $envVars['MAIL_' . strtoupper($configKey)] = $configValue;
            }
            EnvHelper::writeEnvVars($envVars);

            $this->messageSuccess('Настройки сохранены');

            return $this->redirect(['index']);
        }

        $assign['model'] = $model;

        return $this->render('index', $assign);
    }

    /**
     * Тестирование отправки.
     *
     * @return string
     */
    public function actionTest()
    {
        $assign = [];
        $assign['message'] = '';

        $request = Yii::$app->request;
        $model = new EmailTest();
        if ($request->isPost && $model->load($request->post())) {
            try {
                $mailAdmin = Yii::$app->mailer->compose('email-test.php');
                // $mailAdmin->setFrom(Yii::$app->params["senderEmail"]);
                $mailAdmin->setTo($model->email);
                $mailAdmin->setSubject('Проверка отправки почты');
                $mailAdmin->send();
                $this->messageSuccess('Письмо отправлено');
            } catch (Exception $exception) {
                $assign['message'] = 'Error: ' . $exception->getMessage() . ', code: ' . $exception->getCode();
            }
        }

        $assign['model'] = $model;

        return $this->render('test', $assign);
    }
}
