<?php

namespace app\modules\admin\models;

use app\models\BaseActiveRecord;

/**
 * Userlog model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @property int         $id
 * @property int         $user_id
 * @property string      $username
 * @property string      $model
 * @property string      $table
 * @property int         $entity_id
 * @property string      $action
 * @property string      $comment
 * @property string|null $created
 * @property string|null $updated
 */
class Userlog extends BaseActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userlog';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Id пользователя',
            'username' => 'Логин',
            'model' => 'Модель',
            'table' => 'Таблица',
            'entity_id' => 'Id объекта',
            'action' => 'Действие',
            'comment' => 'Комментарий',
            'created' => 'Создано',
            'updated' => 'Обновлено',
        ];
    }
}
