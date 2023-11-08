<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    exit('Stop!!!');
}

$page_title = $lang_module['cat'];

if (defined('NV_EDITOR')) {
    require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
}

$currentpath = NV_UPLOADS_DIR . '/' . $module_upload;
$error = $admins = '';
$savecat = 0;
list($id, $parentid, $title, $titlesite, $code, $description, $descriptionhtml, $keywords, $groups_view, $image, $viewdescription, $featured, $ad_block_cat) = [
    0,
    0,
    '',
    '',
    '',
    '',
    '',
    '',
    '6',
    '',
    0,
    0,
    ''
];

$groups_list = nv_groups_list();

$parentid = $nv_Request->get_int('parentid', 'get,post', 0);

$id = $nv_Request->get_int('id', 'get', 0);

if ($id > 0 and isset($global_array_cat[$id])) {
    $parentid = $global_array_cat[$id]['parentid'];
    $title = $global_array_cat[$id]['title'];
    $code = $global_array_cat[$id]['code'];
    $groups_view = $global_array_cat[$id]['groups_view'];


    $caption = $lang_module['edit_cat'];
    $array_in_cat = GetCatidInParent($id);
} else {
    $caption = $lang_module['add'];
    $array_in_cat = [];
}

$savecat = $nv_Request->get_int('savecat', 'post', 0);

if (!empty($savecat)) {
    $id = $nv_Request->get_int('id', 'post', 0);
    $parentid_old = $nv_Request->get_int('parentid_old', 'post', 0);
    $parentid = $nv_Request->get_int('parentid', 'post', 0);
    $title = $nv_Request->get_title('title', 'post', '', 1);

    // Xử lý liên kết tĩnh
    $_code = $nv_Request->get_title('code', 'post', '');
    //$_code = ($_code == '') ? get_mod_code($title, 'cat', $id) : get_mod_code($_code, 'cat', $id);

    if (empty($_code) or !preg_match("/^([a-zA-Z0-9\_\-]+)$/", $_code)) {
        if (empty($code)) {
            if ($id) {
                $code = 'cat-' . $id;
            } else {
                $_m_id = $db->query('SELECT MAX(id) AS cid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat')->fetchColumn();

                if (empty($_m_id)) {
                    $code = 'cat-1';
                } else {
                    $code = 'cat-' . ((int) $_m_id + 1);
                }
            }
        }
    } else {
        $code = $_code;
    }

    $_groups_post = $nv_Request->get_array('groups_view', 'post', []);
    $groups_view = !empty($_groups_post) ? implode(',', nv_groups_post(array_intersect($_groups_post, array_keys($groups_list)))) : '';





    if ($id == 0 and $title != '') {
        $weight = $db->query('SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE parentid=' . $parentid)->fetchColumn();
        $weight = (int) $weight + 1;
        $subcatid = '';

        $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . "_cat (parentid, title, code, weight, sort, lev, numsubcat, subitem, add_time, edit_time, groups_view, status) VALUES
            (:parentid, :title, :code, :weight, '0', '0', '0', :subitem, " . NV_CURRENTTIME . ', ' . NV_CURRENTTIME . ', :groups_view, 1)';

        $data_insert = [];
        $data_insert['parentid'] = $parentid;
        $data_insert['title'] = $title;
        $data_insert['code'] = $code;
        $data_insert['weight'] = $weight;
        $data_insert['subitem'] = $subcatid;
        $data_insert['groups_view'] = $groups_view;

        $newcatid = $db->insert_id($sql, 'id', $data_insert);
        if ($newcatid > 0) {
            nv_fix_cat_order();



            $nv_Cache->delMod($module_name);
            nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['add'], $title, $admin_info['userid']);
            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&parentid=' . $parentid);
        } else {
            $error = $lang_module['errorsave'];
        }
    } elseif ($id > 0 and $title != '') {
        $stmt = $db->prepare('UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_cat SET parentid= :parentid, title= :title, titlesite=:titlesite, code = :code,  groups_view= :groups_view, edit_time=' . NV_CURRENTTIME . ' WHERE id =' . $id);
        $stmt->bindParam(':parentid', $parentid, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':titlesite', $titlesite, PDO::PARAM_STR);
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->bindParam(':groups_view', $groups_view, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $check_ad_block_cat = explode(',', $ad_block_cat);

            if ($parentid != $parentid_old) {
                $weight = $db->query('SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE parentid=' . $parentid)->fetchColumn();
                $weight = (int) $weight + 1;

                $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_cat SET weight=' . $weight . ' WHERE id=' . (int) $id;
                $db->query($sql);

                nv_fix_cat_order();
                nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['edit_cat'], $title, $admin_info['userid']);
            }

    

            $nv_Cache->delMod($module_name);
            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&parentid=' . $parentid);
        } else {
            $error = $lang_module['errorsave'];
        }
    } else {
        $error = $lang_module['error_name'];
    }
}

$groups_view = array_map('intval', explode(',', $groups_view));

if (!empty($ad_block_cat)) {
    $ad_block_cat = explode(',', $ad_block_cat);
} else {
    $ad_block_cat = [];
}
$array_cat_list = [];

    $array_cat_list[0] = $lang_module['cat_sub_sl'];

foreach ($global_array_cat as $catid_i => $array_value) {
    $lev_i = $array_value['lev'];

        $xtitle_i = '';
        if ($lev_i > 0) {
            $xtitle_i .= '&nbsp;&nbsp;&nbsp;|';
            for ($i = 1; $i <= $lev_i; ++$i) {
                $xtitle_i .= '---';
            }
            $xtitle_i .= '>&nbsp;';
        }
        $xtitle_i .= $array_value['title'];
        $array_cat_list[$catid_i] = $xtitle_i;

}

if (!empty($array_cat_list)) {
    $cat_listsub = [];
    foreach ($array_cat_list as $catid_i => $title_i) {
        if (!in_array((int) $catid_i, array_map('intval', $array_in_cat), true)) {
            $cat_listsub[] = [
                'value' => $catid_i,
                'selected' => ($catid_i == $parentid) ? ' selected="selected"' : '',
                'title' => $title_i
            ];
        }
    }

    $groups_views = [];
    foreach ($groups_list as $group_id => $grtl) {
        $groups_views[] = [
            'value' => $group_id,
            'checked' => in_array((int) $group_id, $groups_view, true) ? ' checked="checked"' : '',
            'title' => $grtl
        ];
    }



}

$lang_global['title_suggest_max'] = sprintf($lang_global['length_suggest_max'], 65);
$lang_global['description_suggest_max'] = sprintf($lang_global['length_suggest_max'], 160);

if (!empty($image) and file_exists(NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image)) {
    $image = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $image;
    $currentpath = dirname($image);
}

$xtpl = new XTemplate('cat.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

$xtpl->assign('caption', $caption);
$xtpl->assign('id', $id);
$xtpl->assign('title', $title);
$xtpl->assign('titlesite', $titlesite);
$xtpl->assign('code', $code);
$xtpl->assign('parentid', $parentid);
$xtpl->assign('CAT_LIST', nv_show_cat_list($parentid));




if (!empty($error)) {
    $xtpl->assign('ERROR', $error);
    $xtpl->parse('main.error');
}

if (!empty($array_cat_list)) {
    if (empty($code)) {
        $xtpl->parse('main.content.getcode');
    }

    foreach ($cat_listsub as $data) {
        $xtpl->assign('cat_listsub', $data);
        $xtpl->parse('main.content.cat_listsub');
    }

    foreach ($groups_views as $data) {
        $xtpl->assign('groups_views', $data);
        $xtpl->parse('main.content.groups_views');
    }



    $xtpl->parse('main.content');
}

$xtpl->parse('main');
$contents .= $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
