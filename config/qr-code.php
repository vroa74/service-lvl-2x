<?php

return [

    /*
    |--------------------------------------------------------------------------
    | QR Code Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Endroid QR Code generation.
    | You can customize the default settings for QR codes generated in your application.
    |
    */

    'default_size' => 300,
    'default_margin' => 10,
    'default_foreground_color' => '#000000',
    'default_background_color' => '#FFFFFF',
    'default_error_correction_level' => 'medium', // low, medium, high, very_high
    'default_encoding' => 'UTF-8',
    'default_round_block_size_mode' => true,
    'default_round_block_size' => 0.5,

    /*
    |--------------------------------------------------------------------------
    | QR Code Writer Options
    |--------------------------------------------------------------------------
    |
    | Configure the default writer options for QR code generation.
    |
    */
    'writer_options' => [
        'png' => [
            'compression' => 9,
        ],
        'svg' => [
            'exclude_xml_declaration' => false,
            'viewbox' => true,
        ],
        'eps' => [
            'compression' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | QR Code Logo Configuration
    |--------------------------------------------------------------------------
    |
    | Configure default logo settings for QR codes.
    |
    */
    'logo' => [
        'enabled' => false,
        'path' => null,
        'width' => 50,
        'height' => 50,
        'punchout_background' => true,
    ],

]; 