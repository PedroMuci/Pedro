<?php

namespace Routes;

class Router
{
    private $routes = [];

    public function __construct()
    {
        $this->registerRoutes();
    }

    private function registerRoutes()
    {
        $this->routes = [
            'GET' => [
                'contas' => 'Controllers\\ContaController@index',
                'contas/{id}' => 'Controllers\\ContaController@show',
                'postagens' => 'Controllers\\PostagemController@index',
                'postagens/{id}' => 'Controllers\\PostagemController@show',
                'notas' => 'Controllers\\NotaController@index',
                'notas/{id}' => 'Controllers\\NotaController@show',
                'analises' => 'Controllers\\AnaliseController@index',
                'analises/{id}' => 'Controllers\\AnaliseController@show',
            ],
            'POST' => [
                'contas' => 'Controllers\\ContaController@create',
                'postagens' => 'Controllers\\PostagemController@create',
                'notas' => 'Controllers\\NotaController@create',
                'analises' => 'Controllers\\AnaliseController@create',
            ],
            'PUT' => [
                'contas/{id}' => 'Controllers\\ContaController@update',
                'postagens/{id}' => 'Controllers\\PostagemController@update',
                'notas/{id}' => 'Controllers\\NotaController@update',
                'analises/{id}' => 'Controllers\\AnaliseController@update',
            ],
            'DELETE' => [
                'contas/{id}' => 'Controllers\\ContaController@delete',
                'postagens/{id}' => 'Controllers\\PostagemController@delete',
                'notas/{id}' => 'Controllers\\NotaController@delete',
                'analises/{id}' => 'Controllers\\AnaliseController@delete',
            ],
        ];
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $url = preg_replace('#^public/#', '', $url);

        if (!isset($this->routes[$method])) {
            http_response_code(404);
            echo json_encode(['message' => 'Endpoint não encontrado']);
            return;
        }

        foreach ($this->routes[$method] as $route => $action) {
            $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $route);
            $pattern = "@^" . $pattern . "$@";

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);
                list($controllerClass, $methodName) = explode('@', $action);
                $controller = new $controllerClass();
                return call_user_func_array([$controller, $methodName], $matches);
            }
        }

        http_response_code(404);
        echo json_encode(['message' => 'Endpoint não encontrado']);
    }
}
?>