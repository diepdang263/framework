<?php

namespace App\Core;

use Predis\Client;

class Cache
{
    /**
     * @var Client
     */
    protected static $predis;

    /**
     * Cache constructor.
     */
    public function __construct($config)
    {
        self::$predis = new Client($config['Connection'], $config['Options']);
    }

    /**
     * Store value to cache
     *
     * @param string $key
     * @param mixed  $values
     *
     * @return bool
     */
    public static function store($key, $values)
    {
        if (!self::$predis->set($key, $values)) {
            return false;
        }

        return true;
    }

    /**
     * Get data from cache
     *
     * @param string $key
     *
     * @return mixed
     */
    public static function read($key)
    {
        $value = self::$predis->get($key);
        if (empty($value))
            return false;

        return $value;
    }

    /**
     * Call to method of Predis
     */
    public static function __callStatic($name, $arguments)
    {
        $arguments = implode(', ', $arguments);
        return self::$predis->$name($arguments);
    }
}
