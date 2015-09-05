<?php

Class KaojixixiAction extends CommonAction {

	Public function index(){


		//phpinfo();

		$kaojixixi = M('Kaojixinxi');
		$list = $kaojixixi -> select();

		import('ORG.Util.Page');
			
		$count = $kaojixixi->count();
		$Page = new Page($count ,C('PAGECOUNT'));
		$show = $Page->show();

		//$list = $res->where('classid=2')->order('id desc')->select();
		$list = $kaojixixi->limit($Page->firstRow . ',' . $Page->listRows)->select();
		
		$this->assign('list' ,$list);
		$this->assign('page' ,$show);
		$this->assign('pagecount' ,$count);


		$this->display('index');

	}
//修改
Public function update(){
		
		
		$list = M('Kaojixinxi')->where("id=".$_GET['id'])->select();
		//print_r($list);
		$this->assign('list' ,$list[0]);
		$this->display();

	}
	Public function update_ac(){
		//print_r($_POST['date']);
		$data = array(
					'code' => $_POST['code'],
					'name' => $_POST['name'],	
					'sex'  => $_POST['sex'],
					'date' => strtotime($_POST['date']),
					'national'    => $_POST['national'],
					'cate'        => $_POST['cate'],
					'level'       => $_POST['level'],
				);
				$User = M("Kaojixinxi"); // 实例化User对象
				$User->where('id='.$_POST['id'])->save($data); // 根据条件保存修改的数
				//$this->display("index");
				$this->index();
				//print_r($User);
		

	}

	public function delete(){

		$idlist = $this->_post('idlist');
		$flag = $this->_get('flag');

		

		if($flag == 'all'){
			$kaojixinxi = M('Kaojixinxi')->where('id>0')->delete();
		}else{
			$kaojixinxi = M('Kaojixinxi')->delete($idlist);
		}
		

		if($kaojixinxi){
			$this->success('删除成功！');
		}else{
			$this->error('删除失败');
		}
	}

	Public function importexcel(){

		// echo __ROOT__ . '/' . APP_NAME;
		// die;
		//import('ExcelToArray' ,__ROOT__ . '/' . APP_NAME . '/Lib/Extend/' ,'php');	



		// //import('ORG.Util.ExcelToArray');
		// import('@.Extend.ExcelToArray');

		// $excelUrl = 'E:\web\PHP\xampp\htdocs\20131015xmmsxy\Public\11111.xlsx';

		// $filetype = "xlsx";
		// $ExcelToArray=new ExcelToArray();//实例化 

		// $res=$ExcelToArray->read($excelUrl,"UTF-8",$filetype); 
		// die;


		// echo $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . '/Public/'   .'<br>';
		// echo dirname(S_);
		// die;




		 $btnname = $_POST['search'];


		 //echo 'btnname===' .$btnname;

		 if($btnname == '搜索'){

		 	$name = trim($_POST['name']);
			$code = trim($_POST['code']);
			$cate = trim($_POST['cate']);
			$date = strtotime(trim($_POST['date']));
			$level = trim($_POST['level']);
			if($name!=""){
				$where="name like '%{$name}%' and ";
			}
			if($code!=""){
				$where.="code=$code and ";
			}
				if($cate!=""){
				$where.="cate like '%{$cate}%' and ";
			}
				 if($date!=""){
				$where.="date=$date and ";
			}
			if($level!=""){
				$where.="level=$level and ";
			}
				$where.="id!=''";
			//print_r($where);
		 	if(strlen($where) > 0){
				
		 		//$where = "name like '%". $keyword ."%'  or cate like '%1%' or result like '%1%'";
				//$where = "code=0072005000718";

		 		$list = M('Kaojixinxi')->where($where)->select();
		 		$this->assign('list' ,$list);
				$this->assign('where' ,$_POST);
				//print_r($list);
		 		$this->display("index");
				

		 	}
		 	die;
		 }
		


		//导入excel
		if(!empty($_FILES ['file_stu']['name'] )){

			$tmp_file = $_FILES ['file_stu']['tmp_name'];
			$file_types = explode ( ".", $_FILES ['file_stu']['name'] );
			$file_type  = $file_types[count ( $file_types ) - 1];	

			$file_name = $_FILES ['file_stu']['name'];
			
			//echo $tmp_file . '------'.$_FILES ['file_stu']['name'];	
			//die;

			/*判别是不是.xls文件，判别是不是excel文件*/
			if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls"){
				$this->error ( '不是Excel文件，重新上传' );
			}

			/*设置上传路径*/
     		$savePath = $_SERVER['DOCUMENT_ROOT'] . __ROOT__ . '/Public/upfile/Excel/';   //无法自己创建目录
     		$rename = '123.' . $file_type;	
     		// echo $savePath;
     		// die;	

     		 /*是否上传成功*/
			if (!copy ( $tmp_file, $savePath . $rename )) {
				$this->error ( '上传失败' );
			}


			$excelUrl = $savePath . $rename;
			// echo $excelUrl;	

			//$filetype = "xlsx";

			import('@.Extend.ExcelToArray');
			$ExcelToArray=new ExcelToArray();//实例化 

			$res=$ExcelToArray->read($excelUrl,"UTF-8",$file_type); 

			//dump($res);
			//die;


			//导入数据库
			$data = array();
			foreach ($res as $key => $value) {

				$sex = '0';
				if($value[2] == '女') $sex = '1';
				


				$data[] = array(
					'code' => $value[0],
					'name' => $value[1],	
					'sex'  => $sex,
					'date' => strtotime($this->exceltimtetophp ($value[3])),
					'national'    => $value[4],
					'cate'        => $value[5],
					'level'       => $value[6],
					'result'      => $value[7],
					'create_time' => time()
				);

			}

			// p($data);
			// die;

			$kaojixixi = M('Kaojixinxi')->addAll($data);


			if( $kaojixixi ){
				$this->success('导入成功');
			} else {
				$this->error('导入失败');
			}
			

		}

	}



function exceltimtetophp($days,$time=false)
{
	 if(is_numeric($days))
	 {
	  $jd = GregorianToJD(1, 1, 1970);
	  $gregorian = JDToGregorian($jd+intval($days)-25569);
	  $myDate = explode('/',$gregorian);
	  $myDateStr = str_pad($myDate[2],4,'0', STR_PAD_LEFT)."-".str_pad($myDate[0],2,'0', STR_PAD_LEFT)."-".str_pad($myDate[1],2,'0', STR_PAD_LEFT).($time?" 00:00:00":'');
	  return $myDateStr;
	 }
	 return $time;
}



}


?>