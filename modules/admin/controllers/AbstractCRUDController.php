<?php

namespace app\modules\admin\controllers;

use app\models\{BaseActiveRecord, User};
use app\modules\admin\models\Userlog;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\{ActiveQuery, ActiveRecord};
use yii\filters\VerbFilter;
use yii\validators\{BooleanValidator, StringValidator, Validator};
use yii\web\{NotFoundHttpException, ServerErrorHttpException};

/**
 * Abstract CRUD Controller.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class AbstractCRUDController extends DefaultController
{
    /**
     * Page size.
     *
     * @var int
     */
    protected $pageSize = 20;

    /**
     * Model class.
     *
     * @var ActiveRecord
     */
    protected $modelClass = null;

    /**
     * Model search class.
     *
     * @var ActiveRecord
     */
    protected $modelSearchClass = null;

    /**
     * Order default.
     *
     * @var array
     */
    protected $defaultOrder = ['id' => SORT_DESC];

    /**
     * Scenario create.
     *
     * @var string
     */
    protected $scenarioCreate = 'create';

    /**
     * Scenario update.
     *
     * @var string
     */
    protected $scenarioUpdate = 'update';

    /**
     * Construct.
     *
     * @param string           $id
     * @param \yii\base\Module $module
     *
     * @throws ServerErrorHttpException
     */
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        if (null === $this->modelClass) {
            throw new ServerErrorHttpException('Класс модели не определен');
        }
    }

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
     * Get default page size.
     *
     * @return int
     */
    public function getDefaultPageSize()
    {
        return $this->pageSize;
    }

    /**
     * Get page size.
     *
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * List models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = $this->indexQuery();

        $searchModel = null;
        if ($this->modelSearchClass) {
            $searchModel = new $this->modelSearchClass();
            $searchParams = Yii::$app->request->get();
            if ($searchModel->load($searchParams) && $searchModel->validate()) {
                $query = $this->indexSearch($query, $searchModel);
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
            'controller' => $this,
            'modelClass' => $this->modelClass,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
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
        $model = $this->findModel($id);

        if (!$this->canView($model)) {
            $this->messageError('Доступ запрещен');

            return $this->redirect(['index']);
        }

        return $this->render('view', [
            'controller' => $this,
            'modelClass' => $this->modelClass,
            'model' => $model,
        ]);
    }

    /**
     * Before model save in actionCreate.
     */
    public function beforeCreate(BaseActiveRecord $model)
    {
    }

    /**
     * After model save in actionCreate.
     */
    public function afterCreate(BaseActiveRecord $model)
    {
        $this->saveLog($model, 'create');
    }

    /**
     * Before model save in actionUpdate.
     */
    public function beforeUpdate(BaseActiveRecord $model)
    {
    }

    /**
     * After model save in actionUpdate.
     */
    public function afterUpdate(BaseActiveRecord $model)
    {
        $this->saveLog($model, 'update');
    }

    /**
     * Before model save in actionDelete.
     */
    public function beforeDelete(BaseActiveRecord $model)
    {
    }

    /**
     * After model save in actionDelete.
     */
    public function afterDelete(BaseActiveRecord $model)
    {
        $this->saveLog($model, 'delete');
    }

    /**
     * Before model validate in actionCreate/actionUpdate.
     *
     * @return bool
     */
    public function beforeValidate(BaseActiveRecord $model)
    {
        return false;
    }

    /**
     * After model validate in actionCreate/actionUpdate.
     *
     * @return bool
     */
    public function afterValidate(BaseActiveRecord $model)
    {
        return false;
    }

    /**
     * Save model action log.
     *
     * @param $action
     * @param string $comment
     */
    public function saveLog(BaseActiveRecord $model, $action, $comment = '')
    {
        /**
         * @var $user User
         */
        $user = Yii::$app->user->getIdentity();
        $logEntity = new Userlog();
        $logEntity->user_id = $user->getId();
        $logEntity->username = $user->username;
        $logEntity->model = get_class($model);
        $logEntity->table = preg_replace("~[\%{}]~", '', $model::tableName());
        $logEntity->entity_id = $model->id;
        $logEntity->action = $action;
        $logEntity->comment = $comment;
        $logEntity->save(false);
    }

    /**
     * Create new model object.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        /**
         * @var $model BaseActiveRecord
         */
        $model = new $this->modelClass();
        $model->loadDefaultValues();

        if ($this->scenarioCreate) {
            $scenarios = $model->scenarios();
            if (isset($scenarios[$this->scenarioCreate])) {
                $model->setScenario($this->scenarioCreate);
            }
        }

        if (!$this->canCreate($model)) {
            $this->messageError('Доступ запрещен');

            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $model->load($data);
            if (!$this->beforeValidate($model) && $model->validate() && !$this->afterValidate($model)) {
                $this->beforeCreate($model);
                if ($model->save(false)) {
                    $this->afterCreate($model);
                    $this->messageSuccess('Запись добавлена');

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $this->messageError('Ошибка добавления записи');
                }
            }
        }

        return $this->render('create', [
            'controller' => $this,
            'modelClass' => $this->modelClass,
            'model' => $model,
        ]);
    }

    /**
     * Edit model object.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        /**
         * @var $model BaseActiveRecord
         */
        $model = $this->findModel($id);

        if ($this->scenarioUpdate) {
            $scenarios = $model->scenarios();
            if (isset($scenarios[$this->scenarioUpdate])) {
                $model->setScenario($this->scenarioUpdate);
            }
        }

        if (!$this->canUpdate($model)) {
            $this->messageError('Доступ запрещен');

            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $model->load($data);
            if (!$this->beforeValidate($model) && $model->validate() && !$this->afterValidate($model)) {
                $this->beforeUpdate($model);
                if ($model->save(false)) {
                    $this->afterUpdate($model);
                    $this->messageSuccess('Запись сохранена');

                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $this->messageError('Ошибка сохранения записи');
                }
            }
        }

        return $this->render('update', [
            'controller' => $this,
            'modelClass' => $this->modelClass,
            'model' => $model,
        ]);
    }

    /**
     * Delete model object.
     *
     * @param int $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException если модель не найдена
     */
    public function actionDelete($id)
    {
        /**
         * @var $model BaseActiveRecord
         */
        $model = $this->findModel($id);

        if (!$this->canDelete($model)) {
            $this->messageError('Доступ запрещен');

            return $this->redirect(['index']);
        }

        $this->beforeDelete($model);
        if ($model->delete()) {
            $this->afterDelete($model);
            $this->messageSuccess('Запись удалена');
        } else {
            $this->messageError('Ошибка удаления записи');
        }

        return $this->redirect(['index'])->send();
    }

    /**
     * Before model save in actionCreate.
     */
    protected function canCreate(BaseActiveRecord $model)
    {
        return true;
    }

    /**
     * Before model save in actionUpdate.
     */
    protected function canUpdate(BaseActiveRecord $model)
    {
        return true;
    }

    /**
     * Before model save in actionDelete.
     */
    protected function canDelete(BaseActiveRecord $model)
    {
        return true;
    }

    /**
     * Before model save in actionView.
     */
    protected function canView(BaseActiveRecord $model)
    {
        return true;
    }

    /**
     * Search for index action.
     *
     * @param string $attribute
     *
     * @return ActiveQuery
     */
    protected function searchAttrbuteValidator($attribute, ActiveQuery $query, BaseActiveRecord $searchModel, Validator $validator)
    {
        $searchMethod = 'search' . ucfirst($attribute);
        if (method_exists($searchModel, $searchMethod)) {
            if ('' !== $searchModel->{$attribute}) {
                $query = $searchModel->$searchMethod($query, $validator);
            }
        } elseif ($validator instanceof StringValidator) {
            if ('' !== $searchModel->{$attribute}) {
                $column = $searchModel::tableName() . '.' . $attribute;
                $query->andFilterWhere(['like', $column, $searchModel->{$attribute}]);
            }
        } elseif ($validator instanceof BooleanValidator) {
            if ('' !== $searchModel->{$attribute}) {
                $column = $searchModel::tableName() . '.' . $attribute;
                $query->andFilterWhere(["$column" => $searchModel->{$attribute}]);
            }
        } else {
            if ('' !== $searchModel->{$attribute}) {
                $column = $searchModel::tableName() . '.' . $attribute;
                $query->andFilterWhere(["$column" => $searchModel->{$attribute}]);
            }
        }

        return $query;
    }

    /**
     * Filter for index action.
     *
     * @return ActiveQuery
     */
    protected function indexSearch(ActiveQuery $query, BaseActiveRecord $searchModel)
    {
        $activeAttributes = $searchModel->activeAttributes();
        foreach ($activeAttributes as $attribute) {
            $activeValidators = $searchModel->getActiveValidators($attribute);
            foreach ($activeValidators as $validator) {
                $query = $this->searchAttrbuteValidator($attribute, $query, $searchModel, $validator);
            }
        }

        return $query;
    }

    /**
     * Search by id
     * If model not found, throws 404 Exception.
     *
     * @param int $id
     *
     * @return ActiveRecord загруженная модель
     *
     * @throws NotFoundHttpException если модель не найдена
     */
    protected function findModel($id)
    {
        if (($model = $this->modelClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страница не найдена.');
    }

    /**
     * Query for index action.
     *
     * @return ActiveQuery
     */
    protected function indexQuery()
    {
        return $this->modelClass::find();
    }
}
