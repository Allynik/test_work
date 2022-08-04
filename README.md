<p align="center">
    <h1 align="center">Yii 2 Starter Pack</h1>
    <br>
</p>

Yii 2 Starter Pack is a basic admin application based on [Yii 2] Basic application (http://www.yiiframework.com/).

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      behavior/           contains custom application behaviors
      commands/           contains console commands (controllers)
      components/         contains components
      config/             contains application configurations
      controllers/        contains Web controller classes
      helpers/            contains helpers classes
      lib/                contains traits
      mail/               contains view files for e-mails
      models/             contains model classes
      modules             contains modules
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources
      widgets/            contains widgets



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.2.

INSTALLATION
------------

Create empty repository, clone it into directory and copy Yii2-starter-pack with git commands:

    git remote add source https://github.com/Intecmedia/yii2-starter-pack.git
    git fetch source
    git merge source/main
    
Install vendor packages via composer (https://getcomposer.org/)

    composer install
   
CONFIGURATION
-------------

You need to configure `.env` configuration. Copy and rename `.env.example` file to `.env`.

After `.env` file created you need to run generate app key:

    php yii app-key  


You need to configurate basic variables:

    LANGUAGE="ru-RU"                    locale name

    APP_ENV="dev"                       working application environment (dev or prod)
    APP_DEBUG=true                      use application debug panel (true of false)
    APP_KEY=""                          application secret cookie key
    APP_TITLE="Yii2 Starter Pack"       basic application title
        
    DB_HOST="127.0.0.1"                 database host
    DB_NAME="yii2sp"                    database name
    DB_USER="root"                      database username
    DB_PASS=""                          database password
        
    RECAPTCHA_SITEKEY=                  recaptcha2 public sitekey
    RECAPTCHA_SECRETKEY=                recaptcha2 secret key
    RECAPTCHA_ENABLED=false             recaptcha enable flag (true or false)

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests. 

After database has created you need to run migrations:

    php yii migrate
    
You need to create a domain for your working copy e.g. example.domain
and directory `web/` as web root for domain.
    
After all you can access admin startpage through the following URL:

    http://example.domain/admin
    
Basic module admin accumulate basic user and setting management.

    /admin/auth                         admin login and logout page
    /admin/profile                      profile edition
    /admin/setting                      basic site settings
    /admin/blocks                       edit text blocks
    /admin/user                         control for users
    /admin/userlog                      log of user actions
    /admin/email                        configurate and test email

Admin template based on `AdminLTE`. Docs see here: https://github.com/ColorlibHQ/AdminLTE.

HOWTO
-------------------

**Creating module**

You can use `gii` (https://www.yiiframework.com/doc/guide/2.0/en/start-gii) for creating modules and models or can create it manually.
See `UserController` or `UserlogController` as example.

Create module directory with name you need e.g. `mymodule`.
Create class `Module` with required namespace (see docs https://www.yiiframework.com/doc/guide/2.0/en/structure-modules).

Add module to app-web.php like

    'modules' => [
        'mymodule' => [
            'class' => 'app\modules\mymodule\Module',
        ],
    ]
    
Add module to bootstrap.

    $config["bootstrap"][] = 'mymodule';
    
Create migration and model (extends `app\modules\BaseActiveRecord` to get basic feature `TimestampBehavior`).
For create admin CRUD you can use `AbstractCRUDController`.
See modules\admin\contollers\AbstractCRUDController.php learn more features.

    class AdminController extends AbstractCRUDController
    {
        protected $modelClass = MyModel::class;
    }

Add route rules to module bootstrap function.
See (https://www.yiiframework.com/doc/guide/2.0/en/runtime-routing#adding-rules).

**Load saved TextBlocks**

See function `checkWidgetType()` to check available widget types.

    TextBlock::getTextBlock($name, $widget, $isCaching = true);
    
**Load saved settings**

E.g. get setting site title.

    Setting::getCommonSetting("title")
    
**Set and get environment variable**

You can add variable to .env

    TEST_VARIABLE=test
    
To get a value anywhere you can use function `env()` like

    $value = env('TEST_VARIABLE', 'alt value');

See more features at dotenv official documentation page (https://github.com/vlucas/phpdotenv).

**Use bootstrap4 widgets**

Package has installed `yiisoft/yii2-bootstrap4` extension.
You can see official documentation (https://github.com/yiisoft/yii2-bootstrap4/blob/master/docs/guide/README.md);

Besides, you can use `kartik-v/yii2-widgets`.

**Upload image**

Add image behavior to your model.

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors["photo"] = [
            'class' => UploadImageBehavior::class,
            'attribute' => 'photo',
            'scenarios' => ['create', 'update'],
            'path' => '@webroot/uploads/mymodel/{id}',
            'url' => '@web/uploads/mymodel/{id}',
            'createThumbsOnRequest' => true,
            'thumbs' => [
                'thumb-admin' => [
                    'width' => 60,
                    'height' => 60,
                ],
            ],
        ];
        return $behaviors;
    }
    
Add rules for attribute in model.

    ["photo", "image", 'skipOnEmpty' => true, 'extensions' => 'png,jpeg,jpg', 'on' => ['create', 'update']],
    
Add widget to form.

    <?= $form->field($model, 'photo')->widget(ImageWidget::class) ?>
    
View preview of image for `DetailView`.

    [
        "attribute" => "photo",
        'label' => "Photo",
        "value" => function ($model) {
            $thumb = $model->getThumbUploadUrl("photo", "thumb-admin");
            return $model->photo ? Html::a(Html::img($thumb, ["class" => "img-thumbnail"]), $model->photo) : "";
        },
        'format' => "raw",
    ];
    
Thumbs based on `yiisoft/yii2-imagine` extension, see documentation here: https://github.com/yiisoft/yii2-imagine