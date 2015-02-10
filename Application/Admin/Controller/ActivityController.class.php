<?php
namespace Admin\Controller;
use Think\Controller;
class ActivityController extends Controller {
    
    public function index(){
        check_login();
        check_permittion('Activity');
        $this->assign('MODELID','Activity');
		$this->display();
    }

}