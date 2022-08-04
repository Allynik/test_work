<?php
/**
 * Application requirement checker script.
 *
 * In order to run this script use the following console command:
 * php requirements.php
 *
 * In order to run this script from the web, you should copy it to the web root.
 * If you are using Linux you can create a hard link instead, using the following command:
 * ln ../requirements.php requirements.php
 */

// you may need to adjust this path to the correct Yii framework path
// uncomment and adjust the following line if Yii is not located at the default path
// $frameworkPath = dirname(__FILE__) . '/vendor/yiisoft/yii2';

if (!isset($frameworkPath)) {
    $searchPaths = [
        __DIR__ . '/vendor/yiisoft/yii2',
        __DIR__ . '/../vendor/yiisoft/yii2',
    ];
    foreach ($searchPaths as $path) {
        if (is_dir($path)) {
            $frameworkPath = $path;

            break;
        }
    }
}

if (!isset($frameworkPath) || !is_dir($frameworkPath)) {
    $message = "<h1>Error</h1>\n\n"
        . "<p><strong>The path to yii framework seems to be incorrect.</strong></p>\n"
        . '<p>You need to install Yii framework via composer or adjust the framework path in file <abbr title="' . __FILE__ . '">' . basename(__FILE__) . "</abbr>.</p>\n"
        . '<p>Please refer to the <abbr title="' . __DIR__ . "/README.md\">README</abbr> on how to install Yii.</p>\n";

    if (!empty($_SERVER['argv'])) {
        // do not print HTML when used in console mode
        echo strip_tags($message);
    } else {
        echo $message;
    }
    exit(1);
}

require_once $frameworkPath . '/requirements/YiiRequirementChecker.php';
$requirementsChecker = new YiiRequirementChecker();

$gdMemo = $imagickMemo = 'Either GD PHP extension with FreeType support or ImageMagick PHP extension with PNG support is required for image CAPTCHA.';
$gdOK = $imagickOK = false;

if (extension_loaded('imagick')) {
    $imagick = new Imagick();
    $imagickFormats = $imagick->queryFormats('PNG');
    if (in_array('PNG', $imagickFormats)) {
        $imagickOK = true;
    } else {
        $imagickMemo = 'Imagick extension should be installed with PNG support in order to be used for image CAPTCHA.';
    }
}

if (extension_loaded('gd')) {
    $gdInfo = gd_info();
    if (!empty($gdInfo['FreeType Support'])) {
        $gdOK = true;
    } else {
        $gdMemo = 'GD extension should be installed with FreeType support in order to be used for image CAPTCHA.';
    }
}

/**
 * Adjust requirements according to your application specifics.
 */
$requirements = [
    // Database :
    [
        'name' => 'PDO extension',
        'mandatory' => true,
        'condition' => extension_loaded('pdo'),
        'by' => 'All DB-related classes',
    ],
    [
        'name' => 'PDO SQLite extension',
        'mandatory' => false,
        'condition' => extension_loaded('pdo_sqlite'),
        'by' => 'All DB-related classes',
        'memo' => 'Required for SQLite database.',
    ],
    [
        'name' => 'PDO MySQL extension',
        'mandatory' => false,
        'condition' => extension_loaded('pdo_mysql'),
        'by' => 'All DB-related classes',
        'memo' => 'Required for MySQL database.',
    ],
    [
        'name' => 'PDO PostgreSQL extension',
        'mandatory' => false,
        'condition' => extension_loaded('pdo_pgsql'),
        'by' => 'All DB-related classes',
        'memo' => 'Required for PostgreSQL database.',
    ],
    // Cache :
    [
        'name' => 'Memcache extension',
        'mandatory' => false,
        'condition' => extension_loaded('memcache') || extension_loaded('memcached'),
        'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-caching-memcache.html">MemCache</a>',
        'memo' => extension_loaded('memcached') ? 'To use memcached set <a href="http://www.yiiframework.com/doc-2.0/yii-caching-memcache.html#$useMemcached-detail">MemCache::useMemcached</a> to <code>true</code>.' : '',
    ],
    // CAPTCHA:
    [
        'name' => 'GD PHP extension with FreeType support',
        'mandatory' => false,
        'condition' => $gdOK,
        'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-captcha-captcha.html">Captcha</a>',
        'memo' => $gdMemo,
    ],
    [
        'name' => 'ImageMagick PHP extension with PNG support',
        'mandatory' => false,
        'condition' => $imagickOK,
        'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-captcha-captcha.html">Captcha</a>',
        'memo' => $imagickMemo,
    ],
    // PHP ini :
    'phpExposePhp' => [
        'name' => 'Expose PHP',
        'mandatory' => false,
        'condition' => $requirementsChecker->checkPhpIniOff('expose_php'),
        'by' => 'Security reasons',
        'memo' => '"expose_php" should be disabled at php.ini',
    ],
    'phpAllowUrlInclude' => [
        'name' => 'PHP allow url include',
        'mandatory' => false,
        'condition' => $requirementsChecker->checkPhpIniOff('allow_url_include'),
        'by' => 'Security reasons',
        'memo' => '"allow_url_include" should be disabled at php.ini',
    ],
    'phpSmtp' => [
        'name' => 'PHP mail SMTP',
        'mandatory' => false,
        'condition' => strlen(ini_get('SMTP')) > 0,
        'by' => 'Email sending',
        'memo' => 'PHP mail SMTP server required',
    ],
];

$webpMemo = 'Either GD PHP extension with WebP support is required for image ImageHelper.';
$webpOK = false;

$avifMemo = 'Either GD PHP extension with AVIF support is required for image ImageHelper.';
$avifOK = false;

if (extension_loaded('gd')) {
    $gdInfo = gd_info();
    if (!empty($gdInfo['WebP Support'])) {
        $webpOK = true;
    } else {
        $webpMemo = 'GD extension should be installed with WebP support in order to be used for image ImageHelper.';
    }

    if (!empty($gdInfo['AVIF Support'])) {
        $avifOK = true;
    } else {
        $avifMemo = 'GD extension should be installed with AVIF support in order to be used for image ImageHelper.';
    }
}

$requirements[] = [
    'name' => 'GD PHP extension with WebP support',
    'mandatory' => true,
    'condition' => $webpOK,
    'by' => 'ImageHelper',
    'memo' => $webpMemo,
];

$requirements[] = [
    'name' => 'GD PHP extension with AVIF support',
    'mandatory' => false,
    'condition' => $avifOK,
    'by' => 'ImageHelper',
    'memo' => $avifMemo,
];

$uploadTempDir = ini_get('upload_tmp_dir') ?: sys_get_temp_dir();
$requirements[] = [
    'name' => 'PHP upload temp directory',
    'mandatory' => true,
    'condition' => $uploadTempDir && is_writable($uploadTempDir),
    'by' => '',
    'memo' => '"upload_tmp_dir" should be writable',
];

$sessionSavePath = ini_get('session.save_path') ?: session_save_path();
$requirements[] = [
    'name' => 'PHP session save path directory',
    'mandatory' => true,
    'condition' => $sessionSavePath && is_writable($sessionSavePath),
    'by' => '',
    'memo' => '"session.save_path" should be writable',
];

$sessionSaveHandler = ini_get('session.save_handler');
$requirements[] = [
    'name' => 'PHP session save handler',
    'mandatory' => true,
    'condition' => 'files' == $sessionSaveHandler,
    'by' => '',
    'memo' => '"session.save_handler" should be "files"',
];

$requirements[] = [
    'name' => 'PHP allow url file open',
    'mandatory' => false,
    'condition' => $requirementsChecker->checkPhpIniOn('allow_url_fopen'),
    'by' => '',
    'memo' => '"allow_url_fopen" should be enabled at php.ini',
];

$requirements[] = [
    'name' => 'Iconv extension',
    'mandatory' => false,
    'condition' => extension_loaded('iconv'),
    'by' => '',
    'memo' => 'Required for multibyte encoding string processing.',
];

$requirements[] = [
    'name' => 'Filter extension',
    'mandatory' => false,
    'condition' => extension_loaded('filter'),
    'by' => '',
    'memo' => 'Required for input string validation and sanitization.',
];

$requirements[] = [
    'name' => 'CURL extension',
    'mandatory' => false,
    'condition' => extension_loaded('curl'),
    'by' => '',
    'memo' => 'Required for HTTP processing.',
];

// OPcache check
if (!version_compare(PHP_VERSION, '5.5', '>=')) {
    $requirements[] = [
        'name' => 'APC extension',
        'mandatory' => false,
        'condition' => extension_loaded('apc'),
        'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-caching-apccache.html">ApcCache</a>',
    ];
}

$result = $requirementsChecker->checkYii()->check($requirements)->getResult();
$requirementsChecker->render();
exit(0 === $result['summary']['errors'] ? 0 : 1);
