<?php

namespace app\controllers;

use app\modules\admin\models\Setting;
use Yii;

/**
 * Abstract front controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
abstract class AbstractFrontController extends AbstractController
{
    /**
     * Before action.
     *
     * @param \yii\base\Action $action
     *
     * @return bool
     *
     * @throws \yii\web\HttpException
     */
    public function beforeAction($action)
    {
        $siteDisabled = (int) Setting::getCommonSetting('disable', false);
        if ($siteDisabled && 'site/maintenance' !== $action->getUniqueId()) {
            Yii::$app->response->redirect(['site/maintenance']);

            return false;
        } elseif (!$siteDisabled && 'site/maintenance' === $action->getUniqueId()) {
            Yii::$app->response->redirect(['site/index']);

            return false;
        }

        return parent::beforeAction($action);
    }
}
