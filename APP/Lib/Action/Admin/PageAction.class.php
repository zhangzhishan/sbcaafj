<?php

Class PageAction extends CommonAction{

	Public function index(){
	
		$issummary = I('issummary' ,0);
	
	
		
		$Page = M('Page');
		
		$vo = $Page->where('id='.$_GET['id'])->find();
		
		$this->assign('issummary' ,$issummary);
		$this->assign('vo' ,$vo);
		$this->display();
	}
	
	
	Public function save(){
	
		$Page = M('Page');
		
		//$data = array('id'=>I('id') ,'title'=>I('title') ,'text'=>$_POST['text']);
		//$res = $Page->save($data);
		$Page->create();
		$res = $Page->save();
		
		if( $res ){
			$this->success('保存成功');
		} else{
			$this->error('操作失败');
		}
	}
	
	
	//网站参数设置
	Public function saveset(){
	
//		echo 'APP_PATH='.APP_PATH;
//		exit;


	
		$xflag = F('Mydate/HJwebconfig' ,$_POST ,APP_PATH);
		
		if( $xflag ){
			$this->success('保存成功');
		} else{
			$this->error('操作失败');
		}
	}
	
	Public function set(){
		
		$webconfig = F('Mydate/HJwebconfig' ,'' ,APP_PATH);
		
		//P($HJwebconfig);
		$this->assign('webconfig' ,$webconfig);
		$this->display();
		
	}
	

}


?>