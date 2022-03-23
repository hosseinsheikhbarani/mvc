<?php
$routes = [
    [
        'name' => 'card',
        'path' => 'component/card',
    ],
];
function component($name,$data =[]) 
{
    global $routes;

    foreach($routes as $route){
        if ($route['name'] ==$name){
            include ROOTDIR . "/public/Views/{$route['path']}.php";
        };
    }
};
