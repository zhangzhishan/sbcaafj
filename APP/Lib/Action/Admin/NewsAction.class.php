<?php

Class NewsAction extends CommonAction{

	Public function index(){
		
		$classid = I('classid'); //C('NEWSCLASS.KJBZ');
		$this->assign('classid' ,$classid);
		$this->assign('curpage' ,I('action'));
		

		if ( I('action') == 'add' ){  //添加
			$this->assign('date' ,time());
			$this->display('add');
		} elseif ( I('action') == 'edit' ){  //修改
			
			$res = M('News');
			$vo = $res->where('id=' .I('id'))->find();
		
			$this->assign('curpage' ,'edit');
			$this->assign('vo' ,$vo);
			$this->display('edit');
		
		} else {  //列表
		
		
			$res = M('News');
			
			import('ORG.Util.Page');
			
			$count = $res->where('classid=' . $classid)->count();
			$Page = new Page($count ,C('PAGECOUNT'));
			$show = $Page->show();

			//$list = $res->where('classid=2')->order('id desc')->select();
			$list = $res->where('classid=' . $classid)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
			
			$this->assign('list' ,$list);
			$this->assign('page' ,$show);
			$this->assign('pagecount' ,$count);
		
			$this->display();
			
		}
		
	}
	
	
	
	Public function handle(){
	
		$res = M('News');
		
		$data['id'] = I('id');
		$data['status'] = I('status');
		
		If( I('action') == 'del'){
			$res->where('id=' . $data['id'])->delete();
		} else {
			$res->save($data);
		}
		
		//$this->redirect('index' ,array('classid'=>I('classid')) ,2 ,'正在处理......');

		if($res){
			$this->success('操作成功！');
		} else {
			$this->error('操作失败');
		}

	}
	
	Public function save(){
		
		$classid = I('classid');
		
		if(!is_numeric($classid)) $classid = 0;
		
		set_magic_quotes_runtime(0);

		$data = array(
			'classid' => $classid,
			'title'   => I('title'),
			'odate'   => strtotime(I('odate')),
			'text'    => $_POST['text'],
			'status'  => I('status')
		);
		
		
		
		$News = M('News');
		
		if( I('action') == 'add' ){
			$res = $News->add($data);
		} else {
			$res = $News->where('id=' . I('id'))->save($data);
		}
		
		
		
		if($res){
			$this->success('操作成功！');
		} else {
			$this->error('操作失败');
		}
	}
	


}

?>