<?php
namespace Admin\Model;
use Think\Model;
class HotelModel extends Model {
	protected $patchValidate = true;

	protected $_validate = array(
        array('hotel_name', 'require', '名字必须填写！', 1),//1为必须验证
        array('hotel_addr', 'require', '地址必须填写！', 1),//1为必须验证
        array('hotel_detail', 'require', '信息必须填写！', 1),//1为必须验证
    );

    public function index(){
    	$this->show("123");
    }
    
    public function getData($Pid){
        $data = $this->where('place_id='.$Pid)->getField(implode(",",$this->getDbFields()));
        return $data;
    }

    public function insertData($data){
        if($this->create($data)) {
            return $this->data($data)->add();
        }
        return -1;
    }

    public function updateData($place,$data){
    	foreach($data as $key => $value) {
            $value = nl2br($value);
        }
        if ($this->create()) {
            return ($this->where('hotel_id='.$place)->data($data)->save());
        } else {
            // 字段验证错误
            return $this->getError();
        }
    }

    public function deleteData($place,$key){
    	return $this->where('place_id='.$place.' AND hotel_id='.$key)->delete();
    }
}