<?php

namespace app\controllers;

use Yii;

class SiteController extends AbstractFrontController
{
    public $layout = '@views/layouts/main';

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('@views/site/index');
    }

    public function actionMaintenance()
    {
        Yii::$app->response->statusCode = 503;

        return $this->render('@views/site/maintenance');
    }
}
