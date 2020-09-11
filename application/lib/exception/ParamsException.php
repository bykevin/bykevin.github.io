<?php

namespace app\lib\exception;

class ParamsException extends BaseException
{
    public $code = 400;
    public $msg = "传入参数错误";
    public $errorCode = 10001;
}