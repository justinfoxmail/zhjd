<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index() {
	    $this->display();
    }

    public function doLogin() {
        if(IS_POST) {
            $User = M("User");
            $params = json_decode(file_get_contents('php://input'),true);
            $map['loginname'] = $params['username'];
            $map['password'] = md5($params['password']);
            if(session('?user')==true){
                $this->ajaxReturn(2);
            }
            if($User->where($map)->select()){
                session("user",$map['loginname']);
                $this->ajaxReturn(1);
            }
            $this->ajaxReturn(session("user"));
        }
    }

    public function getIndexs() {
    	$Place = M("Place");
    	$data = $Place->select();
    	$this->ajaxReturn($data);
    }

    public function getNews() {
    	$News = M("News");
    	$data = $News->order("new_date desc")->select();
    	$this->ajaxReturn($data);
    }
}