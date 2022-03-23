<?php
//redirect to url
function redirect($dir)
{
    $dir =  !empty($dir) ? '/' . $dir : $dir;
    header("Location:" . ROOTURL . $dir);
}
// check if session exists?
function isSession(string $name): bool
{
    if (empty($_SESSION[$name])) {
        return false;
    }
    return true;
}

function get_user_IP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
function deleteSession(string $name): void
{
    unset($_SESSION[$name]);
}

function encrypt_decrypt($action, $string)
{
    /* =================================================
     * ENCRYPTION-DECRYPTION
     * =================================================
     * ENCRYPTION: encrypt_decrypt('encrypt', $string);
     * DECRYPTION: encrypt_decrypt('decrypt', $string) ;
     */
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'WS-SERVICE-KEY';
    $secret_iv = 'WS-SERVICE-VALUE';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else {
        if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    }
    return $output;
}
function convertPersianToEnglish($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    $output = str_replace($persian, $english, $string);
    return $output;
}
function convertEnglishToPersian($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    $output = str_replace($english, $persian, $string);
    return $output;
}
function alphabet($count, $lenght, $upper = 1, $line = true)
{
    if ($upper == 1) {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    } elseif ($upper == 2) {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    } else {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
    }

    $alphabetArray = str_split($alphabet);
    $str = '';
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $lenght; $j++) {
            $str .= $alphabetArray[rand(0, count($alphabetArray) - 1)];
        }
        if ($line)
            $str .= '-';
    }
    return rtrim($str, '-');
}

function showError($error = [], $name = '')
{
    if (isset($error[$name])) {

        foreach ($error[$name]['error'] as $value) {
            echo '<div class="text-danger"> ' . $value . '</div>';
        }
    }
}
