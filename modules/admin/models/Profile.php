<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;

/**
 * Profile model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Profile extends Model
{
    public $username;
    public $email;
    public $password;
    public $passwordConfirm;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $phone;
    public $photo;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $user = Yii::$app->user;
        $rules = [
            ['username', 'safe'],

            [['first_name', 'last_name', 'middle_name', 'phone', 'email'], 'trim'],
            [['first_name', 'last_name', 'email'], 'required'],
            ['email', 'email'],
            [['first_name', 'last_name', 'middle_name', 'phone', 'email'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот адрес уже занят', 'filter' => 'id != ' . $user->getId()],

            ['password', 'default', 'value' => ''],
            ['password', 'string', 'min' => Yii::$app->params['user']['passwordMinLength']],

            ['photo', 'image', 'skipOnEmpty' => true, 'extensions' => 'png,jpeg,jpg', 'on' => ['create', 'update']],

            ['passwordConfirm', 'default', 'value' => ''],
            ['passwordConfirm', 'string', 'min' => Yii::$app->params['user']['passwordMinLength']],
            ['passwordConfirm', 'compare', 'compareAttribute' => 'password'],
            'passwordConfirmRequiredUpdate' => ['passwordConfirm', 'required', 'when' => function ($model) {
                return '' != (string) $model->password;
            }, 'whenClient' => "function (attribute, value) {
                return $('#" . strtolower($this->formName()) . "-password').val() != '';
            }"],
        ];

        return $rules;
    }

    /**
     * Get form name.
     *
     * @return string
     */
    public function formName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'passwordConfirm' => 'Повторите пароль',
            'email' => 'Электронная почта',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Номер телефона',
            'photo' => 'Фотография',
        ];
    }
}
