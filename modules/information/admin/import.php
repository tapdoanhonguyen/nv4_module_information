<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Họ Nguyễn <honguyentapdoan@gmail.com>
 * @Copyright (C) 2023 Họ Nguyễn. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Fri, 27 Oct 2023 13:09:09 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$page_title = $lang_module['import'];
$mod = $nv_Request->get_title('mod', 'post,get', '');

if($mod=="cat"){
    $q=$nv_Request->get_string('q', 'get','');

    $list = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE title LIKE "%' . $q . '%" AND parentid = 0 ')->fetchAll();
foreach($list as $result){
    $json[] = ['id'=>$result['id'], 'text'=>$result['title']];
}
print_r(json_encode($json));die(); 
}

if ($nv_Request->isset_request('import', 'post')){
	if( isset( $_FILES['excel'] ) )
	{

		$upload = new NukeViet\Files\Upload( ['documents'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT );
		$upload->setLanguage( $lang_global );

		if( isset( $_FILES['excel']['tmp_name'] ) and is_uploaded_file( $_FILES['excel']['tmp_name'] ) )
		{
			 
			$upload_info = $upload->save_file( $_FILES['excel'], NV_ROOTDIR . '/' . NV_TEMP_DIR, false, $global_config['nv_auto_resize'] );
	 
		
			if( empty( $upload_info['error'] ) )
			{
		
		
				$filepath = $upload_info['name'];

				$FileType = 'Xls';
				if( $upload_info['ext'] == 'xls' || $upload_info['ext'] == 'XLS' )
				{
					$FileType = 'Xls';
				}
				if( $upload_info['ext'] == 'xlsx' || $upload_info['ext'] == 'XLSX' )
				{
					$FileType = 'Xlsx';
				}
				
				//$inputFileType = 'Xlsx';
				//$inputFileType = 'Xml';
				//$inputFileType = 'Ods';
				//$inputFileType = 'Slk';
				//$inputFileType = 'Gnumeric';
				//$inputFileType = 'Csv';
	 
				$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($FileType);
				$reader->setReadDataOnly(true);
				$spreadsheet = $reader->load( $filepath );
	 
				$worksheet = $spreadsheet->getActiveSheet();

				$dataContent = [];
				$begin = 0;
				foreach( $worksheet->getRowIterator() as $key => $row )
				{
					 
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells( false ); 
					$cells = [];
					foreach( $cellIterator as $cell )
					{
						$column = $cell->getColumn();
						$cells[$column] = $cell->getValue();
					}
					if( $begin > 0 && isset( $cells['B'] ) && !empty( $cells['B'] ) )
					{
						$dataContent[] = $cells;
					}		
					++$begin;
					foreach( $dataContent as $key => $data )
					{
						$error = array();
						$data['code'] = trim((string)$data['B']);
						$data['iday'] = trim((string)$data['C']);
						$data['imonth'] = trim((string)$data['D']);
						$data['iyear'] = trim((string)$data['E']);
						$data['idata'] = trim((string)$data['F']);
						$stmt = $db->prepare( 'SELECT code FROM ' . NV_PREFIXLANG . '_' . $module_data . '_data WHERE code = :code AND iday = :iday AND imonth = :imonth AND iyear = :iyear' );
						$stmt->bindParam( ':code', $data['code'], PDO::PARAM_STR );
						$stmt->bindParam( ':iday', $data['iday'], PDO::PARAM_INT );
						$stmt->bindParam( ':imonth', $data['imonth'], PDO::PARAM_INT );
						$stmt->bindParam( ':iyear', $data['iyear'], PDO::PARAM_INT );
						$stmt->execute();
						$query_error_code = $stmt->fetchColumn();
						//print_r($query_error_code);
						if(empty($query_error_code) && $data['idata'] > 0){
							
							try
							{
								$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_data SET 
								idata = :idata , code = :code , iday = :iday , imonth = :imonth , iyear = :iyear' );

								$stmt->bindParam( ':idata', $data['idata'], PDO::PARAM_INT );
								$stmt->bindParam( ':code', $data['code'], PDO::PARAM_STR );
								$stmt->bindParam( ':iday', $data['iday'], PDO::PARAM_INT );
								$stmt->bindParam( ':imonth', $data['imonth'], PDO::PARAM_INT );
								$stmt->bindParam( ':iyear', $data['iyear'], PDO::PARAM_INT );
								
								$stmt->execute();
								//print_r($data['code']);
							}catch ( PDOException $e )
							{
								//print_r($data['idata']);
								 //var_dump($e);die;

								++$insert_error;
								
							}
						}
					}
				}
			}
		}
	}
	//print_r($dataContent);die;
}
//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

$xtpl = new XTemplate('import.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------
if ($nv_Request->isset_request('import', 'post')){
	if(empty($insert_error)){
		$xtpl->parse('main.thanh_cong');
	}
}
$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
