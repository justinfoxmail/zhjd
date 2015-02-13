<?php
namespace Admin\Controller;
use Think\Controller;
class CommentController extends Controller {
    
    public function index(){
        check_login();
        check_permittion('Comment');
        $Pid = session('CURRENT_PROJECT');
        $Comment = M("Comment");
        $data = $Comment->where("place_id=".$Pid)->order("comment_date desc")->select();
        $this->assign('comments',$data);
        $this->assign('MODELID','Comment');
		$this->display();
    }

    public function delete() {
    	check_login();
        check_permittion('Comment');
    	$comment_id = I("get.id");
    	$Pid = session('CURRENT_PROJECT');
    	$Comment = M("Comment");
    	if($Comment->where("place_id=".$Pid)->where("comment_id=".$comment_id)->delete()) {
    		$this->success("删除成功");
    	} else {
    		$this->error("删除失败");
    	}
    }

}