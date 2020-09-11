<?php

namespace app\api\validate;

use app\lib\exception\ParamsException;
use think\Validate;
use think\Request;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();
        $result = $this->check($params);
        if (!$result) {
            throw new ParamsException([
                'msg' => $this->error
            ]);
        }
        return true;
    }

    public function idInt($value)
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        }
        return "Id必须为正整数";
    }
}