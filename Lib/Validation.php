<?php

namespace lil\Lib;

/**
 * Validation
 * کتابخانه اعتبار سنجی
 */
class Validation
{
    public static array $validationError = [];
    public static  $val = '';
    public static string $name = 'defult';
    public static function value($val)
    {
        self::$val = $val;
        return new self;
    }
    public static function name($name)
    {
        self::$name = $name;
        self::$validationError[self::$name] = ['error'=>[],'required'=>false];
        return new self;
    }
    public static function empty($error = 'نباید خالی باشد')
    {
        if (empty(self::$val)) {
            array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function isNumeric($error = 'باید عددی باشد')
    {
        if (!is_numeric(self::$val)) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function isInt($error = 'باید عدد باشد')
    {
        if (!is_int(self::$val)) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function isArray($error = 'باید آرایه باشد')
    {
        if (is_array(self::$val)) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function isString($error = 'باید رشته باشد')
    {
        if (is_string(self::$val)) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function isFloat($error = 'باید عدد صیحیح باشد')
    {
        if (is_float(self::$val)) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function max(int $max, $error = 'بیش از حد مجاز')
    {
        if (strlen(self::$val) > $max) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function min(int $max, $error = 'کمتر از حد مجاز')
    {
        if (strlen(self::$val) < $max) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function equal(int $max, $error = 'مساوی نیست')
    {
        if (strlen(self::$val) !== $max) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function isPhone($error = 'شماره صحیح نیست')
    {
        if (!preg_match("/^09[0-9]{9}$/", self::$val)) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public static function isEmail($error = 'رایانامه صحیح نیست')
    {
        if (!filter_var(self::$val, FILTER_VALIDATE_EMAIL)) {
             array_push(self::$validationError[self::$name]['error'],$error);
        }
        return new self;
    }
    public function required()
    {
        self::$validationError[self::$name]['required']=true;
        return new self;
    }
    public static function show()
    {
        return self::$validationError;
    }
    public static function isSuccess()
    {
        $success = true;
        foreach (self::$validationError as $e) {
           if( $e['required']&&$e['error']!==[]){
            $success = false;
            break;
           }
            
        }
            
        

        return $success;
    }
}
