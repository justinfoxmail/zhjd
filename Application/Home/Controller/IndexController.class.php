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
            if(empty(I("post."))){
                $params = json_decode(file_get_contents('php://input'),true);
            } else {
                $params = I("post.");
            }
            $map['loginname'] = $params['username'];
            $map['password'] = md5($params['password']);
            if($User->where($map)->select()){
                session("user",$map['loginname']);
                $data['lastlogin'] = date('Y-m-d H:i:s');
                $data['lastip'] = get_client_ip();
                $User->where($map)->data($data)->save();
                $this->ajaxReturn(1);
            }
            $this->ajaxReturn(0);
        }
    }

    public function doLogout() {
        if(session('?user')==true) {
            if(session('user',null)){
                $this->ajaxReturn(1);
            }
        }
        $this->ajaxReturn(0);
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