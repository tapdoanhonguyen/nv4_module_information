<!-- BEGIN: main -->
<script type="text/javascript"src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<link href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css" type="text/css" rel="stylesheet" />
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" enctype="multipart/form-data" name="readexcel" id="readexcel" method="post">
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
            <div>
                <strong>
                    Sau khi nhập dữ liệu thật vào mẫu excel, nhấn chọn tệp để tải lên 
                </strong>
            </div>
            <div style="margin-top: 20px;">
                <select class="form-control" id="de_thi" name="de_thi">

                </select>
            </div>
            <div style="margin-top: 20px;">
                <input type="file" name="excel" id="excel" required />
            </div>

            <div style="text-align: center;">
                <input type="submit" value="Tải lên" name="import" class="btn btn-primary" />

            </div>
        </div>
    </div>

</div>
</form>
<script type="text/javascript">
    $('#de_thi').select2({
        placeholder:"Chọn danh mục", 
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
    })
</script>
<!-- END: main -->