<?php

namespace app\modules\pages\models;

use app\models\BaseActiveRecord;
use Yii;

/**
 * Page model.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @property int    $id
 * @property int    $parent_id
 * @property string $name
 * @property string $path
 * @property int    $priority
 * @property bool   $hidden
 * @property bool   $disabled
 * @property string $redirect
 * @property string $content
 * @property string $meta_title
 * @property string $meta_description
 * @property string|null seo
 * @property string|null $created
 * @property string|null $updated
 */
class Page extends BaseActiveRecord
{
    public $nestedName = null;

    public $levelNumber = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'safe', 'on' => ['create', 'update']],
            [['name', 'path', 'disabled'], 'required'],
            [['parent_id'], 'integer'],
            [['hidden', 'disabled'], 'boolean'],
            [['content', 'meta_description', 'seo'], 'string'],
            [['name', 'path', 'meta_title', 'redirect'], 'string', 'max' => 255],
            [['path'], 'unique'],
            [['priority'], 'integer'],
            [['priority'], 'default', 'value' => 0],
            [['path'], 'filter', 'filter' => [$this, 'normalizePath']],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * Normalize path.
     *
     * @param $path
     *
     * @return array|string
     */
    public function normalizePath($path)
    {
        $path = trim($path, '/');
        $path = explode('/', $path);
        $path = array_map(['yii\helpers\Inflector', 'slug'], $path);
        $path = implode('/', $path);

        return $path;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родитель',
            'name' => 'Название',
            'path' => 'Путь',
            'priority' => 'Вес',
            'hidden' => 'Скрыт',
            'disabled' => 'Выключен',
            'content' => 'Содержание',
            'redirect' => 'Редирект',
            'meta_title' => 'Meta-Title',
            'meta_description' => 'Meta-Description',
            'seo' => 'SEO-описание страницы',
            'created' => 'Создан',
            'updated' => 'Обновлен',
        ];
    }

    /**
     * Get page parent.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(static::class, ['id' => 'parent_id']);
    }

    /**
     * Get page children.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(static::class, ['parent_id' => 'id']);
    }

    /**
     * Find page by path.
     *
     * @param $path
     *
     * @return \yii\db\ActiveQuery
     */
    public static function findByPath($path)
    {
        return static::find()->andWhere(['path' => $path]);
    }

    /**
     * Find page by request.
     *
     * @param $request
     *
     * @return \yii\db\ActiveQuery
     */
    public static function findByRequest($request = null)
    {
        if (!$request) {
            $request = Yii::$app->request->pathInfo;
        }
        $condition = [];
        $path = explode('/', trim($request, '/'));
        for ($i = 0, $n = count($path); $i < $n; ++$i) {
            $condition[] = implode('/', array_slice($path, 0, $n - $i));
        }
        $query = static::find();
        $query->andWhere(['in', 'path', $condition]);
        $query->orderBy(['path' => SORT_DESC]);
        $query->limit(1);

        return $query;
    }

    /**
     * Get page fullpath.
     *
     * @return string
     */
    public function getFullPath()
    {
        return '/' . $this->path;
    }

    /**
     * Get all page parents.
     *
     * @return array
     */
    public function getAllParents()
    {
        $parents = [];
        if ($this->parent_id) {
            $parent = $this->parent ?: $this->getParent()->one();
            if ($parent) {
                $parents = array_merge([$parent], $parent->getAllParents());
            }
        }

        return $parents;
    }

    /**
     * Sort tree models by parents.
     *
     * @param $allModels
     * @param $parent_id
     * @param int $level
     *
     * @return array
     */
    public static function sortTreeModels(&$allModels, $parent_id, $level = 0)
    {
        $result = [];
        foreach ($allModels as $i) {
            if ($i->parent_id == $parent_id) {
                $i->levelNumber = $level;
                $i->nestedName = str_repeat(' — ', $level) . $i->name;
                $result[] = $i;
                $result = array_merge($result, static::sortTreeModels($allModels, $i->id, $level + 1));
            }
        }

        return $result;
    }
}
