<?php

return [
    'Debug' => true,

    /*
     * Thong bao bang mail cho admin
     */
    'AppNotification' => [
        'Error' => true
    ],

    /*
     * Cau hinh cho site
     */
    'Timezone' => 'Asia/Ho_Chi_Minh',

    /*
     * Cac gia tri mac dinh cua route
     */
    'Route' => [
        'Module' => null,
        'Controller' => 'DefaultController',
        'Method' => 'Index'
    ],

    /*
     * Cach luu log
     */
    'Log' => [
        'Type' => 'daily', // Support: single, daily
        'Ext'  => '.log',
        'Path' => STORAGE . 'logs' . DS
    ],
];
