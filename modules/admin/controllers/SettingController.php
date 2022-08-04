<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Setting;
use Yii;

/**
 * Site setting edit.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
class SettingController extends DefaultController
{
    /**
     * Edit setting.
     *
     * @return string
     */
    public function actionIndex()
    {
        $configSetting = require Yii::getAlias('@app') . '/config/setting.php';

        $models = [];
        $request = Yii::$app->request;
        $data = Setting::find()->where(['module' => 'common'])->all();

        foreach ($data as $settingItem) {
            $models[$settingItem->name] = $settingItem;
        }

        foreach ($configSetting as $fieldName => $field) {
            if (!isset($models[$fieldName])) {
                $settingModel = new Setting([
                    'type' => $field['type'],
                ]);
                $settingModel->module = 'common';
                $settingModel->name = $fieldName;
                $settingModel->value = $field['defaultValue'] ?? null;
                $models[$fieldName] = $settingModel;
            } else {
                $models[$fieldName]->setType($field['type']);
            }
        }

        if ($request->isPost) {
            $data = $request->post('setting');
            foreach ($models as $fieldName => $settingModel) {
                $settingModel->load([
                    'Setting' => [
                        'value' => $data[$fieldName] ?? null,
                    ],
                ]);
                if ($settingModel->validate()) {
                    if (isset($configSetting[$fieldName]) && isset($configSetting[$fieldName]['callback'])) {
                        if (is_callable($configSetting[$fieldName]['callback'])) {
                            $callback = $configSetting[$fieldName]['callback'];
                            $callback($data[$fieldName] ?? null);
                        }
                    }
                    $settingModel->save(false);
                }
            }

            $this->messageSuccess('Настройки сохранены');

            return $this->redirect('setting');
        }

        return $this->render('index', [
            'config' => $configSetting,
            'models' => $models,
        ]);
    }
}
