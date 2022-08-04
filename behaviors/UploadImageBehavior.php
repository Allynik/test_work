<?php

namespace app\behaviors;

use app\helpers\ImageHelper;
use Yii;
use yii\base\{InvalidArgumentException, InvalidConfigException};
use yii\db\BaseActiveRecord;
use yii\helpers\{ArrayHelper, FileHelper};

/**
 * Upload behavior.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class UploadImageBehavior extends UploadBehavior
{
    /**
     * @var string
     */
    public $placeholder;

    /**
     * @var bool
     */
    public $createThumbsOnSave = true;

    /**
     * @var bool
     */
    public $createThumbsOnRequest = false;

    /**
     * Whether delete original uploaded image after thumbs generating.
     * Defaults to FALSE.
     *
     * @var bool
     */
    public $deleteOriginalFile = false;

    /**
     * @var array the thumbnail profiles
     *            - `width`
     *            - `height`
     *            - `quality`
     */
    public $thumbs = [
        // 'thumb' => ['width' => 200, 'height' => 200],
    ];

    /**
     * @var string|null
     */
    public $thumbPath;

    /**
     * @var string|null
     */
    public $thumbUrl;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if ($this->createThumbsOnSave || $this->createThumbsOnRequest) {
            if (null === $this->thumbPath) {
                $this->thumbPath = $this->path;
            }
            if (null === $this->thumbUrl) {
                $this->thumbUrl = $this->url;
            }
        }

        foreach ($this->thumbs as $profile => $config) {
            $width = ArrayHelper::getValue($config, 'width');
            $height = ArrayHelper::getValue($config, 'height');
            $config['profile'] = $profile;
            if ($height < 1 && $width < 1) {
                throw new InvalidConfigException(sprintf('Length of either side of thumb cannot be 0 or negative, current size ' . 'is %sx%s', $width, $height));
            }
        }
    }

    /**
     * @param string $attribute
     * @param string $profile
     * @param bool   $old
     *
     * @return string
     */
    public function getThumbUploadPath($attribute, $profile = 'thumb', $old = false)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        $path = $this->resolvePath($this->thumbPath);
        $attribute = (true === $old) ? $model->getOldAttribute($attribute) : $model->$attribute;
        $filename = $this->getThumbFileName($attribute, $profile);

        return $filename ? Yii::getAlias($path . '/' . $filename) : null;
    }

    /**
     * @param string $attribute
     * @param string $profile
     *
     * @return string|null
     */
    public function getThumbUploadUrl($attribute, $profile = 'thumb')
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;

        if ($this->createThumbsOnRequest) {
            $this->createThumbs();
        }

        if (is_file($this->getThumbUploadPath($attribute, $profile))) {
            $url = $this->resolvePath($this->thumbUrl);
            $fileName = $model->getOldAttribute($attribute);
            $thumbName = $this->getThumbFileName($fileName, $profile);

            return $thumbName ? Yii::getAlias($url . '/' . $thumbName) : null;
        } elseif ($this->placeholder) {
            return $this->getPlaceholderUrl($profile);
        } else {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function afterUpload()
    {
        parent::afterUpload();
        if ($this->createThumbsOnSave) {
            $this->createThumbs();
        }
    }

    /**
     * @throws \yii\base\InvalidArgumentException
     */
    protected function createThumbs()
    {
        $path = $this->getUploadPath($this->attribute);
        if (!is_file($path)) {
            return;
        }

        foreach ($this->thumbs as $profile => $config) {
            if (isset($config['extension'])) {
                if ('webp' == $config['extension'] && !Yii::$app->imageHelper->webp['enabled']) {
                    continue;
                }
                if ('avif' == $config['extension'] && !Yii::$app->imageHelper->avif['enabled']) {
                    continue;
                }
            }
            $thumbPath = $this->getThumbUploadPath($this->attribute, $profile);
            if (null !== $thumbPath) {
                if (!FileHelper::createDirectory(dirname($thumbPath))) {
                    throw new InvalidArgumentException("Directory specified in 'thumbPath' attribute doesn't exist or cannot be created.");
                }

                if (!is_file($thumbPath)) {
                    ImageHelper::generateThumb($config, $path, $thumbPath);
                    touch($thumbPath, filemtime($path));
                } elseif (filemtime($path) != filemtime($thumbPath)) {
                    ImageHelper::generateThumb($config, $path, $thumbPath);
                    touch($thumbPath, filemtime($path));
                }
            }
        }

        if ($this->deleteOriginalFile) {
            parent::delete($this->attribute);
        }
    }

    /**
     * @param $profile
     *
     * @return string
     */
    protected function getPlaceholderUrl($profile)
    {
        [$path, $url] = Yii::$app->assetManager->publish($this->placeholder);
        $filename = basename($path);
        $thumbName = $this->getThumbFileName($filename, $profile);
        if ($thumbName) {
            $thumbPath = dirname($path) . DIRECTORY_SEPARATOR . $thumbName;
            $thumbUrl = dirname($url) . '/' . $thumbName;

            if (!is_file($thumbPath)) {
                $config = $this->thumbs[$profile];
                ImageHelper::generateThumb($config, $path, $thumbPath);
                touch($thumbPath, filemtime($path));
            }
        } else {
            $thumbUrl = null;
        }

        return $thumbUrl;
    }

    /**
     * {@inheritdoc}
     */
    protected function delete($attribute, $old = false)
    {
        parent::delete($attribute, $old);
        foreach (array_keys($this->thumbs) as $profile) {
            $path = $this->getThumbUploadPath($attribute, $profile, $old);
            if (is_file($path)) {
                unlink($path);
            }
        }
    }

    /**
     * @param $filename
     * @param string $profile
     *
     * @return string
     */
    protected function getThumbFileName($filename, $profile = 'thumb')
    {
        $config = $this->thumbs[$profile];
        $config['profile'] = $profile;

        return $filename ? ImageHelper::getThumbFileName($config, $filename) : null;
    }
}
