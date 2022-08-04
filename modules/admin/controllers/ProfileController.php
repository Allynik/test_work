<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\modules\admin\models\Profile;
use Yii;

/**
 * Profile controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class ProfileController extends DefaultController
{
    /**
     * Profile edit.
     */
    public function actionIndex()
    {
        /**
         * @var $userProfile User
         */
        $form = new Profile();
        $user = Yii::$app->user;
        $userProfile = $user->identity;

        $form->load([
            $form->formName() => [
                'username' => $userProfile->username,
                'email' => $userProfile->email,
                'first_name' => $userProfile->first_name,
                'last_name' => $userProfile->last_name,
                'middle_name' => $userProfile->middle_name,
                'phone' => $userProfile->phone,
            ],
        ]);
        $form->photo = $userProfile->photo;
        if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post()) && $form->validate()) {
            $userProfile->email = $form->email;
            $userProfile->first_name = $form->first_name;
            $userProfile->last_name = $form->last_name;
            $userProfile->middle_name = $form->middle_name;
            $userProfile->phone = $form->phone;
            $userProfile->photo = \yii\web\UploadedFile::getInstance($form, 'photo');
            if ($form->password) {
                $userProfile->setPassword($form->password);
            }
            $userProfile->setScenario('update');

            if ($userProfile->save(true)) {
                $this->messageSuccess('Профиль сохранен');

                return $this->redirect('/admin');
            } else {
                $this->messageError('Ошибка сохранения профиля');
            }
        }

        return $this->render('index', [
            'model' => $form,
        ]);
    }

    public function accessMatch()
    {
        $identity = Yii::$app->user->getIdentity();

        return $identity && $identity->id > 0;
    }
}
