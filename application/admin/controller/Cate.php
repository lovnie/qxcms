<?php
namespace app\admin\controller;
use think\Db;
use think\Request;
class Cate extends Common
{
 public function index()
    {	
        $catelist=Db::name('cate')->field('id,name,uname,level')->where('attrid',0)->where('level','elt',2)->order('path')->select();
        $this->assign('cate',$catelist);
        $count=Db::name('cate')->where('attrid',0)->count();
        $this->assign('count',$count);
        return $this->fetch('index');
       
		
    }
    public function ajaxIndex()
    {
        if(Request::instance()->isAjax()){
            $p=input('get.p');
            $catelist=Db::name('cate')->field(['id','name','uname','level','concat(path,",",id)'=>'paths'])->where('attrid',0)->order('paths')->page($p,10)->select(); 
            $this->assign('cate',$catelist);
            return $this->fetch('ajaxIndex');  
        }
    }
    public function getCateById(){
        if(Request::instance()->isAjax()){
            $id=input('get.id');
            $cate=Db::name('cate')->where('id',$id)->find();
            if($cate['pid']>0){
                $pname=Db::name('cate')->where('id',$cate['pid'])->value('name');
                $cate['pname']=$pname;
            }else{
                $cate['pid']=0;
                $cate['pname']='顶级分类';
            }
            return json($cate);
        }
        
    }
    public function add() {//查询出一级分类和二级分类
        
        if(Request::instance()->isAjax()){
            $data = input('');
            $result = $this->validate($data,'Cate');
            if(true !== $result){
                $res=array('status'=>0,'info'=>$result);
                return json($res);
            }
            unset($data['__token__']);
            if(empty($data['id'])){
            if($data['pid']>0){
               $data['path']=Db::name('cate')->where('id',$data['pid'])->value('path');
                if($id=Db::name('cate')->insertGetId($data)){
                    $path['id']=$id;
                    $path['path']=$data['path'].','.$id;
                    $path['level']=substr_count($path['path'],",");
                    if(Db::name('cate')->update($path)){
                        $res=array('status'=>1,'info'=>'添加成功','url'=>url('admin/Cate/index'));
                        return json($res);
                    }else {
                        $res=array('status'=>0);
                        return json($res);
                    }
                }
            }else{
                $data['path']=$data['pid'];
                $data['level']=1;
                if($id=Db::name('cate')->insertGetId($data)){
                    $path['id']=$id;
                    $path['path']=$data['path'].','.$id;
                    if(Db::name('cate')->update($path)){
                        $res=array('status'=>1,'info'=>'添加成功','url'=>url('admin/Cate/index'));
                        return json($res);
                    }else {
                        $res=array('status'=>0,'info'=>'添加失败');
                        return json($res);
                    }
                }
            }
            }else{
                if($data['pid']>0){
                    $path=Db::name('cate')->where('id',$data['pid'])->value('path');
                    $opath=Db::name('cate')->where('id',$data['id'])->value('path');
                    if(strpos($path,$opath)!==false){
                        $res=array('status'=>0,'info'=>'所属分类选择错误');
                        return json($res);
                    }else {
                        $data['path']=$path.','.$data['id'];
                        $data['level']=substr_count($data['path'],",");
                        if(Db::name('cate')->update($data)){
                            $res=array('status'=>1,'info'=>'修改成功','url'=>url('admin/Cate/index'));
                            return json($res);
                        } 
                    }
                   
                }else{
                    $data['level']=1;
                    $data['path']=$data['pid'].','.$data['id'];
                    if(Db::name('cate')->update($data)){
                        $res=array('status'=>1,'info'=>'修改成功','url'=>url('admin/Cate/index'));
                            return json($res);
                        }else {
                            $res=array('status'=>0,'info'=>'修改失败');
                            return json($res);
                    }      
                }
            }
            
        }
        $catelist=Db::name('cate')->field('id,name,uname,level')->where('attrid',0)->where('level','elt',2)->order('path')->select();
        $this->assign('cate',$catelist);
        return $this->fetch('add');
    }
    public function del() {
         if(Request::instance()->isAjax()){
             $id=input('get.id');
             if(Db::name('cate')->where('pid','in',$id)->value('id')){
                 $res=array('status'=>0,'info'=>'删除失败，分类有子分类不允许删除');
                 return json($res);
             }else {
                 if(Db::name('cate')->delete($id)){
                     $res=array('status'=>1,'info'=>'删除成功','url'=>url('admin/Cate/index'));
                     return json($res);
                 }
             }
             
         }
    }
 
}
