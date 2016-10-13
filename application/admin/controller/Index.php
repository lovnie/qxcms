<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
class Index extends Common
{
    public function index()
    {	
        
       return $this->fetch('index');
		
    }
    private function getMySQLVer(){
        $rst = Db::query('select version() as ver');
        return isset($rst[0]['ver']) ? $rst[0]['ver'] : '未知';
    }
    
    public function main() {
        $serverInfo = array(
                //获取服务器信息（操作系统、Apache版本、PHP版本）
                'server_version' => $_SERVER['SERVER_SOFTWARE'],
                //获取MySQL版本信息
                'mysql_version' => $this->getMySQLVer(),
                //获取服务器时间
                'server_time' => date('Y-m-d H:i:s', time()),
                //上传文件大小限制
                'max_upload' => ini_get('file_uploads') ?
                ini_get('upload_max_filesize') : '已禁用',
                //脚本最大执行时间
                'max_ex_time' => ini_get('max_execution_time').'秒',
            );
       $this->assign('serverInfo',$serverInfo);


       return $this->fetch('main');
        
    }
}
