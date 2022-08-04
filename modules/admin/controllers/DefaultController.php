<?php

namespace app\modules\admin\controllers;

use app\controllers\AbstractController;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * Default admin controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class DefaultController extends AbstractController
{
    /**
     * Layout name.
     *
     * @var string
     */
    public $layout = '@views/admin/layouts/main.php';

    /**
     * Renders the index view for the module.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => [$this, 'accessMatch'],
                    ],
                ],
                'denyCallback' => [$this, 'accessDeny'],
            ],
        ]);
    }

    public function accessMatch()
    {
        $identity = Yii::$app->user->getIdentity();

        return $identity && $identity->getIsAdmin();
    }

    public function accessDeny()
    {
        $identity = Yii::$app->user->getIdentity();

        if ($identity && !$identity->getIsAdmin()) {
            Url::remember();

            return $this->redirect('/admin/forbidden');
        }

        Url::remember();

        return $this->redirect('/admin/auth');
    }
}
