<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Blog;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use Yii;
class BlogController extends AbstractCRUDController
{

    /**
     * @var ActiveRecord
     *
     */

//    4 часа искал...
    protected $modelClass = Blog::class;


    public function actionIndex()
    {

        $query = $this->modelClass::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => $this->getDefaultOrder()],
            'pagination' => [
                'pageSize' => $this->getPageSize(),
                'defaultPageSize' => $this->getDefaultPageSize(),
            ],
        ]);

        return $this->render('index',[
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        return parent::actionView($id);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->request->isPost)
        {
            $data = Yii::$app->request->post();
            $old_name = $model->image;
            if($model->load($data) && $model->validate()){
                $model->upload = UploadedFile::getInstance($model,'image');
                if(!empty($model->upload)){
                    $model->image = $model->uploadImage();
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                $model->image = $old_name;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            $this->messageError('Возможна ошибка валидации');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
//    public function actionCreate()
//    {
//        return parent::actionCreate();
//    }

    public function actionCreate()
    {
        $model = new Blog();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->upload = UploadedFile::getInstance($model,'image');
            if($name = $model->uploadImage()){
                $model->image = $name;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return  $this->render('create',[
            'model' =>$model
        ]);
    }
}
