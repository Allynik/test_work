<?php

/**
 * Setting config.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
$timezoneList = array_merge(
    timezone_identifiers_list(),
    array_map(fn ($i) => 'Etc/GMT-' . $i, range(11, 0, 1)),
    array_map(fn ($i) => 'Etc/GMT+' . $i, range(0, 11, 1)),
);

$timezoneHints = [
    'Сейчас по настройкам: ' . date('r') . ';',
    'Сейчас по GMT: ' . gmdate('r') . ';',
];

return [
    'title' => [
        'label' => 'Название сайта',
        'widget' => 'input',
        'type' => 'string',
        'attribute' => [],
        'defaultValue' => '',
        'group' => 'Основные',
    ],
    'email' => [
        'label' => 'Электронная почта администратора',
        'widget' => 'input',
        'type' => 'email',
        'attribute' => ['type' => 'email'],
        'defaultValue' => '',
        'group' => 'Основные',
    ],
    'meta_description' => [
        'label' => 'Meta description',
        'widget' => 'textarea',
        'type' => 'string',
        'attribute' => [],
        'defaultValue' => '',
        'group' => 'Основные',
    ],
    'timezone' => [
        'label' => 'Timezone',
        'hint' => implode('<br>', $timezoneHints),
        'widget' => 'dropDownList',
        'type' => 'string',
        'attribute' => ['value' => ENV('TIMEZONE', 'UTC')],
        'options' => array_combine($timezoneList, $timezoneList),
        'defaultValue' => ENV('TIMEZONE', 'UTC'),
        'group' => 'Основные',
        'callback' => fn ($value) => app\helpers\EnvHelper::writeEnvVars(['TIMEZONE' => $value]),
    ],
    'disable' => [
        'label' => 'Выключить сайт',
        'widget' => 'checkbox',
        'type' => 'integer',
        'attribute' => [],
        'defaultValue' => '',
        'group' => 'Режим обслуживания',
    ],
];
