<?php
namespace Admin\Controller;
use Think\Controller;
class ChartAnalyseController extends Controller {
    
    public function index(){
        check_login();
        check_permittion('ChartAnalyse');
        $this->assign('MODELID','ChartAnalyse');
		$this->display();
    }

}