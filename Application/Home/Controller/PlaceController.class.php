<?php
namespace Home\Controller;
use Think\Controller;
class PlaceController extends Controller {
    public function index() {
        $ID = $_GET['pid'];
        $Place = M('Place');
        $THEME = $Place->where('id='.$ID)->getField('theme');
        $PLACE_NAME = $Place->where('id='.$ID)->getField('name');
        $img_cover = M("Photos")->where('place_id='.$ID.' AND img_cover=1')->select();
        $this->assign('img_cover',$img_cover[0]['img_url']);
        $this->assign('pid',$ID);
        $this->assign('place_name',$PLACE_NAME);
	    $this->theme($THEME)->display();
    }

    public function info() {
        $Pid = $_GET['place'];
        $Place = D('Place');
        $info = $Place->relation('Info')->find($Pid);
        $info_data = $info['Info'];
        $this->assign('name',$info['name']);
        $this->assign('information',nl2br($info_data['information']));
        $this->assign('ticket',nl2br($info_data['ticket']));
        $this->assign('introduction',$info_data['introduction']);
        $this->assign('location',nl2br($info_data['location']));
        $this->assign('more',nl2br($info_data['more']));
        $this->assign('pid',$Pid);
        $THEME = get_theme($Pid);
        $this->theme($THEME)->display();
    }

    public function photos() {
        $Pid = $_GET['place'];
        $Place = D("Place");
        $images = $Place->relation('Photos')->find($Pid);
        $this->assign('img_arr',$images['Photos']);
        $this->assign('name',$images['name']);
        $THEME = get_theme($Pid);
        $this->assign('pid',$Pid);
        $this->theme($THEME)->display();
    }

    public function hotel() {
        $Pid = $_GET['place'];
        $Place = D("Place");
        $hotels = $Place->relation('Hotel')->find($Pid);
        $hotel_data = $hotels['Hotel'];
        $this->assign('hotel_arr',$hotel_data);
        $this->assign('hotel_count',count($hotel_data));
        $this->assign('name',$hotels['name']);
        $this->assign('pid',$Pid);
        $THEME = get_theme($Pid);
        $this->theme($THEME)->display();
    }

    public function hotel_info() {
        $Pid = $_GET['place'];
        $RoomId = $_GET['hotelid'];
        $Place = D("Place");
        $hotels = $Place->relation('Hotel')->find($Pid);
        $hotel_data = $hotels['Hotel'][$RoomId];
        $this->assign('hotel_name',$hotel_data['hotel_name']);
        $this->assign('hotel_addr',$hotel_data['hotel_addr']);
        $this->assign('hotel_more',$hotel_data['hotel_more']);
        $this->assign('hotel_cover',$hotel_data['hotel_cover']);
        $this->assign('hotel_detail',$hotel_data['hotel_detail']);
        $this->assign('name',$hotels['name']);
        $THEME = get_theme($Pid);
        $this->theme($THEME)->display();
    }

    public function resturant() {
        $Pid = $_GET['place'];
        $Place = D("Place");
        $resturant = $Place->relation('Resturant')->find($Pid);
        $res_data = $resturant['Resturant'];
        $this->assign('res_arr',$res_data);
        $this->assign('pid',$Pid);
        $this->assign('res_count',count($res_data));
        $this->assign('name',$resturant['name']);
        $this->assign('pid',$Pid);
        $THEME = get_theme($Pid);
        $this->theme($THEME)->display();
    }

    public function resturant_info() {
        $Pid = $_GET['place'];
        $ResId = $_GET['resid'];
        $Place = D("Place");
        $resturant = $Place->relation('Resturant')->find($Pid);
        $res_data = $resturant['Resturant'][$ResId];
        $this->assign('res_name',$res_data['res_name']);
        $this->assign('res_more',$res_data['res_introduction']);
        $this->assign('res_time',$res_data['res_time']);
        $this->assign('res_location',$res_data['res_location']);
        $this->assign('res_feature',$res_data['res_feature']);
        $this->assign('res_notice',$res_data['res_notice']);
        $this->assign('name',$resturant['name']);
        $THEME = get_theme($Pid);
        $this->theme($THEME)->display();
    }

    public function news() {
    	$Pid = $_GET['place'];
    	$url= C('NEWS');
		redirect($url[$Pid]);
        // $this->theme($_GET['site'])->display();
    }


    public function location() {
        $Pid = $_GET['place'];
        $filename = "./Data/Common/index.json";
        $array = json_decode(file_get_contents($filename),true);
        for ($i=0; $i < count($array); $i++) { 
            if($array[$i]["id"]==intval($Pid)) {
                $this->assign('point',$array[$i]["location"]);
                break;
            }
        }
        $THEME = get_theme($Pid);
        $this->assign('pid',$Pid);
        $this->theme($THEME)->display();
    }
}