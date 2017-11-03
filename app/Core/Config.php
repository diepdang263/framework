<?php

namespace App\Core;

use Adbar\Dot;

class Config
{
    /**
     * Read config
     *
     * @param string $keys
     *
     * @return mixed|null
     */
    public static function read($keys)
    {
        if (($config = Cache::read('config_' . $keys)) === false) {
            // Get paths from key
            $arr = explode('.', $keys);
            $vars = [];

            // Include file from path
            $path = strtolower($arr[0]);
            array_shift($arr);

            if ($path === 'app') {
                if (APP_ENV === 'DEVELOPMENT') {
                    $vars = require CONFIG . 'app_dev.php';
                } elseif (APP_ENV === 'PRODUCTION') {
                    $vars = require CONFIG . 'app_prod.php';
                }
            } else {
                $file = CONFIG . $path . '.php';
                if (file_exists($file)) {
                    $vars = require $file;
                } else {
                    return null;
                }
            }

            // Rebuild paths
            $paths = implode('.', $arr);

            if (empty($paths))
                return $vars;

            $dot = new Dot($vars);
            $config = $dot->get($paths) ?? null;

            // Store to cache
            Cache::store('config_' . $keys, $config);
        }

        return $config;
    }
}
