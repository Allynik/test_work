<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\LoginForm;
use Yii;
use yii\web\{Controller, Response};

/**
 * Auth Controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class AuthController extends Controller
{
    /**
     * Layout name.
     *
     * @var string
     */
    public $layout = '@views/admin/layouts/auth.php';

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'app\modules\admin\ErrorAction',
            ],
        ];
    }

    /**
     * Login.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->getIsGuest()) {
            $identity = Yii::$app->user->getIdentity();
            if ($identity && $identity->getIsAdmin()) {
                return $this->goBack('/admin');
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack('/admin');
        } else {
            $error = 'Ошибка авторизации';
        }

        $model->password = '';

        return $this->render('index', [
            'model' => $model,
            'error' => $error,
        ]);
    }

    /**
     * Logout.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/admin');
    }

    public function actionForbidden()
    {
        return $this->render('forbidden');
    }
}
