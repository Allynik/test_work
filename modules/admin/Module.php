<?php

namespace app\modules\admin;

use app\models\User;
use Yii;
use yii\base\BootstrapInterface;

/**
 * Admin module.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->params['admin'] = require_once Yii::getAlias('@app/config/admin.php');

        $this->params['blocks']['widgets'] = [
            'input' => 'Строка',
            'textarea' => 'Текст',
            'email' => 'Электронная почта',
            'editor' => 'HTML',
            'file' => 'Файл',
            'image' => 'Изображение',
            'url' => 'Ссылка',
            'checkbox' => 'Флаг',
        ];

        $this->params['email']['transport'] = [
            'mail' => 'Функция mail',
            'smtp' => 'Прямое соединение SMTP',
        ];

        $this->params['email']['encryption'] = [
            '' => 'Без шифрования',
            'ssl' => 'SSL',
            'tls' => 'TLS',
        ];

        $this->params['user']['statuses'] = User::getStatuses();
    }

    /**
     * Module bootstrap.
     *
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            'admin' => [
                'pattern' => '/admin',
                'route' => 'admin/dashboard/index',
            ],
            'authLogin' => [
                'pattern' => '/admin/auth',
                'route' => 'admin/auth/index',
            ],
            'authForbidden' => [
                'pattern' => '/admin/forbidden',
                'route' => 'admin/auth/forbidden',
            ],
            'authLogout' => [
                'pattern' => '/admin/auth/logout',
                'route' => 'admin/auth/logout',
            ],
            'profile' => [
                'pattern' => '/admin/profile',
                'route' => 'admin/profile/index',
            ],
            'setting' => [
                'pattern' => '/admin/setting',
                'route' => 'admin/setting/index',
            ],
            'blocks' => [
                'pattern' => '/admin/blocks',
                'route' => 'admin/blocks/index',
            ],
            [
                'pattern' => '/admin/blocks/<action:\w+>',
                'route' => 'admin/blocks/<action>',
            ],
            [
                'pattern' => '/admin/user',
                'route' => 'admin/user/index',
            ],
            [
                'pattern' => '/admin/user/<action:\w+>',
                'route' => 'admin/user/<action>',
            ],
            [
                'pattern' => '/admin/userlog',
                'route' => 'admin/userlog/index',
            ],
            [
                'pattern' => '/admin/userlog/<action:\w+>',
                'route' => 'admin/userlog/<action>',
            ],
            [
                'pattern' => '/admin/email',
                'route' => 'admin/email/index',
            ],
            [
                'pattern' => '/admin/email/<action:\w+>',
                'route' => 'admin/email/<action>',
            ],
            [
                'pattern' => '/admin/maillog',
                'route' => 'admin/maillog/index',
            ],
            [
                'pattern' => '/admin/maillog/<action:\w+>',
                'route' => 'admin/maillog/<action>',
            ],
            [
                'pattern' => '/admin/blog',
                'route' => 'admin/blog/index',
            ],
            [
                'pattern' => '/admin/blog/<action:\w+>',
                'route' => 'admin/blog/<action>',
            ],
            [
                'pattern' => '/admin/application',
                'route' => 'admin/application/index',
            ],
            [
                'pattern' => '/admin/application/<action:\w+>',
                'route' => 'admin/application/<action>',
            ],
            [
            'pattern' => '/admin/categories',
            'route' => 'admin/categories/index',
        ],
            [
                'pattern' => '/admin/categories/<action:\w+>',
                'route' => 'admin/categories/<action>',
            ],
        ]);
    }
}
