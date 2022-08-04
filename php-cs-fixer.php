#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

$finder = PhpCsFixer\Finder::create()
    ->name('*.php')
    ->name('*.phtml')
    ->in(__DIR__ . '/assets')
    ->in(__DIR__ . '/behaviors')
    ->in(__DIR__ . '/commands')
    ->in(__DIR__ . '/config')
    ->in(__DIR__ . '/components')
    ->in(__DIR__ . '/controllers')
    ->in(__DIR__ . '/helpers')
    ->in(__DIR__ . '/lib')
    ->in(__DIR__ . '/mail')
    ->in(__DIR__ . '/migrations')
    ->in(__DIR__ . '/models')
    ->in(__DIR__ . '/modules')
    ->in(__DIR__ . '/views')
    ->in(__DIR__ . '/widgets')
;

$phpDirsDir = array_map(function ($i) {
    return new SplFileInfo($i);
}, glob(__DIR__ . '/*.php'));
$finder->append(new ArrayObject($phpDirsDir));

return (new PhpCsFixer\Config())
    ->setFinder($finder)
    ->setUsingCache(true)
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PSR12:risky' => true,
        '@PHP74Migration' => true,
        'single_quote' => true,
        'no_alternative_syntax' => false,
        'array_indentation' => true,
        'group_import' => true,
        'single_import_per_statement' => false,
        'concat_space' => ['spacing' => 'one'],
        'echo_tag_syntax' => ['format' => 'short', 'shorten_simple_statements_only' => false],
        'array_syntax' => ['syntax' => 'short'],
        'ordered_class_elements' => true,
        'no_blank_lines_after_class_opening' => true,
        'blank_line_before_statement' => true,
        'method_argument_space' => ['keep_multiple_spaces_after_comma' => true, 'on_multiline' => 'ignore'],
        'single_blank_line_at_eof' => false,
        'modernize_types_casting' => true,
        'comment_to_phpdoc' => true,
        'no_alias_functions' => true,
        'array_push' => true,
        'no_unreachable_default_argument_value' => true,
        'set_type_to_cast' => true,
        'dir_constant' => true,
        'fopen_flag_order' => true,
        'fopen_flags' => true,
        'function_to_constant' => true,
        'implode_call' => true,
        'is_null' => true,
        'logical_operators' => true,
        'ternary_to_elvis_operator' => true,
        'string_line_ending' => true,
        'no_homoglyph_names' => true,
        'no_useless_sprintf' => true,
    ])
;
