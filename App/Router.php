<?php
declare(strict_types=1);
namespace App;
use App\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes = [];

    public function register(string $method, string $route, callable|array  $action): self
    {
       

        $this->routes[$method][$route] = $action;
        return $this;
    }
    //get

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }
    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $method, string $uri)
    {
        $route = explode('?', $uri)[0];
        $action = $this->routes[$method][$route] ?? null;

        
        if (! $action) {
            throw new RouteNotFoundException();
        }
        if (is_callable($action)) {
            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {
                $class = new $class();

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
        throw new RouteNotFoundException();
      // return call_user_func($action);
}
}
