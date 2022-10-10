<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Application;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class ApplicationController extends AbstractCRUDController
{
    /**
     * @var ActiveRecord
     *
     */

    protected $modelClass = Application::class;


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

}
