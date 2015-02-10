<?php
namespace Admin\Controller;
use Think\Controller;
class HotelController extends Controller {
    public function index(){
        check_login();
        check_permittion('Hotel');
    	$Pid = session('CURRENT_PROJECT');
        $Hotel = D("Hotel");
        $hotel_data = $Hotel->getData($Pid);
        $photos = M("Photos")->where('place_id='.$Pid)->select();
        $this->assign('img_arr',$photos);
        $this->assign('place',$Pid);
        $this->assign('hotel_arr',$hotel_data);
        $this->assign('MODELID','Hotel');
        $this->display();
    }

    public function insert() {
        check_login();
        if(check_project_selected()) $this->error(C('PROJECT_SELECT_TIP'));
        $place = $_GET['place'];
        if(IS_POST){
            if(!$OP = D('Hotel') ){
                $this->error('不存在该数据表');
            } else{
            	$data = I("post.");
            	$data['place_id'] = $place;
            	if($OP->insertData($data)) {
        			$this->success("添加成功!");
        		} else {
        			$this->error("添加失败");
        		}
            }
        }
    }

    public function edit() {
        $key = I("post.key");
        $Hotel = M("Hotel");
        $data = $Hotel->where("hotel_id=".$key)->select();
        $this->ajaxReturn($data[0]);
    }

    public function update() {
        check_login();
        if(check_project_selected()) $this->error(C('PROJECT_SELECT_TIP'));
        $place = $_GET['place'];
        if(IS_POST){
            if(!$OP = D('Hotel') ){
                $this->error('不存在该数据表');
            }
            $data = I('post.');
            $flag = $OP->updateData($place,$data);
            if($flag==0) {
                $this->success('修改成功');
            } else{
                $this->error('修改失败');
            }
        }
    }

    public function delete() {
        check_login();
        if(check_project_selected()) $this->error(C('PROJECT_SELECT_TIP'));
        $place = $_GET['place'];
        $key = $_GET['key'];
        if(!$OP = D('Hotel') ){
            $this->error('不存在该数据表');
        }
        
        if($OP->deleteData($place,$key)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    public function setcover() {
        $url = I("post.url");
        $id = I("post.id");
        $Hotel = M("Hotel");
        $data['hotel_cover'] = $url;
        if($Hotel->where('hotel_id='.$id)->save($data)) {
            $this->success("修改成功");
        } else {
            $this->error("修改失败");
        }
    }
    
}