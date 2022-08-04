<?php

namespace app\modules\pages\controllers;

use app\controllers\AbstractFrontController;
use app\modules\pages\models\Page;
use yii\web\NotFoundHttpException;

/**
 * Front pages controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class FrontController extends AbstractFrontController
{
    /**
     * Get and render page.
     *
     * @param $path
     *
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionIndex($path)
    {
        $staticPage = Page::findByPath($path)
            ->andWhere(['disabled' => false])
            ->one();
        if (null === $staticPage) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if ($staticPage->redirect) {
            return $this->redirect($staticPage->redirect);
        }

        return $this->render('@views/pages/index', ['staticPage' => $staticPage]);
    }
}
