<?php

namespace App\Core;

class Log
{
    public static $config = [
        'type' => 'daily',
        'path' => '../storage/logs/',
        'ext' => '.log'
    ];

    public static function __callStatic($name, $arguments)
    {
        $filename = '';
        $content = '';

        if (self::$config['type'] == 'single') {
            $filename = self::$config['path'] . $name . self::$config['ext'];
        } elseif (self::$config['type'] == 'daily') {
            $filename = self::$config['path'] . date('d_m_Y', time()) . self::$config['ext'];
            $content .= '[' . strtoupper($name) . '] ';
        }

        $content .= date('[H:i:s d-m-Y] ', time()) . $arguments[0];
        array_shift($arguments);

        foreach($arguments as $key => $value) {
            if (is_array($value)) {
                $content .= print_r($value, true);
            } else {
                $content .= $value;
            }
        }

        file_put_contents($filename, $content . PHP_EOL, FILE_APPEND);
    }
}
