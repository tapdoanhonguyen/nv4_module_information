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

/**
 * nv_theme_information_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_information_main($array_data)
{
    global $module_info, $lang_module, $lang_global, $op, $global_array_cat;
//print_r($module_info);
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign('OP', $op);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_info['module_data']);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    //------------------
    // Viết code vào đây
    //------------------
	if(!empty($array_data['cat'])){
		foreach ($array_data['cat'] as $cat_i => $idata){
			$xtpl->assign('CAT', $global_array_cat[$cat_i]);
			foreach($idata as $key => $subcat){
				//print_r($global_array_cat[$subcat['id']]['title']);
				if(empty($subcat['last_total'])){
					$subcat['last_total'] = 0;
				}
				if(empty($subcat['total'])){
					$subcat['total'] = 0;
				}
				if($subcat['last_total'] > 0){
					$subcat['percent'] = $subcat['total']*100/$subcat['last_total'];
				}else{
					if($subcat['total'] >0){
						$subcat['percent'] = 100;
					}else{
						$subcat['percent'] = 0;
					}
				}
				$subcat = array(
					'title' => $global_array_cat[$subcat['id']]['title'],
					'last_total' => $subcat['last_total'],
					'total' => $subcat['total'],
					'percent' => $subcat['percent']
				);
				
				$xtpl->assign('SUBCAT', $subcat);
				$xtpl->parse('main.cat.sub');
			}
			
			
			$xtpl->parse('main.cat');
		}
	}
	if(!empty($array_data['year'])){
		//print_r($array_data['year']);
		foreach ($array_data['year'] as $key => $idata){
			$xtpl->assign('OPTION', array('key' => $idata['iyear'], 'title' => $idata['iyear']));
			$xtpl->parse('main.iyear');
		}
	}
    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_information_detail()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_information_detail($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign('OP', $op);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_info['module_name']);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_information_search()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_information_search($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;
	
    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('OP', $op);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_info['module_name']);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
