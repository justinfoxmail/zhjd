<?php
namespace Admin\Controller;
use Think\Controller;
class InfoController extends Controller {
    
    public function index(){
        check_login();
        check_permittion('Info');
        $Pid = session('CURRENT_PROJECT');
        $Info = D("Info");
        $data = $Info->getData($Pid);

        $id = M("Info")->field(id)->where('place_id='.$Pid)->find();

        $this->assign('information',$data[$id['id']]['information']);
        $this->assign('ticket',$data[$id['id']]['ticket']);
        $this->assign('introduction',$data[$id['id']]['introduction']);
        $this->assign('location',$data[$id['id']]['location']);
        $this->assign('more',$data[$id['id']]['more']);
        $this->assign('place',$Pid);
        $this->assign('MODELID','Info');
        $this->display();
    }

    public function update() {
        check_login();
        if(check_project_selected()) $this->error(C('PROJECT_SELECT_TIP'));
        $place = $_GET['place'];
        if(IS_POST){
            if(!$OP = D('Info') ){
                $this->error('不存在该数据表');
            }
            $data = I('post.');
            $flag = $OP->updateData($place,$data);
            if($flag==1) {
                $this->success('修改成功');
            } else if($flag==0){
                $this->error('修改失败');
            } else{
                $this->ajaxReturn($flag,'json');
            }
        }
    }

    public function delete() {
        check_login();
        if(check_project_selected()) $this->error(C('PROJECT_SELECT_TIP'));
        $place = $_GET['place'];
        $key = $_GET['key'];
        if(IS_POST){
            if(!$OP = D('Info') ){
                $this->error('不存在该数据表');
            }
            
            if($OP->deleteData($place,$key)) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
    }

}