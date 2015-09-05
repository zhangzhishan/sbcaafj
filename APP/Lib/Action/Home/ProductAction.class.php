<?php

Class ProductAction extends BaseAction{

	Public function index(){

		$cateids = I('cateid');

		$classid = 0; //名家作品

		if($cateids){
			$right_title_text = get_pro_cate_name($cateids);
			$where = "( cateid like '". $cateids ."|%' or cateid = '0|". $cateids ."|' or cateid like '%|". $cateids ."|%' ) and ";   //大类或者只有一级
		}


		$product = M('Product');
		$list = $product->where($where .'status = 0 and classid = '.$classid)->field('id ,title ,img1')->order('opx asc,id desc')->select();


		$array = get_left_index(101);
		if(!$right_title_text) $right_title_text = $array['right_title_text'];
		Load('extend');  //加载msubstr函数

		// //获取产品类别
	 //  	$pro_cate = F('Mydate/pro_cate' ,'' ,APP_PATH);

		$pro_cate = M('Cate')->where(array('classid' => $classid))->field('id ,title ,parentid')->order('opx ,id')->select();
		$new_cate = get_rearray($pro_cate);
	  	$this->assign('pro_cate',$new_cate);


		$this->assign('list',$list);
		$this->assign('right_title_text' ,$right_title_text);
		$this->assign('left_index'       ,$array['left_index']);
		$this->display();
	}


	Public function detail(){

		$id = I('id' ,0 ,'intval');

		$product = M('Product');

		$product->where('id='.$id)->setInc('hits');

		$pro = $product->where('id='.$id)->field('id ,title ,text ,img1 ,odate ,cateid ,hits,classid')->find();

		
		$array = get_left_index(101);
		$right_title_text = get_pro_cate_name($pro['cateid']);
		if(!$right_title_text) $right_title_text = $array['right_title_text'];


		//获取产品类别
	  	//$pro_cate = F('Mydate/pro_cate' ,'' ,APP_PATH);
	  	$classid = $pro['classid'];
	  	$pro_cate = M('Cate')->where(array('classid' => $classid))->field('id ,title ,parentid')->order('opx ,id')->select();
		$new_cate = get_rearray($pro_cate);
	  	$this->assign('pro_cate',$new_cate);




	  	//获取上一页，下一页id=======================================
		$previd = 0;
		$nextid = 0;
		$index  = 0;
		$where1 = 'status = 0 AND classid = '.$classid ;
		if($cateid) $where1 .= " AND cateid = '". $cateid ."'";
		$ids = $product->where($where1)->field('id')->order('opx asc,id desc')->select();


		if ($ids && count($ids) > 1) {
			foreach ($ids as $v) {

				++$index;

				if($id == $v['id']){
					$flag = 1;	
				} else {
					if(!$flag) {
						$previd = $v['id'];
					} else {
						//echo $index;
						//排除第一个和最后一个
						if(($index-1) != count($ids)){
							$nextid = $v['id'];
							break;
						}
						
					}	
					
				}
			}
		}


		$this->assign('previd',$previd);
		$this->assign('nextid',$nextid);
		
		//===============================================================================






		$this->assign('right_title_text' ,$right_title_text);
		$this->assign('left_index'       ,$array['left_index']);
		$this->assign('pro' ,$pro);
		$this->display();

	}
}


?>