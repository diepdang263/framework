<?php

/*
 * Configure the cache adapters.
 * View more: https://github.com/nrk/predis/wiki
 */
return [
    'Connection' => [
        'scheme' => 'tcp',
        'host' => '127.0.0.1',
        'port' => 6379,
        //'password' => '',
    ],
    'Options' => [
        'prefix' => 'my_blog_'
    ]
];
