<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\{TextBlock, TextBlockSearch};
use Yii;
use yii\data\ActiveDataProvider;

/**
 * Text block controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class BlocksController extends AbstractCRUDController
{
    protected $modelClass = TextBlock::class;

    public function actionIndex()
    {
        $query = $this->modelClass::find();

        $searchModel = new TextBlockSearch();
        $searchParams = Yii::$app->request->get();
        if ($searchModel->load($searchParams) && $searchModel->validate()) {
            if ($searchModel->name) {
                $query->andFilterWhere(['like', 'name', $searchModel->name]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => $this->getDefaultOrder()],
            'pagination' => [
                'pageSize' => $this->getPageSize(),
                'defaultPageSize' => $this->getDefaultPageSize(),
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
}
