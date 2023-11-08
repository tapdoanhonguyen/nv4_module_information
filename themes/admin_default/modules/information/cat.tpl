<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>

<div id="module_show_list">
	{CAT_LIST}
</div>
<br />

<div id="edit">
	<!-- BEGIN: error -->
	<div class="alert alert-warning">
		{ERROR}
	</div>
	<!-- END: error -->
	<!-- BEGIN: content -->
	<form action="{NV_BASE_ADMINURL}index.php" method="post">
		<input type="hidden" name ="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
		<input type="hidden" name ="{NV_OP_VARIABLE}" value="{OP}" />
		<input type="hidden" name ="id" value="{id}" />
		<input type="hidden" name ="parentid_old" value="{parentid}" />
		<input name="savecat" type="hidden" value="1" />
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<caption>
					<em class="fa fa-file-text-o">&nbsp;</em>{caption}
				</caption>
				<tbody>
					<tr>
						<th class="col-md-4 text-right">{LANG.name}: <sup class="required">(∗)</sup></th>
						<td class="col-md-20 text-left"><input class="form-control w500" name="title" type="text" value="{title}" maxlength="250" id="idtitle"/><span class="text-middle"> {GLANG.length_characters}: <span id="titlelength" class="red">0</span>. {GLANG.title_suggest_max} </span></td>
					</tr>
					<tr>
						<th class="text-right">{LANG.code}: </th>
						<td><input class="form-control w500 pull-left" name="code" type="text" value="{code}" maxlength="250" id="idalias"/> &nbsp;</td>
					</tr>
					<tr>
						<th class="text-right">{LANG.cat_sub}: </th>
						<td>
						<select class="form-control w200" name="parentid" id="parentid">
							<!-- BEGIN: cat_listsub -->
							<option value="{cat_listsub.value}" {cat_listsub.selected}>{cat_listsub.title}</option>
							<!-- END: cat_listsub -->
						</select></td>
					</tr>
					
					<tr>
						<th class="text-right">
						<br />
						{LANG.viewcat_detail} </th> 
						<td>
						<!-- BEGIN: groups_views -->
						<div class="row">
							<label><input name="groups_view[]" type="checkbox" value="{groups_views.value}" {groups_views.checked} />{groups_views.title}</label>
						</div>
						<!-- END: groups_views -->
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br />
		<div class="text-center">
			<input class="btn btn-primary" name="submit1" type="submit" value="{LANG.save}" />
		</div>
	</form>
</div>

<script type="text/javascript">
var CFG = [];
CFG.upload_current = '{UPLOAD_CURRENT}';
CFG.upload_path = '{UPLOAD_PATH}';
$(document).ready(function() {
	$("#parentid").select2();
	$("#titlelength").html($("#idtitle").val().length);
	$("#idtitle").bind("keyup paste", function() {
		$("#titlelength").html($(this).val().length);
	});


});
function nv_del_cat(id) { 
    $.post(script_name + '?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=del_cat&nocache=' + new Date().getTime(), 'id=' + id, function(res) {
        nv_del_cat_result(res);
    });
    return false;
}
</script>
<!-- END: content -->
<!-- END: main -->