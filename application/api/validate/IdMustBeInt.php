<?php


namespace app\api\validate;


class IdMustBeInt extends BaseValidate
{
    public $rule = [
        'id' => 'require|idInt'
    ];
}