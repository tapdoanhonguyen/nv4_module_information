<!-- BEGIN: main -->
<!-- BEGIN: cat_title -->
<ol class="breadcrumb breadcrumb-catnav">
    <!-- BEGIN: loop --><li><a href="{CAT.link}">{CAT.title}</a></li><!-- END: loop -->
    <!-- BEGIN: active --><li class="active">{CAT.title}</li><!-- END: active -->
</ol>
<!-- END: cat_title -->
<!-- BEGIN: data -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center w100">{LANG.weight}</th>
                <th class="text-center">{LANG.name}</th>
                <th class="text-center">{LANG.status}</th>
                <th class="text-center w150">{LANG.functional}</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td class="text-center">
                    <!-- BEGIN: stt -->{STT}<!-- END: stt -->
                    <!-- BEGIN: weight -->
                    <button id="cat_weight_{ROW.id}" data-toggle="changecat" data-mod="weight" data-min="1" data-num="{MAX_WEIGHT}" data-catid="{ROW.catid}" data-current="{STT}" type="button" class="btn btn-default btn-xs btn-block btn-cattool"><span class="caret"></span><span class="text">{STT}</span></button>
                    <!-- END: weight -->
                </td>
                <td>
                    <a href="{ROW.link}"><strong>{ROW.title}</strong>
                    <!-- BEGIN: numsubcat -->
                    <span class="red">({NUMSUBCAT})</span>
                    <!-- END: numsubcat -->
                    </a>
                </td>
                
                <td class="text-center">
                    <!-- BEGIN: disabled_status -->
                    {STATUS}
                    <!-- END: disabled_status -->
                    <!-- BEGIN: status -->
                    <button id="cat_status_{ROW.id}" data-toggle="changecat" data-mod="status" data-catid="{ROW.id}" data-current="{STATUS_VAL}" data-cmess="{LANG.cat_status_0_confirm}" type="button" class="btn btn-default btn-xs btn-block btn-cattool"><span class="caret"></span><span class="text">{STATUS}</span></button>
                    <!-- END: status -->
                </td>
                <td class="text-center">{ROW.adminfuncs}</td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<ul id="cat_list_full" class="hidden">
    <!-- BEGIN: viewcat_full --><li><a href="#" data-value="{K}">{V}</a></li><!-- END: viewcat_full -->
</ul>
<ul id="cat_list_nosub" class="hidden">
    <!-- BEGIN: viewcat_nosub --><li><a href="#" data-value="{K}">{V}</a></li><!-- END: viewcat_nosub -->
</ul>
<ul id="cat_list_status" class="hidden">
    <!-- BEGIN: status --><li><a href="#" data-value="{K}">{V}</a></li><!-- END: status -->
</ul>
<!-- END: data -->
<!-- END: main -->