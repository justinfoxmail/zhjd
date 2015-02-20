<?php
namespace Admin\Controller;
use Think\Controller;
class PlaceController extends Controller {
    
    public function index(){
        check_login();
        check_permittion('Place');
        $Pid = session('CURRENT_PROJECT');
        $Place = M("Place");
        $data = $Place->where("id=".$Pid)->select();
        $this->assign('place',$Pid);
        $this->assign('MODELID','Place');
        $this->assign("name",$data[0]['name']);
        $this->assign("cover",$data[0]['cover']);
        $this->display();
    }
    
    public function update() {
        check_login();
        if(check_project_selected()) $this->error(C('PROJECT_SELECT_TIP'));
        $place = $_GET['place'];
        if(IS_POST){
            if(!$OP = M('Place') ){
                $this->error('不存在该数据表');
            }
            $data = I("post.");
            if($OP->where('id='.$place)->save($data)){
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }
    }


    public function newplace(){
        check_login();
        if(IS_POST){
            if(!$OP = M('place') ){
                $this->error('不存在该数据表');
            }
            $data = I('post.');
            $name = $data['name'];
            $data = M('place')->create($data);
            $OP->data($data)->add();
            $name = M('place')->where("name="."'".$name."'")->find();
            if(!$OP = M('info') ){
                $this->error('不存在该数据表');
            }
            $dataInfo[place_id] = $name['id'];
            $dataInfo = M('info')->create($dataInfo);
            $OP->data($dataInfo)->add();
            $this->success('添加景点成功');
        }
    }

    public function upload(){   
        check_login();
        if(check_project_selected()) $this->error(C('PROJECT_SELECT_TIP'));
        $place = $_GET['place'];

    if(IS_POST){ 
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3145728 ;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Uploads/img/';
        $upload->savePath  =     '';
        $upload->saveName  =      $place; // 设置附件上传目录
        $upload->replace   =     true;
        // 上传文件     
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息        
            $this->error($upload->getError());    
        }else{// 上传成功

            if(!$OP = M('Place') ){
                $this->error('不存在该数据表');
            }
            $data['cover'] = '/Uploads/img/'.$info[img]['savepath'].$info[img]['savename'];
            if($OP->where('id='.$place)->save($data)){
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
            $this->success('上传成功！');    
        }}
    }

}