<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\Request;
use think\Config;
class Login extends Controller
{
 public function index()
    {	
        
        
        if (Request::instance()->isAjax()) {
            $username = input('post.username');
            $password = input('post.password');
            $captcha  = input('post.captcha');
            $data = ['username'=>$username,'password'=>$password,'captcha'=>$captcha];
            $result = $this->validate($data,'Login');
            if(true !== $result){
                $res=array('status'=>0,'info'=>$result);
               return json($res);
            }
            $where['username'] = $username;
            $userInfo = Db::name('admin')->where($where)->find();
            if ($userInfo && $userInfo['password'] === pass_md5($password,$userInfo['salt'])) {
                $session['uid']       = $userInfo['id'];
                $session['username']  = $userInfo['username'];
                // 记录用户登录信息
                Db::name('admin')->where($where)->setInc('hits');
                Db::name('admin')->where($where)->update(['ip'=>get_client_ip(),'logintime'=>time()]);
                session('admin',$session);
                $res=array('status'=>1,'url'=>url('admin/Index/index'));
                return json($res);
            } else {
                 $res=array('status'=>0,'info'=>'用户名或密码错误');
                
               return json($res);
            } 
        
        } else {
            return $this->fetch('index');
        }      
		
    }
    
   
    public function logout()
    {
        if(Request::instance()->isAjax()){
            session('admin',null);
            $res=array('status'=>1,'url'=>url('admin/Login/index'));
            return json($res);
        }
       
    }
    
   public function captcha() {
       $captcha = new \think\captcha\Captcha((array)Config::get('captcha'));
        return $captcha->entry();
   }
 
}
