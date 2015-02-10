<?php
namespace Admin\Model;
use Think\Model;
class NewsModel extends Model {

    public function index(){
    	$this->show("123");
    }

    public function insertData($data){
        if($this->create($data)) {
            return $this->data($data)->add();
        }
        return -1;
    }

    public function updateData($id,$data){
    	foreach($data as $key => $value) {
            $value = nl2br($value);
        }
        if ($this->create()) {
            return ($this->where('new_id='.$id)->data($data)->save());
        } else {
            // 字段验证错误
            return $this->getError();
        }
    }

    public function deleteData($id){
    	return $this->where('new_id='.$id)->delete();
    }
}