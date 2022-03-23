<?php

const VERTION = '1.0.0';

session_start();
use lil\App\Core\Application;

define('ROOTDIR', __DIR__);
define('DEVELOPMENT', true);//در صورتی  که سایت در حال توسعه هست باید ترو و در صورت  قرار گیری روی سرور فالس


require __DIR__.'/vendor/autoload.php';
require __DIR__.'/bootstrap/app.php';

$app  = new Application();


 $app->run();


