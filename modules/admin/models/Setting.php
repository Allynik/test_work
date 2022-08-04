<?php

namespace app\modules\admin\models;

use Yii;

/**
 * Site setting.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 *
 * @property int         $id
 * @property string|null $name    Name
 * @property string|null $module  Module ("common" for site's global setting)
 * @property string|null $value   Value
 * @property string|null $created
 * @property string|null $updated
 */
class Setting extends \app\models\BaseActiveRecord
{
    protected $type = 'string';

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], $this->type],
            [['created', 'updated'], 'safe'],
            [['name', 'module'], 'string', 'max' => 255],
        ];
    }

    /**
     * Get all settings.
     *
     * @param string $module
     *
     * @return array|null
     */
    public static function all($module = 'common')
    {
        static $settings;

        if (null === $settings) {
            $settings = [];
        }

        if (!array_key_exists($module, $settings)) {
            $settingsData = Setting::findAll(['module' => $module]);
            if ('common' == $module) {
                $configSetting = require Yii::getAlias('@app') . '/config/setting.php';
                $settings['common'] = [];
                foreach ($configSetting as $key => $config) {
                    $settings['common'][$key] = '';
                }
            }
            foreach ($settingsData as $settingsDataItem) {
                $settings[$settingsDataItem->module][$settingsDataItem->name] = $settingsDataItem->value;
            }
        }

        return $settings;
    }

    /**
     * Return common setting by name.
     *
     * @param string     $name setting name
     * @param mixed|null $alt  alternative value
     *
     * @return mixed
     */
    public static function getCommonSetting($name, $alt = null)
    {
        $all = self::all();

        return array_key_exists($name, $all['common']) ? $all['common'][$name] : $alt;
    }

    /**
     * Return module setting by module and name.
     *
     * @param string     $module module name
     * @param string     $name   setting name
     * @param mixed|null $alt    alternative value
     *
     * @return mixed
     */
    public static function getModuleSetting($module, $name, $alt = null)
    {
        $all = self::all($module);

        return array_key_exists($name, $all[$module]) ? $all[$module][$name] : $alt;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'module' => 'Модуль',
            'value' => 'Значение',
            'created' => 'Создано',
            'updated' => 'Обновлено',
        ];
    }
}
