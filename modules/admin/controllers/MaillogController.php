<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Maillog;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Maillog controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class MaillogController extends DefaultController
{
    /**
     * Order default.
     *
     * @var array
     */
    protected $defaultOrder = ['id' => SORT_DESC];

    /**
     * Возврат сортировки по-умолчанию.
     *
     * @return mixed
     */
    public function getDefaultOrder()
    {
        return $this->defaultOrder;
    }

    /**
     * List logs.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Maillog::find(),
            'sort' => ['defaultOrder' => $this->getDefaultOrder()],
            'pagination' => [
                'pageSize' => 50,
                'defaultPageSize' => 50,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * View model object.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (($model = Maillog::findOne($id)) !== null) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }

    /**
     * Download mail.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDownload($id)
    {
        if (($model = Maillog::findOne($id)) !== null) {
            Yii::$app->response->sendContentAsFile($model->message, 'maillog-' . $model->id . '.eml', [
                'mimeType' => 'message/rfc822',
            ]);

            return;
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }
}
