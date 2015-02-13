<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends Controller {
    
    public function index(){
        check_login();
        check_permittion('Comment');
        $this->assign('MODELID','Comment');
		$this->display();
    }

}