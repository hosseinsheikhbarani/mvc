<?php

namespace lil\App\Core;

include_once ROOTDIR . '/Route/web.php';
include_once ROOTDIR . '/Route/api.php';

class Route
{
    public static ?string $prefix = null;
    public static array $routs = [];

    public Request $request;
    public Response $response;

    public static function get($path, $calback = null)
    {
        self::$routs[] = ['prefix' => self::$prefix, 'get' => $path, 'calback' => $calback];
    }
    public static function post($path, $calback = null)
    {
        self::$routs[] = ['prefix' => self::$prefix, 'post' => $path, 'calback' => $calback];
    }
    public static function match($methods, $path, $calback = null)
    {
        foreach ($methods as $method) {
            self::$routs[] = ['prefix' => self::$prefix, $method => $path, 'calback' => $calback];
        }
    }
    //با هر متهد
    public static function any($path, $calback = null)
    {
        self::$routs[] = ['prefix' => self::$prefix, 'get' => $path, 'calback' => $calback];
        self::$routs[] = ['prefix' => self::$prefix, 'post' => $path, 'calback' => $calback];
    }


    public static function prefix(string $prefix)
    {
        self::$prefix = $prefix;
        return new self;
    }
    public static function group($group)
    {
        call_user_func($group);
    }

    public static function resolve()
    {
        $url = isset($_GET['url']) ? trim($_GET['url']) : '/';

        if ($url == '/') {
            $url = ['/'];
        } else {
            $url = preg_split('/\//', rtrim($url));
        }
    
        $route0 = $url[0];

        $route1 = isset($url[1]) ? $url[1] : '/';
        $url= array_slice($url,1);
        $prefix = 0;

        //اگر پرفیکش ست بود
        foreach (self::$routs as $e) {
         
            $x = '';
            if (isset($e[(new Request())->method()])) {
                $x = $e[(new Request())->method()];
            }
            if ($e['prefix'] == $route0 && $x == $route1) {
                $prefix = 1;
                $url= array_slice($url,1);
                self::action($e['calback'], $url);
                break;
            }
        }
        //اگز پرفیکس ست نبود
        if ($prefix == 0) {
            foreach (self::$routs as $e) {
               
                $x = '';
                if (isset($e[(new Request())->method()])) {
                    $x = $e[(new Request())->method()];
                }
               
                if ($e['prefix'] == NULL && $x == $route0) {
                    $prefix = 2;
                    
                    self::action($e['calback'], $url);
                    break;
                }
            }
        }
     
        if ($prefix === 0) {
            view('_404');
        }
    }
    public static function action($calback, $url)
    {
        if (is_array($calback)) {
            $class = new $calback[0];
        
            $model = $calback[1];
            call_user_func_array([$class, $model], $url);
        } else {
            call_user_func($calback);
        }
    }
}
