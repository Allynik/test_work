<?php

// resolve symlink www dir
chdir(realpath(getcwd()));

$appRoot = realpath(__DIR__ . '/../../../..');

require $appRoot . '/vendor/autoload.php';
require $appRoot . '/bootstrap.php';

dotenv($appRoot . '/')->load();
dotenv()->required('APP_DEBUG')->isBoolean();
dotenv()->required('APP_ENV')->allowedValues(['prod', 'dev']);

define('YII_DEBUG', env('APP_DEBUG'));
define('YII_ENV', env('APP_ENV'));

require $appRoot . '/vendor/yiisoft/yii2/Yii.php';

$config = require $appRoot . '/config/app-web.php';
$app = (new yii\web\Application($config));
$session = $app->session;

$error_reporting = error_reporting() & ~E_NOTICE & ~E_STRICT & ~E_WARNING;
define("ELFINDER_DEBUG_ERRORLEVEL", $error_reporting);
error_reporting($error_reporting);

require "./autoload.php";

define("ELFINDER_DISABLE_ZIPEDITOR", true);
elFinder::$netDrivers = array();

$ACCESS_CONFIG = array();
$ACCESS_CONFIG["disabled"] = true;
$ACCESS_CONFIG["readonly"] = true;

$ACCESS_MIMES = include (__DIR__ . "/connector.mimes.php");
$ACCESS_USERFILES = false;

// check user and autostart yii session
if ($session->get("__id")) {
    if ($session->get("__id") == 1) {
        $ACCESS_CONFIG["disabled"] = false;
        $ACCESS_CONFIG["readonly"] = false;
    }
}

// redirect to userfiles
if ($ACCESS_USERFILES && $ACCESS_CONFIG["disabled"] && $ACCESS_CONFIG["readonly"]) {
    $_GET["type"] = "userfiles";
}

$ACCESS_DIR = "";
switch(isset($_GET["type"]) ? (string)$_GET["type"] : "") {
    case "files":
       $ACCESS_DIR = "files";
    break;

    case "images":
        $ACCESS_DIR = "images";
    break;

    case "flash":
        $ACCESS_DIR = "flash";
    break;

    case "userfiles":
        if ($ACCESS_USERFILES && !$user->isAnonym()) {
            $ACCESS_DIR = "userfiles/user-" . $user->getId();
            $ACCESS_CONFIG["disabled"] = false;
            $ACCESS_CONFIG["readonly"] = false;
        } else {
            $ACCESS_DIR = "";
            $ACCESS_CONFIG["disabled"] = true;
            $ACCESS_CONFIG["readonly"] = true;
        }
    break;

    default:
        $ACCESS_DIR = "files";
}

/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from "." (dot)
 *
 * @param  string    $attr    attribute name (read|write|locked|hidden)
 * @param  string    $path    absolute file path
 * @param  string    $data    value of volume option `accessControlData`
 * @param  object    $volume  elFinder volume driver object
 * @param  bool|null $isDir   path is directory (true: directory, false: file, null: unknown)
 * @param  string    $relpath file path relative to volume root directory started with directory separator
 * @return bool|null
 **/
function accessCallback($attr, $path, $data, $volume, $isDir, $relpath) {
    $basename = basename($path);
    if (
        $basename[0] === "." // if file/folder begins with "." (dot)
        && strlen($relpath) !== 1 // but with out volume root
    ) {
        return !($attr == "read" || $attr == "write"); // set read+write to false, other (locked+hidden) set to true
    }
    return null;
}

// Documentation for connector options:
$disabledCommands = array("extract", "archive", "empty", "netmount", "hide");
// https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
$opts = array(
    "debug" => true,
    "roots" => array(
        // Items volume
        array(
            "alias"          => "/uploads/$ACCESS_DIR",
            "driver"         => "LocalFileSystem", // driver for accessing file system (REQUIRED)
            "path"           => $_SERVER["DOCUMENT_ROOT"] . "/uploads/{$ACCESS_DIR}/", // path to files (REQUIRED)
            "URL"            => "/uploads/{$ACCESS_DIR}/", // URL to files (REQUIRED)
            "trashHash"      => "t1_Lw", // elFinder"s hash of trash folder
            "winHashFix"     => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
            "uploadDeny"     => array("all"), // All Mimetypes not allowed to upload
            "uploadAllow"    => ($ACCESS_CONFIG["readonly"] ? array() : $ACCESS_MIMES), // Same as above
            "uploadOrder"    => array("deny", "allow"), // allowed Mimetype `image` and `text/plain` only
            "accessControl"  => "accessCallback", // disable and hide dot starting files (OPTIONAL)
            "disabled"       => $disabledCommands,
            "jpgQuality"     => 85,
            "jpgProgressive" => true,
            "tmbCrop"        => false,
        ),
        // Trash volume
        array(
            "id"             => "1",
            "driver"         => "Trash",
            "path"           => $_SERVER["DOCUMENT_ROOT"] . "/uploads/{$ACCESS_DIR}/.trash/",
            "tmbURL"         => "/uploads/{$ACCESS_DIR}/.trash/.tmb/",
            "winHashFix"     => DIRECTORY_SEPARATOR !== "/", // to make hash same to Linux one on windows too
            "uploadDeny"     => array("all"),   // Recomend the same settings as the original volume that uses the trash
            "uploadAllow"    => ($ACCESS_CONFIG["readonly"] ? array() : $ACCESS_MIMES), // Same as above
            "uploadOrder"    => array("deny", "allow"), // Same as above
            "accessControl"  => "accessCallback", // Same as above
            "disabled"       => $disabledCommands, // Same as above
            "jpgQuality"     => 85, // Same as above
            "jpgProgressive" => true, // Same as above
            "tmbCrop"        => false, // Same as above
        ),
    ),
    "bind" => array(
        "upload.pre mkdir.pre mkfile.pre rename.pre archive.pre ls.pre" => array(
            "Plugin.Sanitizer.cmdPreprocess",
            "Plugin.Normalizer.cmdPreprocess",
        ),
        "upload.presave" => array(
            "Plugin.Sanitizer.onUpLoadPreSave",
            "Plugin.Normalizer.onUpLoadPreSave",
        ),
        "upload.presave" => array(
           "Plugin.AutoResize.onUpLoadPreSave",
        ),
    ),
    "plugin" => array(
        "Sanitizer" => array(
            "enable" => true,
        ),
        "Normalizer" => array(
            "enable" => true,
        ),
        "AutoResize" => array(
            "enable"         => true,       // For control by volume driver
            "maxWidth"       => 1920,       // Path to Water mark image
            "maxHeight"      => 1080,       // Margin right pixel
            "quality"        => 95,         // JPEG image save quality
        ),
    ),
);

// translate files
if (isset($_FILES) && is_array($_FILES)) {
    foreach ($_FILES as $k => $v) {
        if (is_array($v) && isset($v["name"])) {
            if (is_array($v["name"])) {
                foreach ($v["name"] as $kk => $vv) {
                    if (is_string($vv)) {
                        $filename = yii\helpers\Inflector::slug(pathinfo($vv, PATHINFO_FILENAME));
                        $ext = pathinfo($vv, PATHINFO_EXTENSION);
                        if ($ext != "") {
                            $filename .= "." . $ext;
                        }
                        $_FILES[$k]["name"][$kk] = $filename;
                    }
                }
            } elseif (is_string($v["name"])) {
                $filename = yii\helpers\Inflector::slug(pathinfo($v["name"], PATHINFO_FILENAME));
                $ext = pathinfo($v["name"], PATHINFO_EXTENSION);
                if ($ext != "") {
                    $filename .= "." . $ext;
                }
                $_FILES[$k]["name"] = $filename;
            }
        }
    }
}

// translate dirs
if (isset($_GET["name"]) && is_string($_GET["name"])) {
    $filename = yii\helpers\Inflector::slug(pathinfo($_GET["name"], PATHINFO_FILENAME));
    $ext = pathinfo($_GET["name"], PATHINFO_EXTENSION);
    if ($ext != "") {
        $filename .= "." . $ext;
    }
    $_GET["name"] = $filename;
}

if (!$ACCESS_CONFIG["disabled"] && $ACCESS_DIR) {
    // autocreate dirs
    $dirChmod = 0600;
    foreach ($opts["roots"] as $i) {
        if ($i["driver"] == "LocalFileSystem" || $i["driver"] == "Trash") {
            if (!@is_readable($i["path"])) {
                @mkdir($i["path"], $dirChmod, true);
            }
        }
    }
    // run elFinder
    $connector = new elFinderConnector(new elFinder($opts));
    $connector->run();
} else {
    echo yii\helpers\Json::encode([
        "error" => "403" . ($ACCESS_USERFILES ? ": access denied" : ": userfiles disabled"),
    ]);
}
