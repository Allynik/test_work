<?php

/**
 * Admin menu config.
 *
 * @copyright 2004-2021 Pitcher Agency (https://pitcher.agency)
 * @author    Alexander Solovev <flisk69@gmail.com>
 *
 * @version   $Id$
 */
return [
    'menu' => [
        [
            'group' => 'Настройки сайта',
            'url' => '#',
            'icon' => 'fa-lg fa-fw fa fa-sliders-h',
            'links' => [
                '/admin/setting' => 'Основные настройки',
                '/admin/blocks' => 'Текстовые блоки',
                '/admin/userlog' => 'Лог изменений',
                '/admin/email' => 'Настройки почты',
                '/admin/maillog' => 'Лог почты',
            ],
            'accessAdmin' => true,
        ],
        [
            'group' => 'Пользователи',
            'url' => '/admin/user',
            'icon' => 'fa-lg fa-fw fa fa-users',
            'links' => [
                '/admin/user' => 'Пользователи',
            ],
            'accessAdmin' => true,
        ],
        [
            'group' => 'Страницы',
            'url' => '/admin/pages',
            'icon' => 'fa-lg fa-fw fa fa-list',
            'links' => [
                '/admin/pages' => 'Страницы',
            ],
            'accessAdmin' => true,
        ],
        [
            'group' => 'Модули',
            'url' => '#',
            'icon' => 'fa-lg fa-fw fa fa-database',
            'links' => [
            ],
            'accessAdmin' => true,
        ],
    ],
];
