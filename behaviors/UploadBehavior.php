<?php

namespace app\behaviors;

use Closure;
use Yii;
use yii\base\{Behavior, InvalidArgumentException, InvalidConfigException};
use yii\db\BaseActiveRecord;
use yii\helpers\{ArrayHelper, FileHelper, Inflector};
use yii\web\UploadedFile;

/**
 * Upload behavior.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class UploadBehavior extends Behavior
{
    /**
     * @event Event an event that is triggered after a file is uploaded.
     */
    public const EVENT_AFTER_UPLOAD = 'afterUpload';

    /**
     * @var string the attribute which holds the attachment
     */
    public $attribute;

    /**
     * @var array the scenarios in which the behavior will be triggered
     */
    public $scenarios = [];

    /**
     * @var string the base path or path alias to the directory in which to save files
     */
    public $path;

    /**
     * @var string the base URL or path alias for this file
     */
    public $url;

    /**
     * @var bool Getting file instance by name
     */
    public $instanceByName = false;

    /**
     * @var bool|callable generate a new unique name for the file
     *                    set true or anonymous function takes the old filename and returns a new name
     *
     * @see self::generateFileName()
     */
    public $generateNewName = true;

    /**
     * @var bool If `true` current attribute file will be deleted
     */
    public $unlinkOnSave = true;

    /**
     * @var bool if `true` current attribute file will be deleted after model deletion
     */
    public $unlinkOnDelete = true;

    /**
     * @var bool whether to delete the temporary file after saving
     */
    public $deleteTempFile = true;

    /**
     * @var UploadedFile the uploaded file instance
     */
    protected $file;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (null === $this->attribute) {
            throw new InvalidConfigException('The "attribute" property must be set.');
        }
        if (null === $this->path) {
            throw new InvalidConfigException('The "path" property must be set.');
        }
        if (null === $this->url) {
            throw new InvalidConfigException('The "url" property must be set.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }

    /**
     * This method is invoked before validation starts.
     */
    public function beforeValidate()
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        if (in_array($model->scenario, $this->scenarios)) {
            if (($file = $model->getAttribute($this->attribute)) instanceof UploadedFile) {
                $this->file = $file;
            } else {
                if (true === $this->instanceByName) {
                    $this->file = UploadedFile::getInstanceByName($this->attribute);
                } else {
                    $this->file = UploadedFile::getInstance($model, $this->attribute);
                }
            }
            if ($this->file instanceof UploadedFile) {
                $this->file->name = $this->getFileName($this->file);
                $model->setAttribute($this->attribute, $this->file);
            }
        }
    }

    /**
     * This method is called at the beginning of inserting or updating a record.
     */
    public function beforeSave()
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        $request = Yii::$app->request;
        $data = $request->post();
        if (in_array($model->scenario, $this->scenarios)) {
            if ($this->file instanceof UploadedFile) {
                if (!$model->getIsNewRecord() && $model->isAttributeChanged($this->attribute)) {
                    if (true === $this->unlinkOnSave) {
                        $this->delete($this->attribute, true);
                    }
                }

                if (!$model->getIsNewRecord()) {
                    $model->setAttribute($this->attribute, $this->getFullPath($this->file->name));
                }
            } else {
                if (isset($data[$model->formName()][$this->attribute . '-delete'])
                    && (int) $data[$model->formName()][$this->attribute . '-delete']) {
                    // Unlink file
                    $this->delete($this->attribute, true);
                    $model->{$this->attribute} = null;
                } else {
                    // Protect attribute
                    unset($model->{$this->attribute});
                }
            }
        } else {
            if (!$model->getIsNewRecord() && $model->isAttributeChanged($this->attribute)) {
                if (true === $this->unlinkOnSave) {
                    $this->delete($this->attribute, true);
                }
            }
        }
    }

    /**
     * This method is called at the end of inserting a record.
     */
    public function afterInsert()
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        if ($this->file instanceof UploadedFile) {
            $this->unlinkOnSave = false;
            $model->save(false);
        }
    }

    /**
     * This method is called at the end of updating a record.
     *
     * @throws \yii\base\InvalidArgumentException
     */
    public function afterSave()
    {
        if ($this->file instanceof UploadedFile) {
            $path = $this->getUploadPath($this->attribute);
            if (is_string($path) && FileHelper::createDirectory(dirname($path))) {
                $this->save($this->file, $path);
                $this->afterUpload();
            } else {
                throw new InvalidArgumentException("Directory specified in 'path' attribute doesn't exist or cannot be created.");
            }
        }
    }

    /**
     * This method is invoked after deleting a record.
     */
    public function afterDelete()
    {
        $attribute = $this->attribute;
        if ($this->unlinkOnDelete && $attribute) {
            $this->delete($attribute);
        }
    }

    /**
     * Returns file path for the attribute.
     *
     * @param string $attribute
     * @param bool   $old
     *
     * @return string|null the file path
     */
    public function getUploadPath($attribute, $old = false)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        $fileName = (true === $old) ? $model->getOldAttribute($attribute) : $model->$attribute;
        $filePath = pathinfo($fileName, PATHINFO_DIRNAME);

        return $filePath && $fileName ? Yii::getAlias('@webroot') . $fileName : null;
    }

    /**
     * Returns file url for the attribute.
     *
     * @param string $attribute
     *
     * @return string|null
     */
    public function getUploadUrl($attribute)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;
        $fileName = $model->getOldAttribute($attribute);
        $filePath = pathinfo($fileName, PATHINFO_DIRNAME);

        return $filePath && $fileName ? $fileName : null;
    }

    /**
     * Returns full path for the filename.
     *
     * @param string $fileName
     *
     * @return string|null
     */
    public function getFullPath($fileName)
    {
        $url = $this->resolvePath($this->url);

        return $fileName ? Yii::getAlias($url . '/' . $fileName) : null;
    }

    /**
     * Replaces characters in strings that are illegal/unsafe for filename.
     *
     * #my*  unsaf<e>&file:name?".png
     *
     * @param string $filename the source filename to be "sanitized"
     *
     * @return bool string the sanitized filename
     */
    public static function sanitize($filename)
    {
        return Inflector::slug($filename, '-', false);
    }

    /**
     * Returns the UploadedFile instance.
     *
     * @return UploadedFile
     */
    protected function getUploadedFile()
    {
        return $this->file;
    }

    /**
     * Replaces all placeholders in path variable with corresponding values.
     */
    protected function resolvePath($path)
    {
        /** @var BaseActiveRecord $model */
        $model = $this->owner;

        return preg_replace_callback('/{([^}]+)}/', function ($matches) use ($model) {
            $name = $matches[1];
            $attribute = ArrayHelper::getValue($model, $name);
            if (is_string($attribute) || is_numeric($attribute)) {
                return $attribute;
            } else {
                return $matches[0];
            }
        }, $path);
    }

    /**
     * Saves the uploaded file.
     *
     * @param UploadedFile $file the uploaded file instance
     * @param string       $path the file path used to save the uploaded file
     *
     * @return bool true whether the file is saved successfully
     */
    protected function save($file, $path)
    {
        return $file->saveAs($path, $this->deleteTempFile);
    }

    /**
     * Deletes old file.
     *
     * @param string $attribute
     * @param bool   $old
     */
    protected function delete($attribute, $old = false)
    {
        $path = $this->getUploadPath($attribute, $old);
        if (is_file($path)) {
            unlink($path);
        }
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function getFileName($file)
    {
        if ($this->generateNewName) {
            return $this->generateNewName instanceof Closure
                ? call_user_func($this->generateNewName, $file)
                : $this->generateFileName($file);
        } else {
            return $this->sanitize($file->name);
        }
    }

    /**
     * Generates random filename.
     *
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function generateFileName($file)
    {
        return uniqid() . '.' . $file->extension;
    }

    /**
     * This method is invoked after uploading a file.
     * The default implementation raises the [[EVENT_AFTER_UPLOAD]] event.
     * You may override this method to do postprocessing after the file is uploaded.
     * Make sure you call the parent implementation so that the event is raised properly.
     */
    protected function afterUpload()
    {
        $this->owner->trigger(self::EVENT_AFTER_UPLOAD);
    }
}
