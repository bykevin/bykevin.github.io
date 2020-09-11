<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IdMustBeInt;
use think\Db;
use think\Exception;

class Index extends BaseController
{
    public function index($id)
    {
        $res = Db::query('select * from banner_item where banner_id=?',[$id]);
        $res;
    }
}