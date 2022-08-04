<?php

namespace app\helpers;

use Yii;
use yii\base\Component;
use yii\helpers\{Inflector, ArrayHelper};

class AssetsHelper extends Component
{
    public $app = 'app';
    public $integrity = true;
    public $urlmtime = true;
    public $urlbrotli = true;
    public $preload = true;
    public $crossorigin = false;
    public $optionsCallback = false;

    public static function urlmtime($url)
    {
        $path = Yii::getAlias('@webroot') . $url;

        return $url . '?' . (file_exists($path) ? filemtime($path) : '');
    }

    public static function urlbrotli($url)
    {
        $path = Yii::getAlias('@webroot') . $url . '.br';

        return file_exists($path) ? $url . '.br' : $url;
    }

    public static function registerManifest($url, array $options = [])
    {
        $path = Yii::getAlias('@webroot') . $url;
        $manifest = json_decode(file_get_contents($path));

        $appOption = ArrayHelper::getValue($options, 'app', Yii::$app->assetsHelper->app);
        $integrityOption = ArrayHelper::getValue($options, 'integrity', Yii::$app->assetsHelper->integrity);
        $urlmtimeOption = ArrayHelper::getValue($options, 'urlmtime', Yii::$app->assetsHelper->urlmtime);
        $urlbrotliOption = ArrayHelper::getValue($options, 'urlbrotli', Yii::$app->assetsHelper->urlbrotli);
        $preloadOption = ArrayHelper::getValue($options, 'preload', Yii::$app->assetsHelper->preload);
        $crossoriginOption = ArrayHelper::getValue($options, 'crossorigin', Yii::$app->assetsHelper->crossorigin);
        $optionsCallback = ArrayHelper::getValue($options, 'optionsCallback', Yii::$app->assetsHelper->optionsCallback);

        $view = Yii::$app->view;
        $request = Yii::$app->request;
        $response = Yii::$app->response;
        $isAsyncRequest = ('yes' == $request->headers->get('X-Barba') || $request->isAjax || $request->isPjax);
        $isAcceptBrotli = (isset($request->acceptableEncodings) && in_array('br', $request->acceptableEncodings));

        if (!isset($manifest->entrypoints->{$appOption}->assets->css)) {
            throw new \Exception(sprintf('Unknown entrypoint \'%s\' in manifest \'%s\'.', $appOption, $url));
        }
        foreach ($manifest->entrypoints->{$appOption}->assets->css as $entry) {
            $linkUrl = $entry->src;
            if ($urlbrotliOption && $isAcceptBrotli) {
                $linkUrl = self::urlbrotli($linkUrl);
            }
            if ($urlmtimeOption) {
                $linkUrl = self::urlmtime($linkUrl);
            }
            $linkOptions = [];
            $linkOptions['id'] = Inflector::slug('css-' . basename($entry->src, '.min.css'), '-', false);
            if ($integrityOption) {
                $linkOptions['integrity'] = $entry->integrity;
            }
            if ($crossoriginOption) {
                $linkOptions['crossorigin'] = $crossoriginOption;
            }
            if ($optionsCallback) {
                $linkOptions = call_user_func_array($optionsCallback, [$linkOptions, $entry]);
            }
            $view->registerCssFile($linkUrl, $linkOptions, $entry->src);
            if ($preloadOption && !$isAsyncRequest) {
                $linkPreload = ["<{$linkUrl}>", 'rel=preload', 'as=style'];
                if ($integrityOption) {
                    $linkPreload[] = "integrity={$entry->integrity};";
                }
                if ($crossoriginOption) {
                    $linkPreload[] = "crossorigin={$crossoriginOption};";
                }
                $response->headers->add('Link', implode('; ', $linkPreload));
            }
        }

        if (!isset($manifest->entrypoints->{$appOption}->assets->js)) {
            throw new \Exception(sprintf('Unknown entrypoint \'%s\' in manifest \'%s\'.', $appOption, $url));
        }
        foreach ($manifest->entrypoints->{$appOption}->assets->js as $entry) {
            $linkUrl = $entry->src;
            if ($urlbrotliOption && $isAcceptBrotli) {
                $linkUrl = self::urlbrotli($linkUrl);
            }
            if ($urlmtimeOption) {
                $linkUrl = self::urlmtime($linkUrl);
            }
            $linkOptions = [];
            $linkOptions['id'] = Inflector::slug('js-' . basename($entry->src, '.min.js'), '-', false);
            if ($integrityOption) {
                $linkOptions['integrity'] = $entry->integrity;
            }
            if ($crossoriginOption) {
                $linkOptions['crossorigin'] = $crossoriginOption;
            }
            if ($optionsCallback) {
                $linkOptions = call_user_func_array($optionsCallback, [$linkOptions, $entry]);
            }
            $view->registerJsFile($linkUrl, $linkOptions, $entry->src);
            if ($preloadOption && !$isAsyncRequest) {
                $linkPreload = ["<{$linkUrl}>", 'rel=preload', 'as=script'];
                if ($integrityOption) {
                    $linkPreload[] = "integrity={$entry->integrity};";
                }
                if ($crossoriginOption) {
                    $linkPreload[] = "crossorigin={$crossoriginOption};";
                }
                $response->headers->add('Link', implode('; ', $linkPreload));
            }
        }
    }
}
