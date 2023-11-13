<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2023 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Mon, 13 Nov 2023 15:37:58 GMT
 */

if (!defined('NV_ADMIN'))
    die('Stop!!!');

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('1', '0', '0', 'Nông Nghiệp', 'NN', '', '1', '1', '0', '2', '2,8', '6', '0', '0', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('2', '1', '0', 'Lúa', 'LUA', '', '1', '2', '1', '4', '3,5,6,7', '6', '0', '0', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('3', '2', '0', 'Lúa đông xuân', 'LDX', '', '1', '3', '2', '0', '', '6', '1698556393', '1698556393', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('5', '2', '0', 'Lúa hè thu', 'LHT', '', '2', '4', '2', '0', '', '6', '1698558886', '1698558886', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('6', '2', '0', 'Thu đông', 'LTD', '', '3', '5', '2', '0', '', '6', '1698558907', '1698558907', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('7', '2', '0', 'Lúa mùa', 'LM', '', '4', '6', '2', '0', '', '6', '1698558926', '1698558926', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('8', '1', '0', 'Các loại cây khác', 'CLCK', '', '2', '7', '1', '5', '9,10,11,12,13', '6', '1698558952', '1698558952', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('9', '8', '0', 'Ngô', 'NGO', '', '1', '8', '2', '0', '', '6', '1698558979', '1698558979', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('10', '8', '0', 'Khoai lang', 'KHOAILANG', '', '2', '9', '2', '0', '', '6', '1698558997', '1698558997', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('11', '8', '0', 'Sắn&#x002F;Khoai mì', 'SANMI', '', '3', '10', '2', '0', '', '6', '1698559014', '1698559014', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('12', '8', '0', 'Đậu tương', 'DAUTUONG', '', '4', '11', '2', '0', '', '6', '1698559041', '1698559041', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('13', '8', '0', 'Lạc', 'LAC', '', '5', '12', '2', '0', '', '6', '1698559059', '1698559059', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('14', '0', '0', 'Chỉ số sản xuất công nghiệp', 'IIP', '', '2', '13', '0', '4', '23,24,25,26', '6', '1699459892', '1699459892', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('15', '0', '0', 'Sản lượng một số sản phẩm công nghiệp chủ yếu', 'SPCN', '', '3', '23', '0', '0', '', '6', '1699459939', '1699459939', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('16', '0', '0', 'Vốn đầu tư thực hiện từ nguồn ngân sách Nhà nước do địa phương quản lý', 'VDT', '', '4', '24', '0', '0', '', '6', '1699459965', '1699459965', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('17', '0', '0', 'Doanh thu bán lẻ hàng hoá', 'DTBLThang', '', '5', '25', '0', '0', '', '6', '1699460007', '1699460007', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('18', '0', '0', 'Doanh thu dịch vụ lưu trú, ăn uống, du lịch lữ hành và dịch vụ khác', 'DVLuutruthang', '', '6', '26', '0', '0', '', '6', '1699460070', '1699460070', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('19', '0', '0', 'Chỉ số giá tiêu dùng, chỉ số giá vàng và chỉ số giá Đô la Mỹ', 'CPI', '', '7', '27', '0', '0', '', '6', '1699460101', '1699460101', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('20', '0', '0', 'Doanh thu vận tải, kho bãi và dịch vụ hỗ trợ vận tải', 'DTVT', '', '8', '28', '0', '0', '', '6', '1699460128', '1699460128', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('21', '0', '0', 'Vận tải hành khách và hàng hóa của địa phương', 'VTHKDP', '', '9', '29', '0', '0', '', '6', '1699460179', '1699460179', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('22', '0', '0', 'Trật tự, an toàn xã hội', 'XHMThang', '', '10', '30', '0', '0', '', '6', '1699460227', '1699460227', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('23', '14', '0', 'Khai khoáng', 'cat-23', '', '1', '14', '1', '5', '27,28,29,30,31', '6', '1699460298', '1699460298', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('24', '14', '0', 'Công nghiệp chế biến , chế tạo', 'cat-24', '', '2', '20', '1', '0', '', '6', '1699460309', '1699460309', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('25', '14', '0', 'Sản xuất và phân phối điện, khí đốt, nước nóng, hơi nước và điều hoà không khí', 'cat-25', '', '3', '21', '1', '0', '', '6', '1699460337', '1699460337', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('26', '14', '0', 'Cung cấp nước; hoạt động quản lý và xử lý rác thải, nước thải', 'cat-26', '', '4', '22', '1', '0', '', '6', '1699460360', '1699460360', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('27', '23', '0', 'Khai thác than cứng và than non', 'KTTCTN', '', '1', '15', '2', '0', '', '6', '1699460396', '1699460396', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('28', '23', '0', 'Khai thác dầu thô và khí đốt tự nhiên', 'KTDTKDTN', '', '2', '16', '2', '0', '', '6', '1699460428', '1699460428', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('29', '23', '0', 'Khai thác quặng kim loại', 'KTQKL', '', '3', '17', '2', '0', '', '6', '1699460447', '1699460447', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('30', '23', '0', 'Khai khoáng khác', 'KKK', '', '4', '18', '2', '0', '', '6', '1699460472', '1699460472', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_cat (id, parentid, mid, title, code, note, weight, sort, lev, numsubcat, subitem, groups_view, add_time, edit_time, status) VALUES('31', '23', '0', 'Hoạt động dịch vụ hỗ trợ khai thác mỏ và quặng', 'DVHTKT', '', '5', '19', '2', '0', '', '6', '1699460495', '1699460495', '1')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data (id, code, iday, imonth, iyear, itype, idata) VALUES('1', 'LDX', '0', '9', '2023', 'y', '10')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data (id, code, iday, imonth, iyear, itype, idata) VALUES('2', 'LDX', '0', '9', '2022', 'y', '8')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data (id, code, iday, imonth, iyear, itype, idata) VALUES('6', 'LDX', '15', '1', '2022', 'y', '100')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data (id, code, iday, imonth, iyear, itype, idata) VALUES('7', 'LHT', '15', '1', '2022', 'y', '100')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_data (id, code, iday, imonth, iyear, itype, idata) VALUES('8', 'LTD', '15', '1', '2022', 'y', '100')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}

try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form (id, code, catid, title, itype) VALUES('1', '01', '1', '01.Biểu mẫu nông nghiệp tháng', 'm')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form (id, code, catid, title, itype) VALUES('2', '02', '1', '02.Biểu mẫu nông nghiệp quý 1', 'q')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form (id, code, catid, title, itype) VALUES('3', '03', '1', '03.Biểu mẫu nông nghiệp quý 2', 'q')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form (id, code, catid, title, itype) VALUES('4', '04', '1', '04.Biểu mẫu nông nghiệp quý 3', 'q')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form (id, code, catid, title, itype) VALUES('5', '05', '1', '05.Biểu mẫu nông nghiệp quý 4', 'q')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
try {
    $db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_form (id, code, catid, title, itype) VALUES('7', '06', '1', '06.Biểu mẫu nông nghiệp', 'y')");
} catch (PDOException $e) {
    trigger_error($e->getMessage());
}
