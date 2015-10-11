<?php

Class OclassAction extends CommonAction{

	Public function index(){

		$classid = I('classid'); 
		$this->assign('classid' ,$classid);
		$this->assign('curpage' ,I('action'));

		

		if ( I('action') == 'add' ){  //添加
			$this->display('add');
		} elseif ( I('action') == 'edit' ){  //修改
			
			$res = M('Oclass1');
			$vo = $res->where('id=' .I('id'))->find();
		
			$this->assign('curpage' ,'edit');
			$this->assign('vo' ,$vo);
			$this->display('edit');
		
		} else {  //列表
		
		
			$res = M('Oclass1');
			
			$list = $res->where('classid=' . $classid)->order('opx asc ,id asc')->select();
			
			$this->assign('list' ,$list);
		
			$this->display();
			
		}

	}


	Public function handle(){
	
		$res = M('Oclass1');
		
		$data['id'] = I('id');

		
		If( I('action') == 'del'){
			$res->where('id=' . $data['id'])->delete();
		}
		
		//$this->redirect('index' ,array('classid'=>I('classid')) ,2 ,'正在处理......');

		if($res){
			$this->success('操作成功！');
		} else {
			$this->error('操作失败');
		}

	}


	Public function save(){

		$classid = I('classid' ,0 ,'intval');
		$data = array(
			'classid' => $classid,
			'title'   => I('title'),
			'url'     => I('url'),
			//'text'    => $_POST['text'],
			//'status'  => I('status')
			'opx'     => I('opx' ,0 ,'intval')
		);
		
		
		
		$oclass1 = M('Oclass1');
		
		if( I('action') == 'add' ){
			$res = $oclass1->add($data);
		} else {
			$res = $oclass1->where('id=' . I('id'))->save($data);
		}
		
		
		
		if($res){
			$this->success('操作成功！' ,U('index' ,array('classid'=>$classid) ,''));
		} else {
			$this->error('操作失败');
		}	

	}


}
	






?>