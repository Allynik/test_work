<?php

/**
 * Editor config.
 */
$config['toolbar'] = 'full';

$config['schemes'] = [];

$config['schemes']['full']['height'] = 250;
$config['schemes']['full']['options'] = [
    ['Source', '-', 'Print', 'NewPage', 'Preview', 'Templates'],
    ['Cut', 'Copy', 'Paste'/* 'PasteText', 'PasteFromWord' , '-', 'SpellChecker', 'Scayt' */],
    ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
    ['Image', 'Embed', 'Iframe', /* 'Flash', */ 'Table', 'HorizontalRule', /* ,'Smiley' */ 'SpecialChar', 'EmojiPanel'/* ,'PageBreak' */],
    /* array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'), */
    '/',
    ['Typograf', 'Styles', 'Format'/* ,'Font','FontSize' */],
    ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
    ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv'],
    ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
    ['Link', 'Unlink', 'Anchor'],
    /* array('TextColor','BGColor'), */
    ['Maximize', 'ShowBlocks', '-', 'About'],
];

$config['schemes']['basic']['height'] = 250;
$config['schemes']['basic']['options'] = [
    ['Bold', 'Italic', 'Underline', 'Strike'],
    ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
    ['Embed', 'SpecialChar', 'EmojiPanel'],
    ['Link', 'Unlink'],
    ['About'],
];

$config['schemes']['medium']['height'] = 250;
$config['schemes']['medium']['options'] = [
    ['Source'/* , '-', 'Print', 'NewPage', 'Preview', 'Templates' */],
    ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'/* , '-', 'SpellChecker', 'Scayt' */],
    ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
    ['Image', 'Embed', /* 'Iframe', 'Flash', 'Table' */ 'HorizontalRule', /* ,'Smiley' */ 'SpecialChar', 'EmojiPanel'/* ,'PageBreak' */],
    /* array('Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'), */
    '/',
    ['Typograf', 'Styles', 'Format'/* ,'Font','FontSize' */],
    ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'],
    ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'/* , 'CreateDiv' */],
    ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
    ['Link', 'Unlink', 'Anchor'],
    /* array('TextColor','BGColor'), */
    ['Maximize', 'ShowBlocks', '-', 'About'],
];

return $config;
