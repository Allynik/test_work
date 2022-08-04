<?php

namespace app\modules\admin\models;

use yii\base\Model;

/**
 * Email test model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class EmailTest extends Model
{
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'email'],
            ['email', 'required'],
        ];
    }
}
