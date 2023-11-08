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

$id = $nv_Request->get_int('id', 'post', 0);
$contents = 'NO_' . $id;

list($id, $parentid, $title, $code) = $db->query('SELECT id, parentid, title, code FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE id=' . $id)->fetch(3);
if ($id > 0) {

		$sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE id=' . $id;
		if ($db->exec($sql)) {
			nv_insert_logs(NV_LANG_DATA, $module_name, $lang_module['delcatandrows'], $title, $admin_info['userid']);
			nv_fix_cat_order();
			$contents = 'OK_' . $parentid;
		}$nv_Cache->delMod($module_name);
}

if (defined('NV_IS_AJAX')) {
    include NV_ROOTDIR . '/includes/header.php';
    echo $contents;
    include NV_ROOTDIR . '/includes/footer.php';
} else {
    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=cat');
}
