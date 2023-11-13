<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2023 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Mon, 13 Nov 2023 15:37:58 GMT
 */

if (!defined('NV_IS_FILE_MODULES'))
    die('Stop!!!');

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat(
  id mediumint(5) NOT NULL AUTO_INCREMENT,
  parentid mediumint(5) unsigned NOT NULL,
  mid smallint(5) NOT NULL DEFAULT 0,
  title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  code varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  note varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  weight int(11) NOT NULL,
  sort int(11) NOT NULL DEFAULT 0,
  lev int(11) NOT NULL DEFAULT 0,
  numsubcat int(11) NOT NULL DEFAULT 0,
  subitem text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  groups_view varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  add_time int(11) NOT NULL DEFAULT 0,
  edit_time int(11) NOT NULL DEFAULT 0,
  status tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY parentid (parentid,mid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data(
  id int(11) NOT NULL AUTO_INCREMENT,
  code varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  iday int(11) NOT NULL DEFAULT 0,
  imonth int(11) NOT NULL DEFAULT 0,
  iyear int(11) NOT NULL DEFAULT 0,
  itype varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'y',
  idata int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  KEY data (code,iday,imonth,iyear)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form(
  id int(11) NOT NULL AUTO_INCREMENT,
  code varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  catid int(11) NOT NULL DEFAULT 0,
  title varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  itype varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'y',
  PRIMARY KEY (id),
  KEY code (code(100))
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_postcomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_comm', '-1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'view_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'setcomm', '4')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'activecomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'emailcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'adminscomm', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'sortcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'perpagecomm', '5')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'timeoutcomm', '360')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowattachcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . "(lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'alloweditorcomm', '0')";
