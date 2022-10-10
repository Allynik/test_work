<?php

namespace app\controllers;

use app\modules\admin\models\Blog;
use app\modules\admin\models\BlogCategory;
use Yii;
use app\modules\admin\models\Application;

class SiteController extends AbstractFrontController
{
    public $layout = '@views/layouts/main';

    public function actionIndex()
    {
        $model= new Application();
       if($model->load(Yii::$app->request->post()) && $model->validate()){
           if($model->save()){
               return $this->refresh();
           }
       }
       $blog = Blog::find()->orderBy(['created'=>SORT_DESC])->limit(3)->asArray()->all();
        return $this->render('@views/site/index',compact('model','blog'));
    }

    public function actionMaintenance()
    {
        Yii::$app->response->statusCode = 503;

        return $this->render('@views/site/maintenance');
    }

    public function actionBlog($cat_id = null, $det_v = null, $blog = null)
    {
        $this->view->title = 'Блог';
        if($cat_id == null){
            $blog_category = BlogCategory::find()->asArray()->all();
            $blog = Blog::find()->asArray()->all();
        }else{
            $blog_category = BlogCategory::find()->where(['id'=>$cat_id])->asArray()->all();
            $blog = Blog::find()->where(['category_id' => $cat_id])->asArray()->all();
            $det_v = true;
        }

        return $this->render('@views/site/blog',[
            'blog_cat' => $blog_category,
            'det_v' => $det_v,
            'blog' => $blog,
        ]);
    }
}
