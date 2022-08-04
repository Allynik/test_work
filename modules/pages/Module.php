<?php

namespace app\modules\pages;

use yii\base\BootstrapInterface;

/**
 * Module pages.
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
    public $controllerNamespace = 'app\modules\pages\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * Module bootstrap.
     *
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            [
                'pattern' => '/admin/pages',
                'route' => 'pages/admin/index',
            ],
            [
                'pattern' => '/admin/pages/<action:\w+>',
                'route' => 'pages/admin/<action>',
            ],
            'static_pages' => [
                'pattern' => '/<path:[\/0-9\w\-]+>?',
                'route' => '/pages/front',
            ],
        ]);
    }
}
