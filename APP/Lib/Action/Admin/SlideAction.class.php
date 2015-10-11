<?php


Class SlideAction extends CommonAction{

	public function index(){

		$this->assign('curpage' ,I('action'));

	    if ( I('action') == 'add' ){  //添加
			$this->display('add');
		} elseif ( I('action') == 'edit' ){  //修改
			
			$res = M('Slide');
			$vo = $res->where('id=' .I('id'))->find();
		
			$this->assign('curpage' ,'edit');
			$this->assign('vo' ,$vo);
			$this->display('edit');
		
		} else {  //列表
		
			$res = M('Slide');
			$list = $res->order('classid ,opx ,id')->select();

			$this->assign('list' ,$list);
			$this->display();
			
		}

	}


	Public function handle(){
	
		$res = M('Slide');
		
		$data['id'] = I('id');
		$data['status'] = I('status');
		
		If( I('action') == 'del'){
			$res->where('id=' . $data['id'])->delete();
		} else {
			$res->save($data);
		}

		if($res){
			$this->success('操作成功！');
		} else {
			$this->error('操作失败');
		}

	}


	public function save(){

		import("ORG.Net.UploadFile");
		$upload = new UploadFile();

		$upload->maxSize = 1024 * 1024 * 2;  
		$upload->allowExts = explode(',', 'jpg,jpeg,gif,png');
		$upload->savePath  = './Public/slide/images/';  //保存路径
		$upload->thumb = false; //是否生成缩略图
		$upload->imageClassPath = 'ORG.Util.Image';
		$upload->thumbPrefix = 'b_,s_';  //缩略图文件后缀
		$upload->thumbMaxWidth = '600,120'; //缩略图最大宽度
		$upload->thumbMaxHeight = '600,120';
		$upload->saveRule = 'uniqid' ;//上传文件规则
		//$upload->thumbRemoveOrigin = false; //删除原图


		if(!$upload->upload()){
			//捕获上传异常
			//$this->error($upload->getErrorMsg());
			$imgs = '';

		}else{
			//取得成功上传的文件信息
			$uploadList = $upload->getUploadFileInfo();

			//添加水印
			//import('ORG.Util.Image');
			//Image::water($uploadList[0]['savepath'].'m_'.$uploadList[0]['savename'] ,'./Public/images/logo.png');


			$imgs = $uploadList[0]['savename'];
		}

		
		$data['title']   = I('title');
		$data['url']     = $_POST['url'];
		$data['classid'] = I('classid' ,1 ,'intval');
		$data['opx']     = I('opx' ,0 ,'intval');
		$data['status']  = I('status' ,0 ,'intval');


		


		$slide = M('Slide');

		if(I('action') == 'add'){
			$data['img1']  = $imgs;

			$res = $slide->data($data)->add();
		}else{
			$data['id'] = I('id' ,0 ,'intval');//intval($_GET['id']);
			if($imgs != '') $data['img1'] = $imgs; //判断有无重新上传图片
			$res = $slide->save($data);
		}

		
		if($res){
			$this->success('操作成功' ,U('Slide/index' ,'' ,''));
		}else{
			$this->error('操作失败');
		}

	}



}


?>