<?php

	function p($array){
	
		dump($array ,1 ,'<pre>' ,0);
	
	}

	function get_left_index($classid){
	
		switch($classid){
			case 2:
				$right_title_text = '各科目考级标准';
				$left_index = 1;
				break;
			case 3:
				$right_title_text = '考级教材';
				$left_index = 1;
				break;
				
			case 4:
				$right_title_text = '校友会章程';
				$left_index = 4;
				break;	
			case 5:
				$right_title_text = '校友会资讯';
				$left_index = 3;
				break;	
			case 6:
				$right_title_text = '理事会理事';
				$left_index = 4;
				break;	
			case 101:   //名家作品欣赏
				$right_title_text = '名家作品';
				$left_index = 5;
				break;
			case 102:   //优秀作品展示
				$right_title_text = '优秀作品展示';
				$left_index = 6;
				break;
			case 103:   //青年艺术家作品
				$right_title_text = '青年艺术家作品';
				$left_index = 7;
				break;
			case 104:   //装饰作品
				$right_title_text = '少儿作品';
				$left_index = 8;
				break;
			case 108:
				$right_title_text = '下载中心';
				$left_index = 334;
				break;
				
			default:
				$right_title_text = '信息发布';
				$left_index = 0;	
		}
		
		return array(
			'right_title_text' => $right_title_text,
			'left_index' => $left_index
		);
	
	}

	//判断文件是否存在
	function is_file_exists($file_path ,$flag=1){

		$new_path = './Public/uploads/s_' . $file_path;
		if(!is_file($new_path)) {
			$new_path = __ROOT__ . '/Public/commonimages/nophoto.gif';
		}else{

			if($flag == 2){
				$new_path = __ROOT__ . '/Public/uploads/b_' . $file_path;  //大图
			} else{
				$new_path = __ROOT__ . '/Public/uploads/s_' . $file_path;  //小图
			}
			
		}	

		return $new_path;
	}
	function true_file_path($file_path ,$flag=1){

		$new_path = __ROOT__ . '/Public/downloads/' . $file_path;
		return $new_path;
	}


	//获取产品类别名称
	function get_pro_cate_name($cateids ,$flag=1){


		$cateids = str_replace('|', ',', $cateids) . '0';
		// //获取产品类别
	 	// $pro_cate = F('Mydate/pro_cate' ,'' ,APP_PATH);

		$cate = M('cate')->where("id in ($cateids)")->field('id ,title')->order('id')->select();


		foreach ($cate as $v) {

			$cate_name .= $v['title'];
			if($v != end($cate)) $cate_name = $cate_name .' > ';
	  	}	

		
	
		return $cate_name;
	}


	//获取表oclass1内容
	function get_oclass1_name($classid=0 ,$flag=0){

		$oclass1 = M('Oclass1');

		$res = $oclass1->where('classid='.$classid)->order('opx ,id')->select();

		return $res;
	}


	function get_rearray($cate ,$parentid = 0){

		$arr = array();

		// foreach ($cate as $key => $value) {
			
		// 	if($parentid == $value['parentid']){
		// 		$value['child'] = get_rearray($cate ,$value['id']);
		// 		$arr[] = $value;
		// 	}

		// }

		foreach ($cate as $v) {
			if($v['parentid'] == $parentid){
				$v['child'] = get_rearray($cate ,$v['id']);
				$arr[] = $v;
			}
		}


		return $arr;
	}


	function get_title_sub($str, $start=0, $length, $charset="utf-8", $suffix=true){

		//function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
		    if(function_exists("mb_substr"))
		        $slice = mb_substr($str, $start, $length, $charset);
		    elseif(function_exists('iconv_substr')) {
		        $slice = iconv_substr($str,$start,$length,$charset);
		        if(false === $slice) {
		            $slice = '';
		        }
		    }else{
		        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		        preg_match_all($re[$charset], $str, $match);
		        $slice = join("",array_slice($match[0], $start, $length));
		    }

		    if(utf8_strlen($str) > $length){
		    	return $slice.'...';
		    } else {
		    	return $slice;
		    }

		   // return $suffix ? $slice.'...' : $slice;
		//}

	//	$temp = mb_substr($str, 1, $length, $charset);

	}

	function utf8_strlen($string = null) {
		// 将字符串分解为单元
		preg_match_all("/./us", $string, $match);
		// 返回单元个数
		return count($match[0]);
	}



	function unescape($str){ 
		$ret = ''; 
		$len = strlen($str); 
		for ($i = 0; $i < $len; $i++){ 
		if ($str[$i] == '%' && $str[$i+1] == 'u'){ 
		$val = hexdec(substr($str, $i+2, 4)); 
		if ($val < 0x7f) $ret .= chr($val); 
		else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f)); 
		else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f)); 
		$i += 5; 
		} 
		else if ($str[$i] == '%'){ 
		$ret .= urldecode(substr($str, $i, 3)); 
		$i += 2; 
		} 
		else $ret .= $str[$i]; 
		} 
		return $ret; 
} 


?>