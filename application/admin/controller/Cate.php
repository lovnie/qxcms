<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\Request;
use think\console\Input;
class Cate extends Common
{
 public function index()
    {	
        $p=input('get.p',1);
        
        $catelist=Db::name('cate')->field('id,name,level')->where('attrid',0)->order('path')->page('{$p},10')->select();
        
            $this->assign('cate',$catelist);
            
            return $this->fetch('index');
       
		
    }
    

 
}
