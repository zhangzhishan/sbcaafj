<?php


Class ProductAction extends CommonAction{

	public function index(){


		$classid = $this->_get('classid');
		if(!is_numeric($classid)) $classid = 0;

		//获取产品类别
	  	$pro_cate = M('cate')->where(array('classid'=>$classid))->field('id ,title ,parentid ,status ,opx')->order('opx')->select();

	  	$new_cate = get_rearray($pro_cate);


	  	// p($new_cate);
	  	// die;


	  	$this->classid = $classid;
	  	$this->assign('pro_cate',$new_cate);
	    $this->assign('curpage' ,I('action'));

		if(I('action') == 'add'){
	  		$this->display('add');
	  	} elseif (I('action') == 'edit') {

	  		$id = I('id' ,0 ,'intval');
	  		$Product = M('Product');
	  		$pro = $Product->where('id='.$id)->field('id ,title ,img1 ,cateid ,status ,ischeck1 ,text')->find();

	  		$this->assign('pro',$pro);
	  		$this->display('edit');	
	  	}else{

	  		$Product = M('Product');
	  		//$list = $Product->field('id ,title ,img1 ,cateid ,status ,odate ,ischeck1')->order('id desc')->select();


	  		import('ORG.Util.Page');
			$count = $Product->where(array('classid'=>$classid))->count();
			$Page = new Page($count ,C('PAGECOUNT'));
			$show = $Page->show();

			$list = $Product->where(array('classid'=>$classid))->field('id ,title ,img1 ,cateid ,status ,odate ,ischeck1')->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();	


	  		$this->assign('list',$list);
	  		$this->assign('page' ,$show);
			$this->assign('pagecount' ,$count);

	  		$this->display();
	  	}


	}



	Public function handle(){

		$res = M('Product');
		
		$data['id'] = I('id' ,0 ,'intval');
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
		$upload->savePath  = './Public/uploads/';  //保存路径
		$upload->thumb = true; //是否生成缩略图
		$upload->imageClassPath = 'ORG.Util.Image';
		$upload->thumbPrefix = 'b_,s_';  //缩略图文件后缀
		$upload->thumbMaxWidth = '600,120'; //缩略图最大宽度
		$upload->thumbMaxHeight = '600,120';
		$upload->thumbType = 0;
		$upload->saveRule = 'uniqid' ;//上传文件规则
		$upload->thumbRemoveOrigin = false; //删除原图


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

		$classid = $this->_get('classid');
		if(!is_numeric($classid)) $classid = 0;


		$data['title']    = I('title');
		$data['ischeck1'] = I('ischeck1' ,0 ,'intval');
		$data['text']     = $_POST['text'];
		$data['status']   = I('status' ,0 ,'intval');
		$data['cateid']   = $_POST['cateid'] . '|';


		$Product = M('Product');

		if(I('action') == 'add'){
			$data['img1']  = $imgs;
			$data['odate'] = time();
			$data['classid'] = $classid;

			$res = $Product->data($data)->add();
		}else{
			$data['id'] = I('id' ,0 ,'intval');//intval($_GET['id']);
			if($imgs != '') $data['img1'] = $imgs; //判断有无重新上传图片
			$res = $Product->save($data);
		}
		
		if($res){
			$this->success('操作成功' ,U('Product/index' ,array('classid'=>$classid)));
		}else{
			$this->error('操作失败');
		}

	}
}


?>