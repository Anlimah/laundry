<?php

namespace Core;

class Router
{
    private $routes = [];

    function route($method, $route, $callback)
    {
        $this->routes[$method][$route] = $callback;
    }

    function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];

        foreach ($this->routes[$method] as $route => $callback) {
            $routePattern = str_replace('/', '\/', $route);
            if (preg_match('/^' . $routePattern . '$/', $path, $matches)) {
                array_shift($matches);
                call_user_func_array($callback, $matches);
                return;
            }
        }

        // Handle 404 Not Found
        http_response_code(404);
        echo "404 Not Found";
    }
}
