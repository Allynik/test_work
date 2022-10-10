<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Blog[] $blogs
 */
class BlogCategory extends \app\models\BaseActiveRecord
{
    public $updated;
    public $created;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Blogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['category_id' => 'id']);
    }
}
