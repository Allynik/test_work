<?php

namespace app\modules\pages;

use app\modules\pages\models\Page;
use Yii;

/**
 * Page helper view class.
 */
class Helper
{
    public static function getMenu()
    {
        $allModels = Page::find()
           ->with([
               'children' => function ($query) {
                   $query->andWhere(['hidden' => false]);
                   $query->andWhere(['disabled' => false]);
                   $query->orderBy(['priority' => SORT_DESC, 'id' => SORT_ASC]);

                   return $query;
               },
           ])
           ->andWhere('parent_id IS NULL')
           ->andWhere(['hidden' => false])
           ->andWhere(['disabled' => false])
           ->orderBy(['priority' => SORT_DESC, 'id' => SORT_ASC])
           ->all();

        return $allModels;
    }

    public static function getSubmenu()
    {
        $request = Yii::$app->request->getPathInfo();
        $model = Page::findByRequest($request)
            ->andWhere(['disabled' => false])
            ->one();
        if (null === $model) {
            return [];
        }
        $parents = $model->getAllParents();
        $parent = $parents ? end($parents) : $model;
        $allModels = Page::find()
           ->andWhere(['parent_id' => $parent->id])
           ->andWhere(['hidden' => false])
           ->andWhere(['disabled' => false])
           ->orderBy(['priority' => SORT_DESC, 'id' => SORT_ASC])
           ->all();

        return $allModels;
    }
}
