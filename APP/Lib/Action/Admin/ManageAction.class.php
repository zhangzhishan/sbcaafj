<?php


Class ManageAction extends CommonAction{

	public function index(){


	  	$this->assign('curpage' ,I('action'));

	  	if(I('action') == 'add'){
	  		$this->display('add');
	  	} elseif (I('action') == 'edit') {

	  		$id = I('id' ,0 ,'intval');
	  		$user = M('Admin')->where('id='.$id)->find();

	  		$this->assign('user',$user);
	  		$this->display('edit');
	  	} else{

	  		$user = M('Admin');
	  		$list = $user->select();

	  		$this->assign('list',$list);
	  		$this->display();
	  	}

	}


 	Public function handle(){

		$user = M('Admin');
		
		$data['id'] = I('id' ,0 ,'intval');
		
		If( I('action') == 'del'){

			$res = $user->where('id=' . $data['id'])->delete();
		} else {
			$res = $user->save($data);
		}
		
		//$this->redirect('index' ,array('classid'=>I('classid')) ,2 ,'正在处理......');

		if($res){

			$this->success('操作成功！');
		} else {
			$this->error('操作失败');
		}

	}


	//添加修改用户	
	 public function save(){


		$user = M('Admin');

	 	if (I('action') == 'add') {

	 		$res = $user->where("username='" . I('username') . "'")->find();
	 		if ($res) $this->error('操作失败，该用户名已经存在');

	 		$data = array(
		 		'username' => I('username'),
		 		'password' => I('password' ,'' ,'md5'),
		 		'odate'    => time()
		 	);
	 			
	 		$res = $user->data($data)->add();
	 		//$cate->add($data);	

	 	}else{
	 		$data = array(
	 			'id'       => I('id' ,0 ,'intval'),
		 		'password' => I('password' ,'' ,'md5')
		 	);
	 		
	 		$res = $user->save($data);
	 	}	

	 	if($res){

	 		//$this->redirect('index' ,array('classid'=>I('classid')) ,2 ,'正在处理......');	
	 		$this->success('操作成功' ,U('index'));
	 	}else{
	 		$this->error('操作失败');
	 	}

	 }



}

?>