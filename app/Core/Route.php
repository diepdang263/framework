<?php

namespace App\Core;

class Route
{
    public function start()
    {
        // Lay gia tri tu url
        $route = trim(filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL), '/\\\'');

        if (($paths = Cache::read('routes_' . str_replace('/', '_', $route))) === false) {
            $module = Config::read('App.Route.Module');
            $controller = Config::read('App.Route.Controller');
            $method = Config::read('App.Route.Method');

            $routes = explode('/', $route);

            // Kiem tra co ton tai module khong
            if (is_dir(CONTROLLER . ucfirst(strtolower($routes[0])))) {
                $module = ucfirst(strtolower($routes[0]));
                array_shift($routes);
            }

            // Kiem tra co ton tai controller khong
            if (file_exists(CONTROLLER . ucfirst(strtolower($routes[0] . 'Controller.php')))) {
                $controller = ucfirst(strtolower($routes[0])) . 'Controller';
                array_shift($routes);
            }

            // Xac dinh ten class
            if (!empty($module))
                $module = '\\' . $module;

            $controller = '\\' . $controller;

            $class = 'App\\Controller' . $module . $controller;

            // Kiem tra co ton tai method khong
            if (method_exists($class, ucfirst(strtolower($routes[0])))) {
                $method = ucfirst(strtolower($routes[0]));
                array_shift($routes);
            }

            // Luu vao cache
            $paths = json_encode([
                'class' => $class,
                'method' => $method,
                'param' => $routes
            ]);
            Cache::store('routes_' . str_replace('/', '_', $route), $paths);
        }

        // Goi controller
        $paths = json_decode($paths, true);

        $class = $paths['class'];
        $method = $paths['method'];
        $param = $paths['param'];

        if (class_exists($class)) {
            $call = new $class;

            if (method_exists($class, 'init')) {
                $call->init();
            }

            $call->$method($param);
        } else {
            echo 'Not Found';
        }
    }
}
