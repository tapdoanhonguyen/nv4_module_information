/**
 * @Project NUKEVIET 4.x
 * @Author Họ Nguyễn <honguyentapdoan@gmail.com>
 * @Copyright (C) 2023 Họ Nguyễn. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Fri, 27 Oct 2023 13:09:09 GMT
 */


function nv_del_cat(id) { 
    $.post(script_name + '?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_cat&nocache=' + new Date().getTime(), 'id=' + id, function(res) {
        nv_del_cat_result(res);
    });
    return false;
}

function nv_del_cat_result(res) {
    var r_split = res.split('_');
    if (r_split[0] == 'OK') {
        var parentid = parseInt(r_split[1]);
        nv_show_list_cat(parentid);
    } else if (r_split[0] == 'CONFIRM') {
        if (confirm(nv_is_del_confirm[0])) {
            var catid = r_split[1];
            var delallcheckss = r_split[2];
            $.post(script_name + '?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_cat&nocache=' + new Date().getTime(), 'catid=' + catid + '&delallcheckss=' + delallcheckss, function(res) {
                nv_del_cat_result(res);
            });
        }
    } else if (r_split[0] == 'ERR' && r_split[1] == 'CAT') {
        alert(r_split[2]);
    } else if (r_split[0] == 'ERR' && r_split[1] == 'ROWS') {
        if (confirm(r_split[4])) {
            var catid = r_split[2];
            var delallcheckss = r_split[3];
            $.post(script_name + '?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_cat&nocache=' + new Date().getTime(), 'catid=' + catid + '&delallcheckss=' + delallcheckss, function(res) {
                $("#edit").html(res);
            });
            parent.location = '#edit';
        }
    } else {
        alert(nv_is_del_confirm[2]);
    }
    return false;
}
