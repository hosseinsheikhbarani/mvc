<?php

define('APPTITLE', 'عنوان تستی سایت');
//DB
define('HOST','localhost');

const ADMINADDRESS ='admin';

if (DEVELOPMENT) {
    define('ROOTURL', 'http://localhost/');
    //DB
    define('USERNAME', '');
    define('PASSWORD', '');
    define('DBNAME', '');
} else {
    define('ROOTURL', '');
    //DB
    define('USERNAME', '');
    define('PASSWORD', '');
    define('DBNAME', '');
}
