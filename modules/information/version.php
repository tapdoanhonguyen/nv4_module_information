<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Họ Nguyễn <honguyentapdoan@gmail.com>
 * @Copyright (C) 2023 Họ Nguyễn. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Fri, 27 Oct 2023 13:09:09 GMT
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

$module_version = array(
    'name' => 'Information',
    'modfuncs' => 'main,detail,search',
    'change_alias' => 'main,detail,search',
    'submenu' => 'main,detail,search',
    'is_sysmod' => 0,
    'virtual' => 1,
    'version' => '4.5.04',
    'date' => 'Fri, 27 Oct 2023 13:09:09 GMT',
    'author' => 'Họ Nguyễn (honguyentapdoan@gmail.com)',
    'uploads_dir' => array($module_name,$module_name.'/files'),
    'files_dir' => array($module_name,$module_name.'/files'),
    'note' => ''
);
