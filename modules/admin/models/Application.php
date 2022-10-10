<?php

namespace app\modules\admin\models;

use app\models\BaseActiveRecord;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string|null $first_name First name
 * @property string|null $company Company name
 * @property string|null $phone Phone number
 * @property string $email Email
 * @property string|null $comment Comment
 */
class Application extends BaseActiveRecord
{
    public $updated;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['first_name','email', 'company', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя отправителя',
            'company' => 'Компания',
            'phone' => 'Телефон',
            'email' => 'Эл. Почта',
            'comment' => 'Комментарий',
        ];
    }

}
