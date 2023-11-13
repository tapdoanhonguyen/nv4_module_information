<!-- BEGIN: main -->
<script type="text/javascript"src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<link href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" type="text/css" rel="stylesheet" />
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" enctype="multipart/form-data" name="readexcel" id="readexcel" method="post">
    <input type="hidden" name="savecat" value=1" >
	<div class="container-fluid">
        <!-- BEGIN: loi -->
        <div class="col-xs-24 col-sm-24 col-md-24 col-lg-24 alert alert-info" style="margin-top: 20px;">
           Các danh sách có stt sau đây bị trùng tên đăng nhập nên không thể import
           <div>
               {LOI}
           </div>
       </div>
       <!-- END: loi -->
       <!-- BEGIN: thanh_cong -->
       <div class="col-xs-24 col-sm-24 col-md-24 col-lg-24 alert alert-info" style="margin-top: 20px;">
          Import thành công
      </div>
      <!-- END: thanh_cong -->
      <div class="col-xs-24 col-sm-24 col-md-24 col-lg-24" style="margin-top: 20px;">

        <div style="padding: 20px;background: #EEEEEE">
			<div style="margin-top: 20px;">
                <select class="form-control" id="iyear" name="iyear">
					<!-- BEGIN: iyear -->
					   <option value = "{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
					  <!-- END: iyear -->
                </select>
            </div>
            <div style="margin-top: 20px;">
                <select class="form-control" id="cat" name="cat">

                </select>
            </div>
			<div style="margin-top: 20px;">
                <select class="form-control" id="iform" name="iform">

                </select>
            </div>

            <div style="text-align: center;">
                <input type="radio" value="y" name="itype" /> Năm 
                <input type="radio" value="m" name="itype" /> Tháng/Năm  
                <input type="radio" value="" name="itype" /> Quý

            </div>
			<div style="text-align: center;">
                <input type="submit" value="Xem" name="report" class="btn btn-primary" />

            </div>
        </div>
    </div>

</div>
</form>

<table class="table table-striped table-bordered table-hover">
<tr>
<td>
</td>
<td>
Tên
</td>
<td class="w100">
Kỳ trước
</td>
<td class="w100">
Kỳ này
</td>
<td class="w100">
Tăng trưởng
</td>
</tr>
<!-- BEGIN: cat -->
<tr colspan="5">
<td>
{CAT.title}
</td>
</tr>
<!-- BEGIN: sub -->
<tr>
<td>
</td>
<td>
{SUBCAT.title}
</td>
<td class="w100">
{SUBCAT.last_total}
</td>
<td class="w100">
{SUBCAT.total}
</td>
<td class="w100">
{SUBCAT.percent}%
</td>
</tr>
<!-- END: sub -->
<!-- END: cat -->
</table>

<script type="text/javascript">
    $('#cat').select2({
        placeholder:"Chọn linh vực", 
        ajax: {
            url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&mod=cat',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    q: params.term
                }
                return query;
            },
            processResults: function (data) {
				
                return {
                    results: data
                };
            },
            cache: true
        }
    });
	// Add a change event listener for #cat
	$('#cat').on('change', function () {
		// Get the selected value of #cat
		$('#iform').val(null).trigger('change');
		var selectedCat = $(this).val();
		var selectedYear = $('#iyear').val();
		// Initialize or update Select2 for #year based on the selected value of #cat
		$('#iform').select2({
			placeholder: "Chọn biểu mẫu",
			ajax: {
				url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&mod=form&catid=' + selectedCat + '&year=' + selectedYear,
				dataType: 'json',
				delay: 250,
				data: function (params) {
					var query = {
						q: params.term
					}
					return query;
				},
				processResults: function (data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
	});
</script>
<!-- END: main -->