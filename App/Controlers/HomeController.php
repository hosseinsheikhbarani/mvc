<?php

namespace lil\App\Controlers;

use lil\App\Core\Controller;


class HomeController extends Controller
{
    public function home()
    {
        $params = ['name'=>'hossein sheikh barani'];
        view('home',$params);
    }
    public function test()
    {   
        jsonParser(['name'=>'hossein sheikh barani']);
    }
}
