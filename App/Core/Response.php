<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace lil\App\Core;

/**
 * Description of Response
 *
 * @author dorj
 */
class Response {
    //put your code here
    public function setStatusCode(int $code) {
        http_response_code($code); 
    }
}
