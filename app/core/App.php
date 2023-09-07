<?php

namespace Core;

class App
{
    private $modules = [
        "auth",
        "chat",
        "general",
        "settings"
    ];

    protected $module = "";
    protected $route = "";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->splitUrl();

        if (!in_array($url[0], $this->modules))
            return false;

        $this->module = $url[0];
        unset($url[0]);

        if (isset($url[1])) {
            $controllerClassName = "\\Controllers\\" . ucfirst($this->module) . "\\" . ucfirst($url[1]);
            $controllerPath = "../app/controllers/" . $this->module . "/" . ucfirst($url[1]) . ".php";

            if (!file_exists($controllerPath)) {
                return false;
            }

            require($controllerPath);

            $this->route = $controllerClassName;
            unset($url[1]);

            $controller = new $controllerClassName;

            if (isset($url[2])) {
                if (method_exists($controller, $url[2])) {
                    $this->method = $url[2];
                    unset($url[2]);
                }
            }

            if (!empty($url)) {
                $this->params = array_values($url);
            }
            call_user_func_array([$controller, $this->method], $this->params);
        }
    }

    public function splitUrl()
    {
        $url = $_GET["url"] ?? 'auth/login';
        $url = explode("/", trim($url, "/"));

        return $url;
    }
}
