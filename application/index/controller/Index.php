<?php
namespace app\index\controller;
use think\Db;
use think\Request;
use think\Loader;
use think\Controller;
class Index extends Controller
{
    public function index()
    {	
        
        

      dump(Db::name('user')->where('id',1)->find());
      
		
    }
}
