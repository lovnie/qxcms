<?php
namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule =   [
        'name'  => 'require|unique:cate|token',
        'uname'  => 'require|unique:cate',
        'pid'=>'number'
    ];

    protected $message  =   [
        'name.require' => '栏目名称不能为空',
        'uname.require' => '栏目别名不能为空',
        'name.unique' => '栏目名称已经存在',
        'uname.unique' => '栏目别名已经存在',
        'pid.number' => '所属分类格式不对',
        'name.token' => '重复提交',
    ];

}
?>