<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index() {
	    $this->display();
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