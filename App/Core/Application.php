<?php

namespace lil\App\Core;


/**
 * Application
 * وظیفه :
 *  ساخته اشیاع از کلاس های فریم ورک
 */
class Application
{
    public Request $request;
    public Response $response;
    public Route $route;
    public ViewRender $viewRender;
    public static Application $app;
    public Controller $controller; 
    public function __construct()
    {
        self::$app = $this;
        $this->viewRender   = new ViewRender();
        $this->request   = new Request();
        $this->response = new Response();
        $this->controller = new Controller();
        $this->route = new Route();
    }
    public function run() {
        echo $this->route->resolve();
    }
}
