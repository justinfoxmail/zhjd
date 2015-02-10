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

}