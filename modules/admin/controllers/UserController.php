<?php

namespace app\modules\admin\controllers;

use app\models\{BaseActiveRecord, User};
use yii\db\ActiveRecord;

/**
 * User controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class UserController extends AbstractCRUDController
{
    /**
     * Model class.
     *
     * @var ActiveRecord
     */
    protected $modelClass = User::class;

    /**
     * Before delete user.
     */
    public function beforeDelete(BaseActiveRecord $model)
    {
        parent::beforeDelete($model);
        if ($model->getIsAdmin()) {
            $this->messageError('Супер-пользователя нельзя удалить!');
            $this->redirect(['index']);

            return false;
        }
    }
}
