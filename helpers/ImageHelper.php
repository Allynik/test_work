<?php

namespace app\helpers;

use ArrayObject;
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;

class ImageHelper extends Component
{
    /**
     * The original image is scaled so it is fully contained within the thumbnail dimensions (the image width/height ratio doesn't change).
     *
     * @var int
     */
    public const MODE_INSET = 0x00000001;

    /**
     * The thumbnail is scaled so that its smallest side equals the length of the corresponding side in the original image (the width or the height are cropped).
     *
     * @var int
     */
    public const MODE_OUTBOUND = 0x00000002;

    /**
     * Allow upscaling the image if it's smaller than the wanted thumbnail size.
     *
     * @var int
     */
    public const MODE_FLAG_UPSCALE = 0x00010000;

    /**
     * Wepb options.
     *
     * @var array
     */
    public $webp = [
        'enabled' => false,
        'quality' => 90, // 0 - 100, or 100 for lossless
    ];

    /**
     * Avif options.
     *
     * @var array
     */
    public $avif = [
        'enabled' => false,
        'quality' => 90, // 0 - 100, or 100 for lossless
    ];

    /**
     * JPG options.
     *
     * @var array
     */
    public $jpg = [
        'quality' => 90, // 0 - 100
    ];

    /**
     * PNG options.
     *
     * @var array
     */
    public $png = [
        'quality' => 100, // 0 - 100, or 100 for lossless
    ];

    /**
     * Get the size of an image.
     *
     * @param string $url
     * @param bool   $nocache
     *
     * @return ArrayObject(width, height, type, mime, ext, ratio)
     */
    public static function getSize($url, $nocache = false)
    {
        static $cache = [];
        $result = ['width' => 0, 'height' => 0, 'type' => 0, 'mime' => '', 'ext' => '', 'ratio' => 0, 'intrinsicsize' => ''];
        if (!isset($cache[$url]) || $nocache) {
            $path = Yii::getAlias($url);
            if (is_readable($path)) {
                $result = array_merge($result, self::getSizeInternal($path));
            }
            $cache[$url] = $result;
        } elseif (isset($cache[$url])) {
            $result = $cache[$url];
        }

        return new ArrayObject($result, ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Generate image thumbnail.
     *
     * @param $path
     * @param $thumbPath
     */
    public static function generateThumb(array $config, $path, $thumbPath = null)
    {
        $width = ArrayHelper::getValue($config, 'width');
        $height = ArrayHelper::getValue($config, 'height');
        $mode = (int) ArrayHelper::getValue($config, 'mode', self::MODE_INSET);

        $background = ArrayHelper::getValue($config, 'background', 'FFF');
        Image::$thumbnailBackgroundColor = $background;

        $pathInfo = pathinfo($path);
        $profile = ArrayHelper::getValue($config, 'profile', 'thumb');
        if (!$thumbPath) {
            $thumbPath = $pathInfo['dirname'] . '/thumbs/' . $profile . '-' . $pathInfo['filename'] . '.' . $pathInfo['extension'];
        }

        $thumbInfo = pathinfo($thumbPath);
        $extension = ArrayHelper::getValue($config, 'extension', '');
        if ($extension) {
            $thumbPath = $thumbInfo['dirname'] . '/' . $thumbInfo['filename'] . '.' . $extension;
        }

        $options = ArrayHelper::getValue($config, 'options', []);

        $thumbExtension = strtolower($thumbInfo['extension']);
        if ('webp' == $thumbExtension) {
            $lossless = ArrayHelper::getValue($config, 'lossless', 'png' == strtolower($pathInfo['extension']));
            $quality = ArrayHelper::getValue($config, 'quality', Yii::$app->imageHelper->webp['quality']);
            if ($lossless || 100 == $quality) {
                $options['webp_lossless'] = true;
            }
        } elseif ('avif' == $thumbExtension) {
            $lossless = ArrayHelper::getValue($config, 'lossless', 'png' == strtolower($pathInfo['extension']));
            $quality = ArrayHelper::getValue($config, 'quality', Yii::$app->imageHelper->avif['quality']);
            if ($lossless) {
                $options['avif_lossless'] = true;
            }
        } elseif ('jpg' == $thumbExtension || 'jpeg' == $thumbExtension) {
            $quality = ArrayHelper::getValue($config, 'quality', Yii::$app->imageHelper->jpg['quality']);
        } elseif ('png' == $thumbExtension) {
            $quality = ArrayHelper::getValue($config, 'quality', Yii::$app->imageHelper->png['quality']);
        } else {
            $quality = ArrayHelper::getValue($config, 'quality', 90);
        }

        $operation = 'thumbnail';
        if (!$width || !$height) {
            $image = Image::getImagine()->open($path);
            $size = $image->getSize();
            if (!$width && !$height) {
                $width = $size->getWidth();
                $height = $size->getHeight();
                $operation = 'open';
            } else {
                $ratio = $size->getWidth() / $size->getHeight();
                if ($width) {
                    $height = ceil($width / $ratio);
                } else {
                    $width = ceil($height * $ratio);
                }
            }
        }
        $options['quality'] = $quality;

        $dirname = dirname($thumbPath);
        if (!is_dir($dirname)) {
            mkdir($dirname, 0777, true);
        }

        if ('thumbnail' === $operation) {
            Image::thumbnail($path, $width, $height, $mode)->save($thumbPath, $options);
        } elseif ('open' === $operation) {
            Image::getImagine()->open($path)->save($thumbPath, $options);
        } else {
            throw new \Exception('Unknown image operation');
        }

        return $thumbPath;
    }

    /**
     * Create thumbnail path.
     *
     * @param string $path
     *
     * @return string
     */
    public static function getThumbFileName(array $config, $path)
    {
        $pathinfo = pathinfo($path);

        $profile = ArrayHelper::getValue($config, 'profile', 'thumb');
        $extension = ArrayHelper::getValue($config, 'extension', $pathinfo['extension']);

        $width = ArrayHelper::getValue($config, 'width');
        $height = ArrayHelper::getValue($config, 'height');
        $prefix = '@resize-' . ($width ? (int) $width : '') . 'x' . ($height ? (int) $height : $height) . '-' . $profile;

        return 'thumbs/' . $pathinfo['filename'] . $prefix . '.' . $extension;
    }

    /**
     * Create image thumbnail.
     *
     * @param string $url
     */
    public static function createThumb(array $config, $url)
    {
        $path = Yii::getAlias($url);
        $thumbPath = pathinfo($path, PATHINFO_DIRNAME) . '/' . self::getThumbFileName($config, $path);

        $checksumAlgo = 'crc32c';
        $cacheComponent = Yii::$app->cache;
        $checksumPath = $cacheComponent->getOrSet(__CLASS__ . '::' . $path, fn () => hash_file($checksumAlgo, $path));
        $cacheThumbKey = __CLASS__ . '::' . $checksumPath . '::' . $thumbPath;

        if (!is_file($thumbPath)) {
            self::generateThumb($config, $path, $thumbPath);
            touch($thumbPath, filemtime($path));
            $cacheComponent->set($cacheThumbKey, hash_file($checksumAlgo, $thumbPath));
        } elseif (filemtime($path) != filemtime($thumbPath)) {
            $cacheMiss = false;
            $checksumThumb = $cacheComponent->get($cacheThumbKey);
            if (false === $checksumThumb) {
                $cacheMiss = true;
                $cacheComponent->set($cacheThumbKey, hash_file($checksumAlgo, $thumbPath));
            } elseif ($checksumThumb != hash_file($checksumAlgo, $thumbPath)) {
                $cacheMiss = true;
            }
            if ($cacheMiss) {
                self::generateThumb($config, $path, $thumbPath);
            }
            touch($thumbPath, filemtime($path));
        } else {
            $checksumThumb = $cacheComponent->getOrSet($cacheThumbKey, fn () => hash_file($checksumAlgo, $thumbPath));
        }

        $rootAlias = Yii::getRootAlias($url);
        $rootPath = Yii::getAlias($rootAlias);
        $thumbUrl = substr_replace($thumbPath, '', strpos($thumbPath, $rootPath), strlen($rootPath));

        return $thumbUrl;
    }

    /**
     * Iterate image thumbnails.
     *
     * @param string $root
     *
     * @return Iterator
     */
    public static function iterateThumbs($root = null)
    {
        $rootPath = Yii::getAlias('@app/web' . $root);

        $dirIterator = new \RecursiveIteratorIterator(
            new \RecursiveCallbackFilterIterator(
                new \RecursiveDirectoryIterator($rootPath),
                fn ($current) => !($current->isDir() && 'node_modules' === $current->getBasename()),
            ),
        );

        $pattern = '/^.+\@resize\-.+\.(png|jpg|jpeg|avif|webp)$/i';

        $filesIterator = new \CallbackFilterIterator(
            $dirIterator,
            fn ($current) => $current->isFile() && preg_match($pattern, (string) $current),
        );

        return $filesIterator;
    }

    protected function getSizeInternal($path)
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        if ('jpg' == $extension || 'jpeg' == $extension || 'png' == $extension || 'gif' == $extension) {
            $size = @getimagesize($path);
            if (!$size) {
                error_clear_last(); // clear @-operator

                return [];
            }

            $result = [];
            $result['width'] = (int) $size[0];
            $result['height'] = (int) $size[1];
            $result['type'] = $size[2];
            $result['mime'] = image_type_to_mime_type($size[2]);
            $result['ext'] = image_type_to_extension($size[2], false);
            $result['ratio'] = ($result['width'] && $result['height'] ? $result['width'] / $result['height'] : 0);
            $result['intrinsicsize'] = ($result['width'] && $result['height'] ? $result['width'] . 'x' . $result['height'] : '');

            return $result;
        }
        if ('svg' == $extension) {
            $svg = file_get_contents($path);
            if (!preg_match('/<svg\s([^>"\']|"[^"]*"|\'[^\']*\')*>/', $svg, $svgMatches)) {
                return [];
            }

            preg_match('/\swidth=([\'"])([^%]+?)\1/', $svgMatches[0], $widthMatches);
            preg_match('/\sheight=([\'"])([^%]+?)\1/', $svgMatches[0], $heightMatches);
            preg_match('/\sviewBox=([\'"])(.+?)\1/i', $svgMatches[0], $viewboxMatches);
            $width = isset($widthMatches[2]) ? (int) $widthMatches[2] : 0;
            $height = isset($heightMatches[2]) ? (int) $heightMatches[2] : 0;
            $viewbox = isset($viewboxMatches[2]) ? explode(' ', $viewboxMatches[2], 4) : [];

            $result = [];
            $result['width'] = $width ?: (isset($viewbox[2]) ? (int) $viewbox[2] : 0);
            $result['height'] = $height ?: (isset($viewbox[3]) ? (int) $viewbox[3] : 0);
            $result['type'] = 0;
            $result['mime'] = 'image/svg';
            $result['ext'] = 'svg';
            $result['ratio'] = ($result['width'] && $result['height'] ? $result['width'] / $result['height'] : 0);
            $result['intrinsicsize'] = ($result['width'] && $result['height'] ? $result['width'] . 'x' . $result['height'] : '');

            return $result;
        }

        return [];
    }
}
