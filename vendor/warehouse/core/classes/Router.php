<?php

namespace warehouse;



class Router
{
    
    protected array $routes = [];
    protected string $uri = '';
    protected string $method = '';


    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'],'/');
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    
    
    public function match()
    {
        global $db;
        $matches = false;
        foreach ($this->routes as $route)
        {
            if (($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method)))
            {
                $matches = true;
                require_once CONTROLLERS.'/'.$route['controller'];
                break;
            }
        }
        if(!$matches)
        {
            abort();
        }
    }
    
    
    public function add($uri,$controller,$method)
    {
        $this->routes[] = 
            [
                'uri' => $uri,
                'controller' => $controller,
                'method' => $method
            ];
    }


    public function get($uri,$controller)
    {
        $this->add($uri,$controller,'GET');
    }


    public function post($uri,$controller)
    {
        $this->add($uri,$controller,'POST');
    }


    public function delete($uri,$controller)
    {
        $this->add($uri,$controller,'DELETE');
    }















}