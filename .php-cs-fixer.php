<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['default' => 'align_single_space'],
        'blank_line_before_statement' => ['statements' => ['return']],
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'no_unused_imports' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in([
                __DIR__.'/app',
                __DIR__.'/config',
                __DIR__.'/routes',
                __DIR__.'/database',
                __DIR__.'/tests',
            ])
    );
