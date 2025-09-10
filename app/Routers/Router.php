<?php

namespace App\Routers;
class Router {
    private static $routes = [];
    public static function get(string $uri, $callback) {
        self::routePush('GET',$uri, $callback);
    }
    public static function post(string $uri, $callback) {
        self::routePush('POST',$uri, $callback);
    }
    private static function routePush(string $method, string $uri, $callback) {
        self::$routes[] = [
            'uri'      => $uri,
            'method'   => $method,
            'callback' => $callback,
        ];
    }

    public static function run() {
        $uri = ltrim(explode('?', $_SERVER['REQUEST_URI'])[0], '/');
        $method = $_SERVER['REQUEST_METHOD'];
        foreach (self::$routes as $route) {
            $callback = $route['callback'];

            if (ltrim($route['uri'], '/') == $uri && $route['method'] == $method) {
                if (is_array($callback)) {
                    [$class, $action] = $callback;
                    $obj = new $class();
                    $obj->$action();
                } else if (is_callable($callback)) {
                    // $route['callback']();
                    call_user_func($callback);
                } else {
                    echo "Route callback is not callable";
                }
                return;
            }
        }
        echo "404 Not Found";
    }
}