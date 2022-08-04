<?php

namespace app\modules\admin\controllers;

use Yii;

/**
 * Admin dashboard controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class DashboardController extends DefaultController
{
    public function accessMatch()
    {
        $identity = Yii::$app->user->getIdentity();

        return $identity && $identity->id > 0;
    }
}
