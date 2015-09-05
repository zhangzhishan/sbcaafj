<?php


Class CateAction extends CommonAction{

	public function index(){

		$classid = $this->_get('classid');
		if(!is_numeric($classid)) $classid = 0;

	  	//获取产品类别
	  	//$pro_cate = F('Mydate/cate' . $classid ,'' ,APP_PATH);
	  	$pro_cate = M('cate')->where(array('classid'=>$classid))->field('id ,title ,parentid ,status ,opx')->order('opx')->select();

	  	$new_cate = get_rearray($pro_cate);

	  	//p($new_cate);
	  	$this->classid = $classid;
	  	$this->assign('pro_cate',$new_cate);
	  	$this->assign('curpage' ,I('action'));

	  	if(I('action') == 'add'){
	  		$this->display('add');
	  	} elseif (I('action') == 'edit') {

	  		$id = I('id' ,0 ,'intval');
	  		$classid = I('classid' ,0 ,'intval');

	  		$pro_cate_item = M('cate')->where(array('id'=>$id))->find();

	  		$this->pro_cate_item = $pro_cate_item;
	  		$this->display('edit');
	  	} else{
	  		$this->display();
	  	}

	}


 	Public function handle(){

		$cate = M('Cate');
		
		$data['id'] = I('id' ,0 ,'intval');
		$data['status'] = I('status');
		
		If( I('action') == 'del'){

			$res = $cate->where('parentid='.$data['id'])->find();
			if($res) $this->error('删除失败，请先删除子类');

			$res = $cate->where('id=' . $data['id'])->delete();
		} else {
			$res = $cate->save($data);
		}
		
		//$this->redirect('index' ,array('classid'=>I('classid')) ,2 ,'正在处理......');

		if($res){

			//$this->cache_pro_cate();
			$this->redirect(GROUP_NAME . '/Cate/index');
			//$this->success('操作成功！');
		} else {
			$this->error('操作失败');
		}

	}


	//添加修改类别	
	 public function save(){

	 	$classid = I('classid' ,0 ,'intval');
		$cate = M('cate');

	 	if ($_GET['action'] == 'add') {
	 		$data = array(
	 			'classid'  => $classid,
		 		'title'    => I('title'),
		 		'parentid' => I('parentid'),
		 		'opx'      => I('opx' ,0 ,'intval'),
		 		'status'   => I('status'),
		 		'odate'    => time()
		 	);
	 			
	 		$res = $cate->data($data)->add();
	 		//$cate->add($data);	

	 	}else{
	 		$data = array(
	 			'id'       => $_GET['id'],
		 		'title'    => I('title'),
		 		'opx'      => I('opx' ,0 ,'intval'),
		 		'status'   => I('status')
		 	);
	 		
	 		$res = $cate->save($data);
	 	}	

	 	if($res){

	 		//$this->cache_pro_cate();
	 		//$this->redirect('index' ,array('classid'=>I('classid')) ,2 ,'正在处理......');	
	 		$this->success('操作成功' ,U('index' ,array('classid'=>$classid)));
	 	}else{
	 		$this->error('操作失败');
	 	}

	 }


	 public function sorts (){

	 	$classid = isset($_GET['classid']) ? $_GET['classid'] : 0;


	 	foreach ($_POST as $k => $v){
	 		M('cate')->where(array('id'=>$k))->setField('opx',$v);
	 	}

	 	$this->redirect(GROUP_NAME . '/Cate/index');
	 	
	 }


	 //缓存产品类别
	 private function cache_pro_cate($classid = 0){

	 	//类别写入缓存数组
 		$cate = M('cate');
  		$pro_cate = $cate->where('classid='.$classid)->order('parentid ,opx ,id')->field('id ,title ,parentid ,opx ,status')->select();
  		F('Mydate/cate' . $classid ,$pro_cate ,APP_PATH);

	 }





}

?>