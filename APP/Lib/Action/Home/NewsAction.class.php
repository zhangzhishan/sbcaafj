<?php

Class NewsAction extends BaseAction{
	
	public function index(){
		
		$classid = I('classid' ,0 ,'intval');
		
		$array = get_left_index($classid);
		
		$News = M('News');
		//$list = $News->where('classid='.$classid.' and status=0')->order('id desc')->select();
		


		import('ORG.Util.Page');
			
		$count = $News->where('classid=' . $classid)->count();
		$Page = new Page($count ,C('PAGECOUNT'));
		$show = $Page->show();

		$list = $News->where('classid='.$classid.' and status=0')->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		

		$this->assign('list' ,$list);
		$this->assign('page' ,$show);
		$this->assign('pagecount' ,$count);







		//$this->assign('list' ,$list);
		$this->assign('right_title_text' ,$array['right_title_text']);
		$this->assign('left_index'       ,$array['left_index']);
		$this->display();
	}
	
	
	public function detail(){
		
		$id = I('id' ,0 ,'intval');
		
		$News = M('News');
		
		$News->where('id='.$id)->setInc('hits');
		
		$vo = $News->where('id='.$id)->find();


		
		$array = get_left_index(intval($vo['classid']));
		
		if($array['left_index'] == 0 || $array['left_index'] == ''){
			//公司动态列表
			$News = M('News');
			$list = $News->where('classid='.C('NEWSCLASS.GSDT').' and status = 0')->order('id desc')->limit(20)->select();
			Load('extend');  //加载msubstr函数	

			$this->assign('list' ,$list);
			
		
		}
		
	    //print_r($vo);
		
		//$this->assign('right_title_text' ,$array['right_title_text']);
		$this->assign('right_title_text' ,$vo['title']);
		$this->assign('left_index'       ,$array['left_index']);
		$this->assign('vo' ,$vo);
		$this->display();
		
	}
	
	
	

}

?>