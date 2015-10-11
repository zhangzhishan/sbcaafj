<?php


//幻灯片
function get_hdp_item($val=0 ,$index=null){

	$temp_des = array(
		1 => '幻灯片一 (962 * 225)',
	//	2 => '幻灯片二 (962 * 225)'
	);

	foreach ($temp_des as $key => $value) {
		$temp_option .= "<option value='". $key ."'> ". $temp_des[$key] ." </option>";
	}

	//$temp_option  = "<option value='1'> ". $temp_des[1] ." </option>";
	


	return !isset($index) ? $temp_option : $temp_des[$index];

}

//幻灯片
function get_slide_item($val=0 ,$index=null){

	$temp_des = array(
		1 => '相册 (229 * 198)',
	//	2 => '幻灯片二 (962 * 225)'
	);

	foreach ($temp_des as $key => $value) {
		$temp_option .= "<option value='". $key ."'> ". $temp_des[$key] ." </option>";
	}

	//$temp_option  = "<option value='1'> ". $temp_des[1] ." </option>";
	


	return !isset($index) ? $temp_option : $temp_des[$index];

}





//获取父组数组
function getParents($cate ,$id) {

	$arr = array();
	foreach ($cate as $v){
		if($v['id'] == $id){
			$arr[] = $v;
			$arr = array_merge($arr ,getParents($cate ,$v['parentid']));  //与获取的父类别合并
		}
	}

	return $arr;
}

?>