<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends Controller {
    
    public function index(){
        check_login();
        check_permittion('News');
        $News = M("News");
        $data =$News->order('new_date desc')->select();
        $this->assign("news_arr",$data);
        $this->assign('MODELID','News');
		$this->display();
    }

    public function edit() {
        check_login();
        $key = I("post.key");
        $News = M("News");
        $data = $News->where("new_id=".$key)->select();
        $this->ajaxReturn($data[0]);
    }

    public function update() {
        check_login();
        $id = $_GET['new_id'];
        if(IS_POST){
            if(!$OP = D('News') ){
                $this->error('不存在该数据表');
            }
            $data = I('post.');
            $flag = $OP->updateData($id,$data);
            if($flag==1) {
                $this->success('修改成功');
            } else{
                $this->error('修改失败');
            }
        }
    }

    public function insert() {
        check_login();
        if(IS_POST){
            if(!$OP = D('News') ){
                $this->error('不存在该数据表');
            } else{
                $data = I("post.");
                $data['new_date'] = date('Y-m-d H:i:s');

                if($id = $OP->insertData($data)) {
                    $this->success("添加成功!");
                } else {

                    $this->error("添加失败");
                }
            }
        }
    }

    public function delete() {
        check_login();
        if(IS_POST){
            $id = I("post.key");
            if(!$OP = D('News') ){
                $this->error('不存在该数据表');
            }
            
            if($OP->deleteData($id)) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
    }

}