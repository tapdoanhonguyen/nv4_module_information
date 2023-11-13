<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Họ Nguyễn <honguyentapdoan@gmail.com>
 * @Copyright (C) 2023 Họ Nguyễn. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Fri, 27 Oct 2023 13:09:09 GMT
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN'))
    die('Stop!!!');

define('NV_IS_FILE_ADMIN', true);

$allow_func = array('main', 'config', 'import', 'cat', 'del_cat', 'chang_cat', 'form');
global $global_array_cat;
$global_array_cat = [];
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat ORDER BY sort ASC';
$result = $db_slave->query($sql);
while ($row = $result->fetch()) {
    $global_array_cat[$row['id']] = $row;
}
/**
 * GetCatidInParent()
 *
 * @param mixed $catid
 * @return
 */
function GetCatidInParent($catid)
{
    global $global_array_cat;
    $array_cat = [];
    $array_cat[] = $catid;
    $subcatid = explode(',', $global_array_cat[$catid]['subitem']);
    if (!empty($subcatid)) {
        foreach ($subcatid as $id) {
            if ($id > 0) {
                if ($global_array_cat[$id]['numsubcat'] == 0) {
                    $array_cat[] = $id;
                } else {
                    $array_cat_temp = GetCatidInParent($id);
                    foreach ($array_cat_temp as $catid_i) {
                        $array_cat[] = $catid_i;
                    }
                }
            }
        }
    }

    return array_unique($array_cat);
}
function nv_fix_cat_order($parentid = 0, $order = 0, $lev = 0)
{
    global $db, $module_data;

    $sql = 'SELECT id, parentid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE parentid=' . $parentid . ' ORDER BY weight ASC';
    $result = $db->query($sql);
    $array_cat_order = [];
    while ($row = $result->fetch()) {
        $array_cat_order[] = $row['id'];
    }
    $result->closeCursor();
    $weight = 0;
    if ($parentid > 0) {
        ++$lev;
    } else {
        $lev = 0;
    }
    foreach ($array_cat_order as $catid_i) {
        ++$order;
        ++$weight;
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_cat SET weight=' . $weight . ', sort=' . $order . ', lev=' . $lev . ' WHERE id=' . (int) $catid_i;
        $db->query($sql);
        $order = nv_fix_cat_order($catid_i, $order, $lev);
    }
    $numsubcat = $weight;
    if ($parentid > 0) {
        $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_cat SET numsubcat=' . $numsubcat;
        if ($numsubcat == 0) {
            // Chuyên mục cha không có chuyên mục con
            $sql .= ",subitem=''";
        } else {
            $sql .= ",subitem='" . implode(',', $array_cat_order) . "'";
        }
        $sql .= ' WHERE id=' . $parentid;
        $db->query($sql);
    }

    return $order;
}
/**
 * nv_show_cat_list()
 *
 * @param int $parentid
 * @return
 */
function nv_show_cat_list($parentid = 0)
{
    global $db, $lang_module, $lang_global, $module_name, $module_data, $global_array_cat, $global_config, $module_file, $module_config;

    $xtpl = new XTemplate('cat_list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    // Cac chu de co quyen han
    $array_cat_check_content = [];
    

    // Cac chu de co quyen han
    if ($parentid > 0) {
        $parentid_i = $parentid;
        $array_cat_title = [];
        $stt = 0;
        while ($parentid_i > 0) {
            $array_cat_title[] = [
                'active' => ($stt++ == 0) ? true : false,
                'link' => NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=cat&amp;parentid=' . $parentid_i,
                'title' => $global_array_cat[$parentid_i]['title']
            ];
            $parentid_i = $global_array_cat[$parentid_i]['parentid'];
        }
        $array_cat_title[] = [
            'active' => false,
            'link' => NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=cat',
            'title' => $lang_module['cat_parent']
        ];
        krsort($array_cat_title, SORT_NUMERIC);

        foreach ($array_cat_title as $cat) {
            $xtpl->assign('CAT', $cat);
            if ($cat['active']) {
                $xtpl->parse('main.cat_title.active');
            } else {
                $xtpl->parse('main.cat_title.loop');
            }
        }
        $xtpl->parse('main.cat_title');
    }

    $sql = 'SELECT id, parentid, title, code , weight, numsubcat, status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE parentid = ' . $parentid . ' ORDER BY weight ASC';
    $rowall = $db->query($sql)->fetchAll(3);
    $num = sizeof($rowall);
    $a = 1;
    $array_status = [
        $lang_module['cat_status_0'],
        $lang_module['cat_status_1'],
        $lang_module['cat_status_2']
    ];

    $xtpl->assign('MAX_WEIGHT', $num);
    foreach ($rowall as $row) {
        list($id, $parentid, $title, $code, $weight, $numsubcat,  $status) = $row;

            $array_cat = GetCatidInParent($id);
            $check_show = 1;


        if (!empty($check_show)) {
            $admin_funcs = [];
            $weight_disabled = $func_cat_disabled = true;

            
                $func_cat_disabled = false;
                $admin_funcs[] = '<a title="' . $lang_module['add'] . '" href="' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $id . '&amp;parentid=' . $parentid . '" class="btn btn-success btn-xs" data-toggle="tooltip"><em class="fa fa-plus"></em><span class="visible-xs-inline-block">&nbsp;' . $lang_module['add'] . "</span></a>\n";
            
                $admin_funcs[] = '<a title="' . $lang_global['edit'] . '" href="' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=cat&amp;id=' . $id . '&amp;parentid=' . $parentid . '#edit" class="btn btn-info btn-xs" data-toggle="tooltip"><em class="fa fa-edit"></em><span class="visible-xs-inline-block">&nbsp;' . $lang_global['edit'] . "</span></a>\n";
            
                $weight_disabled = false;
                $admin_funcs[] = '<a title="' . $lang_global['delete'] . '" href="javascript:void(0);" onclick="nv_del_cat(' . $id . ')" class="btn btn-danger btn-xs" data-toggle="tooltip"><em class="fa fa-trash-o"></em><span class="visible-xs-inline-block">&nbsp;' . $lang_global['delete'] . '</span></a>';


			$xtpl->assign('ROW', [
                'catid' => $id,
                'link' => NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=cat&amp;parentid=' . $id,
                'title' => $title,
                'adminfuncs' => implode(' ', $admin_funcs)
            ]);

            $xtpl->assign('STT', $a);
            $xtpl->assign('STATUS', $array_status[$status]);
            $xtpl->assign('STATUS_VAL', $status);

            $xtpl->assign('VIEWCAT_MODE', $numsubcat > 0 ? 'full' : 'nosub');

                $xtpl->parse('main.data.loop.weight');

            
                    $xtpl->parse('main.data.loop.status');
             

            if ($numsubcat) {
                $xtpl->assign('NUMSUBCAT', $numsubcat);
                $xtpl->parse('main.data.loop.numsubcat');
            }

            $xtpl->parse('main.data.loop');
            ++$a;
        }
    }

    if ($num > 0) {

        foreach ($array_status as $key => $val) {
            if ( $key != 0) {
                $xtpl->assign('K', $key);
                $xtpl->assign('V', $val);
                $xtpl->parse('main.data.status');
            }
        }
        $xtpl->parse('main.data');
    }

    $xtpl->parse('main');
    $contents = $xtpl->text('main');

    return $contents;
}

