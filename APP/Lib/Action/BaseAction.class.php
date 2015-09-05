<?php

Class BaseAction extends Action{

	Public function _initialize(){
	
		//网站参数配置
		$webconfig = F('Mydate/HJwebconfig' ,'' ,APP_PATH);
		$this->assign('webconfig' ,$webconfig);
		
		
		//友情链接
		$linklist = get_oclass1_name(299);
		$this->assign('linklist',$linklist);


		//网站幻灯片
		$hdp = M('Hdp');
		$hdplist = $hdp->where(array('status' => 0 ,'classid' => 1))->field(array('title' ,'img1' ,'url'))->order('opx ,id')->select();
		$this->assign('hdplist',$hdplist);
		
		//网站相册
		$slide = M('Slide');
		$slidelist = $slide->where(array('status' => 0 ,'classid' => 1))->field(array('title' ,'img1' ,'url'))->order('opx ,id')->select();
		$this->assign('slidelist',$slidelist);
	}

}





?>
