<?php

Class IndexAction extends BaseAction{
	
	public function Index(){
		
		$Page = M('Page');
		$summary = $Page->where('id=9')->getField('summary');
		
		
		//公司动态
		$News = M('News');
		$list = $News->where('classid='.C('NEWSCLASS.GSDT').' and status = 0')->order('id desc')->limit(14)->select();
		Load('extend');  //加载msubstr函数


		//首页产品推荐
		$product = M('Product');
		$pro = $product->where('status = 0 and ischeck1 = 1 and classid = 2')->field('id ,title ,img1')->limit(20)->select();


		$this->assign('pro',$pro);
		$this->assign('list' ,$list);
		$this->assign('summary' ,$summary);
		$this->display();
	}


	public function detail(){
		
		$id = I('id' ,0 ,'intval');
		
		$left_index = 0;
		
		switch($id){
			case 1 :
			case 2 :
			case 332 :
				$left_index = 1;
				break;
			case 3 :	
			case 4 :
				$left_index = 2;
				break;
			case 6 :	
			case 7 :
			case 8 :
				$left_index = 332;
				break;
			case 11:
			case 12:
				$left_index = 3;
				break;
			case 333:
			case 334:
				$left_index = 331;
				break;
			case 3311:	
			case 3312:
			case 3313:
				$left_index = 333;
				break;
			default :
				$left_index = 0;
		}
		
		
		$Page = M('Page');
		$page = $Page->where('id=' . $id)->find();


		if($left_index == 0 || $left_index == ''){
			//公司动态
			$News = M('News');
			$list = $News->where('classid='.C('NEWSCLASS.GSDT').' and status = 0')->order('id desc')->limit(20)->select();
			Load('extend');  //加载msubstr函数	

			$this->assign('list' ,$list);
			
		}


		
		$this->assign('left_index' ,$left_index);
		$this->assign('page' ,$page);
		$this->display();
	}



	public function chenjichaxun(){

		$left_index = 1;
		$right_text_title = "成绩查询";
		$this->assign('left_index' ,$left_index);
		$this->assign('right_text_title',$right_text_title);

		$this->display();

	}
	//显示网上报名页面
	public function wsbm(){

		$left_index = 1;
		//$right_text_title = "成绩查询";
		$this->assign('left_index' ,$left_index);
		//$this->assign('right_text_title',$right_text_title);

		$this->display("wsbm");

	}

	//成绩查询
	public function dochenji(){

		header("content-type:text/html; charset=utf-8");

		$xname  = I('xname') ;//$_GET['xname']   ;//I('xname') ;//unescape(I('xname'));
		$xbirth = I('xbirth');
		$xsex   = I('xsex');

		$map = array();
		$map['name']  = $xname;
		$map['date'] = strtotime($xbirth);
		$map['sex'] = $xsex;


		//$res = M('Kaojixinxi')->where(array('code'=>$code))->find();
		$res = M('Kaojixinxi')->where($map)->order('cate asc ,level desc')->limit(5)->select();

		$data = array();
		foreach($res as $v){

			if($v['sex'] == '0') $v['sex'] = '男';
			if($v['sex'] == '1') $v['sex'] = '女';

			$v['date'] = date('Y-m-d' ,$v['date']);
			$data[] = $v;
		}
		
		echo json_encode($data);
	}



/*	
	public function handle(){
	
		if(!IS_AJAX) halt('页面不存在');
		
		$data = array(
			'username' => I('username'),
			'content'  => I('content'),
			'time' => time()
		);
	}
*/	
	



}

?>