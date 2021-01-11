<?php

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
    'options' => [
    	'length'    => 3,
        'width'     => 1200,
        'height'    => 360,
        'quality'   => 200,
        'timeout' => 30,
    ],
];
