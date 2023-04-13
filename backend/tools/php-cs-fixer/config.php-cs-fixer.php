<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor')
    ->exclude('resources/views')
    ->exclude('storage')
    ->exclude('public')
    ->notName('*.txt')
    ->ignoreDotFiles(TRUE)
    ->ignoreVCS(TRUE);

$fixers = [
    '@PSR2' => TRUE,
    'constant_case' => ['case' => 'upper'],
    'no_mixed_echo_print' => ['use' => 'print'],
    'no_trailing_comma_in_singleline_array' => TRUE,
    'no_whitespace_before_comma_in_array' => FALSE,
    'trailing_comma_in_multiline' => ['elements' => ['arrays']],
    'trim_array_spaces' => TRUE,
    'braces' => [
        'allow_single_line_closure' => TRUE,
        'position_after_functions_and_oop_constructs' => 'next',
        'position_after_control_structures' => 'next',
    ],
    'class_attributes_separation' => [
        'elements' => ['property' => 'one', 'const' => 'one'],
    ],
    'no_unneeded_curly_braces' => [
        'namespaces' => TRUE,
    ],
    'ordered_class_elements' => [
        'order' => ['use_trait', 'constant_public', 'constant_protected', 'constant_private', 'property_public', 'property_protected', 'property_private', 'construct', 'destruct', 'magic', 'phpunit', 'method_public', 'method_protected', 'method_private'],
        'sort_algorithm' => 'alpha',
    ],
    'cast_spaces' => ['space' => 'single'],
    'no_blank_lines_after_class_opening' => TRUE,
    'no_null_property_initialization' => TRUE,
    'single_class_element_per_statement' => TRUE,
    'no_break_comment' => [
        'comment_text' => ' NO BREAK',
    ],
    'single_line_throw' => TRUE,
    'no_trailing_comma_in_list_call' => TRUE,
    'function_declaration' => [
        'closure_function_spacing' => 'none' ,
    ],
    'list_syntax' => [
        'syntax' => 'short',
    ],
    'echo_tag_syntax' => [
        'format' => 'long',
        'long_function' => 'print',
    ],
    'return_type_declaration' => ['space_before' => 'none'],
    'group_import' => TRUE,
    'single_import_per_statement' => FALSE,
    'single_line_after_imports' => TRUE,
    'combine_consecutive_issets' => TRUE,
    'explicit_indirect_variable' => FALSE,
    'blank_line_after_namespace' => TRUE,
    'no_blank_lines_before_namespace' => TRUE,
    'clean_namespace' => TRUE,
    'no_leading_namespace_whitespace' => TRUE,
    'single_blank_line_before_namespace' => FALSE,
    'new_with_braces' => TRUE,
    'not_operator_with_space' => TRUE,
    'standardize_increment' => TRUE,
    'standardize_not_equals' => TRUE,
    'ternary_to_null_coalescing' => TRUE,
    'no_closing_tag' => TRUE,
    'no_useless_return' => TRUE,
    'return_assignment' => TRUE,
    'no_empty_statement' => TRUE,
    'semicolon_after_instruction' => TRUE,
    'no_singleline_whitespace_before_semicolons' => TRUE,
    'explicit_string_variable' => FALSE,
    'method_chaining_indentation' => TRUE,
    'simple_to_complex_string_variable' => FALSE,
    'array_indentation' => TRUE,
    'array_syntax' => ['syntax' => 'short'],
    'combine_consecutive_unsets' => TRUE,
    'multiline_whitespace_before_semicolons' => TRUE,
    'single_quote' => TRUE,
    'use_arrow_functions' => TRUE,
    'blank_line_after_opening_tag' => TRUE,
    'concat_space' => ['spacing' => 'one'],
    'declare_equal_normalize' => TRUE,
    'function_typehint_space' => TRUE,
    'single_line_comment_style' => ['comment_types' => ['hash']],
    'include' => TRUE,
    'lowercase_cast' => TRUE,
    'no_extra_blank_lines' => [
        'tokens' => [
            'curly_brace_block',
            'extra',
            'parenthesis_brace_block',
            'square_brace_block',
            'throw',
            'use',
        ],
    ],
    'no_multiline_whitespace_around_double_arrow' => TRUE,
    'no_spaces_around_offset' => [
        'positions' => ['outside'],
    ],
    'no_unused_imports' => TRUE,
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
    'no_whitespace_in_blank_line' => TRUE,
    'object_operator_without_whitespace' => TRUE,
    'phpdoc_order' => FALSE,
    'phpdoc_summary' => TRUE,
    'ternary_operator_spaces' => TRUE,
    'unary_operator_spaces' => TRUE,
    'whitespace_after_comma_in_array' => TRUE,
    'indentation_type' => TRUE,
    'no_spaces_after_function_name' => TRUE,
    'no_spaces_inside_parenthesis' => TRUE,
    'not_operator_with_successor_space' => TRUE,
];

$config = new PhpCsFixer\Config();

return $config
    ->setRules($fixers)
    ->setFinder($finder);
