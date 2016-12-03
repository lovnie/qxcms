<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class News extends Common
{
    public function index(){
        
        return $this->fetch('index');
    }
    
    public function add(){
        $catelist=Db::name('cate')->field('id,name,uname,level')->where('attrid',0)->order('path')->select();
        $this->assign('cate',$catelist);
        return $this->fetch('add');
    }
    public function upload(){
        $file = request()->file('imgFile');
        if(!empty($file)){
            $result = $this->validate(['file' => $file], ['file'=>'image'],['file.image' => '非法图像文件']);
            if(true !== $result){
                $this->error($result);
            }
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads/newstitle');
            if($info){
                $data['url']=$info->getSaveName();
            
                $data['error']=0;
                return json($data);
            
            }else{
                $data['message']=$file->getError();
                $data['error']=1;
                return json($data);
            }
        }
        
    }
}
?>