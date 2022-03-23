<?php 


use lil\App\Core\Application;
//loaded view
function view($view, $params = [])
{
    echo Application::$app->viewRender->renderView($view, $params);
}
//json Parser
function jsonParser(array $data)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}


function dd($d)
{
    echo '<pre>';
    var_dump($d);
    echo '</pre>';
    exit;
}
function ddd($d)
{
    echo '<pre>';
    var_dump($d);
    echo '</pre>';
   
}
