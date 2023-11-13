<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Họ Nguyễn <honguyentapdoan@gmail.com>
 * @Copyright (C) 2023 Họ Nguyễn. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Fri, 27 Oct 2023 13:09:09 GMT
 */

if (!defined('NV_IS_MOD_INFORMATION'))
    die('Stop!!!');

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = array();
$mod = $nv_Request->get_title('mod', 'post,get', '');

if($mod=="cat"){
    $q=$nv_Request->get_string('q', 'get','');

    $list = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE title LIKE "%' . $q . '%" AND parentid = 0 ')->fetchAll();
	foreach($list as $result){
		$json[] = ['id'=>$result['id'], 'text'=>$result['title']];
	}
	print_r(json_encode($json));die(); 
}
if($mod=="form"){
    $q=$nv_Request->get_string('q', 'get','');
    $catid=$nv_Request->get_int('catid', 'get',0);
    $year=$nv_Request->get_int('year', 'get',0);
	if($year>0){
		$form = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_form WHERE title LIKE "%' . $q . '%" AND catid = ' . $catid)->fetchAll();
		foreach($form as $result){
			$json[] = ['id'=>$result['id'], 'text'=>$result['title'] . ' năm ' . $year];
		}
	}
	print_r(json_encode($json));die(); 
}
$savecat = $nv_Request->get_int('savecat', 'post', 0);
$array_datas = array();
if($savecat){
	$catid = $nv_Request->get_int('cat', 'post', 0);
	$iday = $nv_Request->get_int('iday', 'post', 0);
	$imonth = $nv_Request->get_int('imonth', 'post', 0);
	$iyear = $nv_Request->get_int('iyear', 'post', 0);
	$itype = $nv_Request->get_string('itype', 'post', '');
	$list = $global_array_cat[$catid];
	$cat =explode(',',$list['subitem']); 
	//$itype = 'y';
	//$iyear = 2023;
	
	foreach($cat as $cat_i){
		$info_cat =  $global_array_cat[$cat_i];
		$sub_cat = explode(',',$info_cat['subitem']);
		foreach($sub_cat as $sub_cat_i){
			$array_datas[$cat_i][$global_array_cat[$sub_cat_i]['code']]['id'] = $sub_cat_i;
			if($itype == 'y'){
				$where = ' AND iyear = ' . $iyear;
				$iyear_last = $iyear - 1;
				$where_last = ' AND iyear = ' . $iyear_last;
			}elseif($itype == 'm'){
				$where = ' AND iyear = ' . $iyear . ' AND imonth = ' . $imonth;
				$imonth_last = $imonth - 1;
				if($imonth_last <0){
					$imonth_last = 0;
				}else{
					$where_last = ' AND iyear = ' . $iyear . ' AND imonth = ' . $imonth_last;
				}
			}elseif($itype == 'd'){
				$where = ' AND iyear = ' . $iyear . ' AND imonth = ' . $imonth . ' AND iday = ' . $iday;
				$iday_last = $iday -1;
				if($iday_last <0){
					$iday_last = 0;
				}else{
					$where_last = ' AND iyear = ' . $iyear . ' AND imonth = ' . $imonth . ' AND iday = ' . $iday_last;
				}
			}else{
				$where = '';
			}
			
			$result_last = $db->query('SELECT sum(idata) as total FROM ' . NV_PREFIXLANG . '_' . $module_data . '_data WHERE code = "' . $global_array_cat[$sub_cat_i]['code'] . '" ' . $where_last . '')->fetch();
			if(!empty($result_last)){
				$array_datas[$cat_i][$global_array_cat[$sub_cat_i]['code']]['last_total'] = $result_last['total'];
			}else{
				$array_datas[$cat_i][$global_array_cat[$sub_cat_i]['code']]['last_total'] = 0;
			}
			$result = $db->query('SELECT sum(idata) as total FROM ' . NV_PREFIXLANG . '_' . $module_data . '_data WHERE code = "' . $global_array_cat[$sub_cat_i]['code'] . '" ' . $where . '')->fetch();
			
			//print_r('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_data WHERE code = "' . $global_array_cat[$sub_cat_i]['code'] . '" ' . $where . ' ;');
			//print_r($result);
			if(!empty($result_last)){
				$array_datas[$cat_i][$global_array_cat[$sub_cat_i]['code']]['total'] = $result['total'];
				
			}else{
				$array_datas[$cat_i][$global_array_cat[$sub_cat_i]['code']]['total'] = 0;
			}
		}
		
	} 
}
//print_r($array_data);
//------------------
// Viết code vào đây
//------------------
$array_data['cat'] = $array_datas;
$array_data['year'] = $db->query('SELECT iyear FROM ' . NV_PREFIXLANG . '_' . $module_data . '_data group by iyear')->fetchAll();
$contents = nv_theme_information_main($array_data);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
