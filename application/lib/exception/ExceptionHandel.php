<?php

namespace app\lib\exception;

use Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandel extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(\Exception $e)
    {
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
            if (config('app_debug')) {
                return parent::render($e);
            }
            $this->code = 500;
//            $e->getMessage() ? $this->msg = $e->getMessage() : $this->msg = "服务器出错";
            $this->msg = '服务器出错，等会再来吧~~~';
            $this->errorCode = 999;
            $this->writeLog($e);
        }
        $request = Request::instance();
        $result = [
            'errorCode'   => $this->errorCode,
            'msg'         => $this->msg,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    private function writeLog(\Exception $e)
    {
        Log::init([
            // 日志记录方式，内置 file socket 支持扩展
            'type'  => 'File',
            // 日志保存目录
            'path'  => LOG_PATH,
            // 日志记录级别
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(), 'error');
    }
}