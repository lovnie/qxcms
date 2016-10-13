<?php
namespace app\admin\controller;
use think\Controller;
class Common extends Controller
{
    protected function _initialize()
    {
        if (!session('admin')) {
           
            $this->redirect(url('Login/index'));
        }else {
            
            $this->assign('admin',session('admin'));
        }
     
    }
}   
?>