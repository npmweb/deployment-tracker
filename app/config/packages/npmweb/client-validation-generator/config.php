<?php

return array(
    'driver' => 'jquery',

    'useRequireJs' => false,
    'packageName' => ['jquery-validation-foundation','jquery-validator-custom-rules'],
    'functionName' => 'validate_foundation',

    'ruleMappings' => array(
        'required' => 'required',
        'min' => 'minlength',
        'max' => 'maxlength',
        'date' => 'date',
        'email' => 'email',
        'url' => 'url',
        'numeric' => 'number',
        'before_now' => 'before_now',
        'same' => array(
            'rule' => 'equalTo',
            'param' => function( $param ) {
                return 'input[name=' . $param . ']';
            },
        ),
    ),

);
