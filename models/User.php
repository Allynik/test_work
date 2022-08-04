<?php

namespace app\models;

use app\behaviors\UploadImageBehavior;
use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * User model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @property int         $id
 * @property string|null $username             Логин
 * @property string|null $first_name           Имя
 * @property string|null $last_name            Фамилия
 * @property string|null $middle_name          Отчество
 * @property string|null $auth_key             Authorization key
 * @property string|null $password_hash        Password hash
 * @property string|null $password_reset_token Password reset token
 * @property string|null $verification_token   Verification token
 * @property string|null $email                Адрес электронной почты
 * @property string|null $phone                Номер телефона
 * @property string|null $photo                Фотография
 * @property string|null $birth_date           Дата рождения
 * @property string|null $created
 * @property string|null $updated
 */
class User extends BaseActiveRecord implements IdentityInterface
{
    public const STATUS_DELETED = 'deleted';
    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_ACTIVE = 'active';

    public const ID_SUPER_ADMIN = 1;
    protected $passwordNew;
    protected $passwordNewConfirm;

    /**
     * @return mixed
     */
    public function getPasswordNew()
    {
        return $this->passwordNew;
    }

    /**
     * @param mixed $passwordNew
     */
    public function setPasswordNew($passwordNew)
    {
        $this->passwordNew = $passwordNew;
    }

    /**
     * @return mixed
     */
    public function getPasswordNewConfirm()
    {
        return $this->passwordNewConfirm;
    }

    /**
     * @param mixed $passwordNewConfirm
     */
    public function setPasswordNewConfirm($passwordNewConfirm)
    {
        $this->passwordNewConfirm = $passwordNewConfirm;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['photo'] = [
            'class' => UploadImageBehavior::class,
            'attribute' => 'photo',
            'scenarios' => ['create', 'update'],
            'path' => '@webroot/uploads/users/{id}',
            'url' => '@web/uploads/users/{id}',
            'createThumbsOnRequest' => true,
            'thumbs' => [
                'thumb-admin' => ['width' => 60, 'height' => 60, 'quality' => 90, 'mode' => ManipulatorInterface::THUMBNAIL_OUTBOUND],
                'thumb-admin-view' => ['width' => 200, 'height' => null, 'quality' => 90, 'mode' => ManipulatorInterface::THUMBNAIL_OUTBOUND],
            ],
        ];

        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'safe', 'on' => ['create', 'update']],

            [['first_name', 'last_name', 'email', 'status'], 'required'],

            ['username', 'unique'],
            ['email', 'email'],
            ['email', 'unique'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['birth_date', 'string'],

            [['username', 'first_name', 'last_name', 'middle_name', 'phone', 'status'], 'string'],

            ['passwordNew', 'default', 'value' => ''],
            ['passwordNew', 'required', 'on' => ['create']],
            ['passwordNew', 'string', 'min' => Yii::$app->params['user']['passwordMinLength']],

            ['passwordNewConfirm', 'default', 'value' => ''],
            ['passwordNewConfirm', 'string', 'min' => Yii::$app->params['user']['passwordMinLength']],
            ['passwordNewConfirm', 'compare', 'compareAttribute' => 'passwordNew'],
            'passwordConfirmRequiredUpdate' => ['passwordNewConfirm', 'required', 'when' => function ($model) {
                return '' != (string) $model->passwordNew;
            }, 'whenClient' => "function (attribute, value) {
                return document.querySelector('#" . strtolower($this->formName()) . "-passwordnew').value != '';
            }"],

            ['photo', 'image', 'skipOnEmpty' => true, 'extensions' => 'png,jpeg,jpg', 'on' => ['create', 'update']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Find active user by login.
     *
     * @param $username
     *
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Find active user by phone.
     *
     * @param string $phone
     *
     * @return static|null
     */
    public static function findByPhone($phone)
    {
        return static::findOne(['phone' => $phone, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Find active user by email.
     *
     * @param string $email
     *
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token.
     *
     * @param string $token password reset token
     *
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token.
     *
     * @param string $token verify email token
     *
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid.
     *
     * @param string $token password reset token
     *
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password.
     *
     * @param string $password password to validate
     *
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model.
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key.
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token.
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification.
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token.
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Check if user is super admin.
     *
     * @return bool
     */
    public function getIsAdmin()
    {
        if ($this->isNewRecord) {
            return false;
        }

        return self::ID_SUPER_ADMIN === (int) $this->id;
    }

    /**
     * Generate user name.
     *
     * @return string
     */
    public function generateUserName()
    {
        return 'user_' . Yii::$app->security->generateRandomString(16);
    }

    /**
     * Before save.
     *
     * @param bool $insert
     *
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!$this->username) {
            $this->username = $this->generateUserName();
        }
        if (!$this->auth_key) {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }
        if (!$this->verification_token) {
            $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
        }
        if ($this->passwordNew) {
            $this->setPassword($this->passwordNew);
        }
        unset($this->passwordNew);
        unset($this->passwordNewConfirm);

        return parent::beforeSave($insert);
    }

    /**
     * Before delete.
     *
     * @return bool
     */
    public function beforeDelete()
    {
        return !$this->getIsAdmin();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Номер телефона',
            'city' => 'Город',
            'birth_date' => 'Дата рождения',
            'email' => 'Электронная почта',
            'status' => 'Статус',
            'photo' => 'Фотография',
            'created' => 'Создан',
            'updated' => 'Обновлен',

            'passwordNew' => 'Пароль',
            'passwordNewConfirm' => 'Повторите пароль',
        ];
    }

    /**
     * Return statuses.
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_DELETED => 'Удален',
            self::STATUS_INACTIVE => 'Заблокирован',
            self::STATUS_ACTIVE => 'Активный',
        ];
    }

    public function getDisplayName()
    {
        if ('' != $this->first_name || '' != $this->last_name) {
            return trim($this->first_name . ' ' . $this->last_name);
        }

        return $this->username;
    }
}
