<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */
    'admin' => 'admin',
    'api' => 'api',
    'auth' => 'auth',
    'website' => '',
    'user' => 'user',
    'image' => [
        'small' => [
            'height' => 200,
            'width' => 200
        ],
        'medium' => [
            'height' => 500,
            'width' => 500
        ],
        'large' => [
            'height' => 800,
            'width' => 800
        ],

    ],

    'placeholder' => [
        'small' => asset('assets/website/images/200x200placeholder.png'),
        'large' => asset('assets/website/images/500x500placeholder.png'),
        'medium' => asset('assets/website/images/800x800placeholder.png'),
    ],

    'emails' => [

        /*
        |--------------------------------------------------------------------------
        | Headers
        |--------------------------------------------------------------------------
        |
         */

        'header' => [
            'background' => '#101f2d',
            'logo' => asset('assets/website/images/logo.png'),
            'width' => '124',
            'height' => '34',
            'styles' => 'font-size:22px; line-height:40px; color:#5a5a5a;',
        ],

        /*
        |--------------------------------------------------------------------------
        | Fonts
        |--------------------------------------------------------------------------
        |
         */

        'font' => [
            'styles' => 'font-size:14px; line-height:22px; color:#5a5a5a;',
            'link' => 'font-size:14px; line-height:22px; color:#101F2D;',
            'alert' => 'padding: 15px; font-size:14px; line-height:22px; color:#a94442; background: #f2dede; border:1px solid #ebccd1;',
        ],

        /*
        |--------------------------------------------------------------------------
        | Tables
        |--------------------------------------------------------------------------
         */

        'table' => [
            'styles' => 'border:1px solid #d8d8d8; font-family:Arial, Helvetica, sans-serif;',
            'header' => [
                'styles' => 'font-size:14px; height:25px; color:#5a5a5a; border-bottom:1px solid #d6d6d6;',
                'background' => '#f0f0f0',
            ],
            'body' => [
                'styles' => 'font-size:13px; line-height: 20px; color:#5a5a5a;',
            ],
            'footer' => [
                'styles' => 'font-size:13px; height:25px; color:#5a5a5a; border-top:1px solid #d6d6d6;',
            ],
        ],
    ]
];
