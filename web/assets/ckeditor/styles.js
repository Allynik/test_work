/**
 * Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// This file contains style definitions that can be used by CKEditor plugins.
//
// The most common use for it is the "stylescombo" plugin, which shows a combo
// in the editor toolbar, containing all styles. Other plugins instead, like
// the div plugin, use a subset of the styles on their feature.
//
// If you don't have plugins that depend on this file, you can simply ignore it.
// Otherwise it is strongly recommended to customize this file to match your
// website requirements and design properly.

CKEDITOR.stylesSet.add("default", [
    /* Bootstrap Styles */
    {
        name: "Заглавный (p.lead)",
        element: "p",
        attributes: {
            "class": "lead"
        }
    }, {
        name: "Выделенный (.mark)",
        element: "span",
        attributes: {
            "class": "mark"
        }
    }, {
        name: "Приглушенный (.text-muted)",
        element: "span",
        attributes: {
            "class": "text-muted"
        }
    }, {
        name: "Большой (big)",
        element: "big"
    }, {
        name: "Малый (small)",
        element: "small"
    }, {
        name: "Программный код (code)",
        element: "code"
    }, {
        name: "Клавиша (kbd)",
        element: "kbd"
    }, {
        name: "Пример (samp)",
        element: "samp"
    }, {
        name: "Переменная (var)",
        element: "var"
    }, {
        name: "Удаленный (del)",
        element: "del"
    }, {
        name: "Добавленный (ins)",
        element: "ins"
    }, {
        name: "Цитата (blockquote)",
        element: "blockquote"
    }, {
        name: "Цитата (cite)",
        element: "cite"
    }, {
        name: "Кавычки (q)",
        element: "q"
    }, {
        name: "Список: без стиля (ul.list-unstyled)",
        element: "ul",
        attributes: {
            "class": "list-unstyled"
        }
    }, {
        name: "Список: без стиля (unstyled.list-unstyled)",
        element: "ol",
        attributes: {
            "class": "list-unstyled"
        }
    }, {
        name: "Таблица: простая (table.table)",
        element: "table",
        attributes: {
            "class": "table"
        }
    }, {
        name: "Таблица: зебра (table.table-striped)",
        element: "table",
        attributes: {
            "class": "table table-striped"
        }
    }, {
        name: "Таблица: с границами (table.table-bordered)",
        element: "table",
        attributes: {
            "class": "table table-bordered"
        }
    }, {
        name: "Таблица: подсвеченная (table.table-hover)",
        element: "table",
        attributes: {
            "class": "table table-hover"
        }
    }, {
        name: "Таблица: сокращенная (table.table-condensed)",
        element: "table",
        attributes: {
            "class": "table table-condensed"
        }
    }, {
        name: "Изображение: закругленное (img.img-rounded)",
        element: "img",
        attributes: {
            "class": "img-rounded"
        }
    }, {
        name: "Изображение: круглое (img.img-circle)",
        element: "img",
        attributes: {
            "class": "img-circle"
        }
    }, {
        name: "Изображение: карточка (img.img-thumbnail)",
        element: "img",
        attributes: {
            "class": "img-thumbnail"
        }
    }, {
        name: "Изображение: влево (img.pull-left)",
        element: "img",
        attributes: {
            "class": "pull-left"
        }
    }, {
        name: "Изображение: вправо (img.pull-right)",
        element: "img",
        attributes: {
            "class": "pull-right"
        }
    }
]);