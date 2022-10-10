<?php

namespace app\modules\admin\models;

use app\behaviors\UploadBehavior;
use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string|null $title Blog title
 * @property int|null $category_id id category
 * @property string|null $content Blog content
 * @property string|null $image Path to img
 * @property string|null $created
 * @property bool|null $flag
 *
 * @property BlogCategory $category
 */
class Blog extends \app\models\BaseActiveRecord
{
    public $upload;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['content'], 'string'],
            [['created'], 'safe'],
            [['flag'], 'boolean'],
            [['title', 'image'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
           ];
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название Блога',
            'category_id' => 'Номер категории',
            'content' => 'Содержание',
            'image' => 'Картинка',
            'created' => 'Создано',
            'flag' => 'Flag',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'category_id']);
    }

    public function uploadImage()
    {
        if($this->upload){
            $name = md5(uniqid(rand(), true)) . '.' . $this->upload->extension;
            $source = Yii::getAlias('@webroot/assets/front/image/' . $name);
            if($this->upload->saveAs($source)){
                return $name;
            }
        }
        return false;
    }
    public static function removeImage($name) {
        if (!empty($name)) {
            $source = Yii::getAlias('@webroot/assets/front/image/source/' . $name);
            if (is_file($source)) {
                unlink($source);
            }
        }
    }

}
