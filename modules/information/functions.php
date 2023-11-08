<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Họ Nguyễn <honguyentapdoan@gmail.com>
 * @Copyright (C) 2023 Họ Nguyễn. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Fri, 27 Oct 2023 13:09:09 GMT
 */

if (!defined('NV_SYSTEM'))
    die('Stop!!!');

define('NV_IS_MOD_INFORMATION', true);
$global_array_cat = [];
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat ORDER BY sort ASC';
$result = $db_slave->query($sql);
while ($row = $result->fetch()) {
    $global_array_cat[$row['id']] = $row;
}
