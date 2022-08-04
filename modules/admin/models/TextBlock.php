<?php

namespace app\modules\admin\models;

use app\behaviors\{UploadBehavior, UploadImageBehavior};
use yii\base\InvalidConfigException;

/**
 * Text block model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @property int    $id
 * @property string $name
 * @property string $widget
 * @property string $config
 * @property string $content
 * @property string $created
 * @property string $updated
 */
class TextBlock extends \app\models\BaseActiveRecord
{
    public function __toString()
    {
        return (string) $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text_block';
    }

    public function afterFind()
    {
        parent::afterFind();

        switch ($this->widget) {
            case 'file':
                $this->attachBehavior('content', [
                    'class' => UploadBehavior::class,
                    'attribute' => 'content',
                    'scenarios' => ['create', 'update'],
                    'path' => '@webroot/uploads/blocks/{id}',
                    'url' => '@web/uploads/blocks/{id}',
                ]);

                break;

            case 'image':
                $this->attachBehavior('content', [
                    'class' => UploadImageBehavior::class,
                    'attribute' => 'content',
                    'scenarios' => ['create', 'update'],
                    'path' => '@webroot/uploads/blocks/{id}',
                    'url' => '@web/uploads/blocks/{id}',
                    'createThumbsOnRequest' => true,
                    'thumbs' => [
                        'thumb-admin-view' => ['width' => 300, 'height' => null],
                    ],
                ]);

                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        switch ($this->widget) {
            case 'file':
                $rules = [
                    ['content', 'file', 'skipOnEmpty' => true, 'on' => ['update']],
                ];

                break;

            case 'image':
                $rules = [
                    ['content', 'image', 'skipOnEmpty' => true, 'extensions' => 'png,jpeg,jpg', 'on' => ['update']],
                ];

                break;

            case 'checkbox':
                $rules = [
                    ['content', 'integer', 'on' => ['update']],
                ];

                break;

            case 'url':
                $rules = [
                    ['content', 'url', 'enableIDN' => true, 'on' => ['update']],
                ];

                break;

            case 'email':
                $rules = [
                    ['content', 'email', 'enableIDN' => true, 'on' => ['update']],
                ];

                break;

            case 'input':
            case 'textarea':
            case 'editor':
            default:
                $rules = [
                    ['content', 'string', 'on' => ['update']],
                ];

                break;
        }

        $rules = array_merge($rules, [
            ['id', 'safe', 'on' => ['create', 'update']],

            [['config'], 'string'],
            [['created', 'updated'], 'safe'],
            [['name', 'widget'], 'string', 'max' => 255],
            ['name', 'required'],
        ]);

        return $rules;
    }

    /**
     * Check widget type.
     *
     * @param $widget
     *
     * @return bool
     */
    public static function checkWidgetType($widget)
    {
        return in_array($widget, [
            'input', 'textarea', 'editor', 'email', 'url', 'checkbox', 'image', 'file',
        ]);
    }

    /**
     * Get (and create if not exists) text block.
     *
     * @param string $name      text block name
     * @param string $widget    widget name
     * @param bool   $isCaching get data from cache
     *
     * @return TextBlock
     *
     * @throws InvalidConfigException
     */
    public static function getTextBlock(string $name, string $widget, $isCaching = true)
    {
        /* @var $textBlock TextBlock */

        if (!static::checkWidgetType($widget)) {
            throw new InvalidConfigException('Incorrect widget type ' . $widget . ' for ' . $name);
        }

        static $cache;
        if (null === $cache) {
            $cache = [];
        }
        if ($isCaching && array_key_exists($name, $cache)) {
            $textBlock = $cache[$name];
        } else {
            $textBlock = self::findOne(['name' => $name]);
        }

        if (null === $textBlock) {
            $textBlock = new TextBlock();
            $textBlock->name = $name;
            $textBlock->widget = $widget;
            $textBlock->save();
        } elseif ($textBlock->widget != $widget) {
            $textBlock->widget = $widget;
            $textBlock->save();
        }
        if ($isCaching) {
            $cache[$name] = $textBlock;
        }

        return $cache[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'widget' => 'Виджет',
            'config' => 'Конфигурация',
            'content' => 'Содержимое',
            'created' => 'Создано',
            'updated' => 'Обновлено',
        ];
    }
}
