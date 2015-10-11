<?php
class AdminAction extends Action {
    public function index(){
		   //未登录调转到输入界面
		 if(session('username')==""){

				   $this->login();
			       exit;
		   }

		//$this->display('Public:menu');
		//$this->display('index', 'utf-8', 'text/xml');
		  $this->name=session('username');
		  $this->id=session('id');
		  $this->display('index');
    }

        /**
     * this function is used for export information of students
     *
     * @return void
     */
    public function subinfo()
    {
        $exam_port = M('kjj');
        $exam_factor = M('zygl');
        $students = M('ksbm');
        $ports = $exam_port->getField('bm_id, bm_name');
        $factors = $exam_factor->getField('bm_id, bm_name');
        $test = $students->field('bm_zy, bm_level, bm_kjj, bm_kszt,count(*)')->where('bm_kszt <> 2')->group('bm_zy, bm_level, bm_kjj, bm_kszt')->select();
        /*
         * var_dump($test);
         */
        $xlsName = "name";
        $xlsData = $test;
        $xlsCell  = array(
            array('bm_zy','zhuanye'),
            array('bm_level','dengji'),
            array('bm_kjj','kaodian'),
            array('bm_kszt','kaoshizhuangtai'),
            array('count(*)','shuliang')
        );
        $cellNum = count($xlsData);
        /*
         * var_dump($cellNum);
         */
        $xlsCell = $students->field('distinct(`bm_kjj`)')->where('bm_kszt <> 2')->select();
        $factors = $exam_factor->field('bm_name')->select();
        $this->myExportExcel($factors, $xlsName, $xlsCell, $xlsData);
        foreach ($ports as $port){
            foreach ($factors as $factor){
                for ($i = 1; $i <= 9; $i++) {
                    $base_sql = 'bm_kjj = "'. $port .'" AND bm_level = '. $i . ' AND bm_zy = "'. $factor . '"';
                    $wait_sql = $base_sql. ' AND bm_kszt = 0';
                    $result_sql = $base_sql. ' AND bm_kszt = 1';
                    /*
                     * $wait_students = $students->where($wait_sql)->count();
                     */
                    /*
                     * var_dump($wait_students);
                     */
                    /*
                     * var_dump($wait_sql);
                     * var_dump($wait_students);
                     */


                }
            }


        }
        return null;
    }
    public function myExportExcel($firstLine, $expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $xlsTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        $firstNum = count($firstLine);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1', '专业');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B1', '级别');

        /*
         * $objPHPExcel->getActiveSheet(0)->mergeCells('C1:'.$cellName[$cellNum-1].'1');//合并单元格
         */
        for($i=1;$i < $cellNum + 1;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[2 * $i].'1', $expCellName[$i - 1]['bm_kjj']. '(待考)');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[2 * $i + 1].'1', $expCellName[$i - 1]['bm_kjj']. '(评卷中)');
        }
        $k = 1;
        for($i=0;$i < $firstNum;$i++){
            for ($j = 0; $j < 9; $j++) {
                $k = $k + 1;
                $objPHPExcel->getActiveSheet(0)->setCellValue('A'.$k, $firstLine[$i]['bm_name']);
                $objPHPExcel->getActiveSheet(0)->setCellValue('B'.$k, $j + 1);

            }
        }
          // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$firstNum;$i++){
            for ($tmp = 0; $tmp < 9; $tmp++) {
                for($j=0;$j<$cellNum;$j++){
                    $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[2 * $j + 2].($i * 9 + $tmp + 2), 0);
                    $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[2 * $j + 3].($i * 9 + $tmp + 2), 0);
                    for ($allNum = 0; $allNum < $dataNum; $allNum++) {
                        if ($expTableData[$allNum]['bm_zy'] == $firstLine[$i]['bm_name'] &&
                            $expTableData[$allNum]['bm_level'] == $tmp + 1 &&
                            $expTableData[$allNum]['bm_kjj'] == $expCellName[$j]['bm_kjj']) {
                                if ($expTableData[$allNum]['bm_kszt'] == 0) {
                                    $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[2 * $j + 2].($i * 9 + $tmp + 2), $expTableData[$allNum]['count(*)']);
                                }
                                else {
                                    $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[2 * $j + 3].($i * 9 + $tmp + 2), $expTableData[$allNum]['count(*)']);
                                }
                        }
                    }
                }
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }




    /**
     +----------------------------------------------------------
     * Export Excel
     +----------------------------------------------------------
     * @param $expTitle     string File name
     +----------------------------------------------------------
     * @param $expCellName  array  Column name
     +----------------------------------------------------------
     * @param $expTableData array  Table data
     +----------------------------------------------------------
     */
    public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $xlsTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
          // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }



    public function save(){

        import("ORG.Net.UploadFile");
        $upload = new UploadFile();

        $upload->maxSize = 1024 * 1024 * 10;
        // $upload->rootPath = './Public/';
        $upload->savePath  =  './Public/downloads/';  //保存路径
        $upload->saveRule = 'uniqid' ;//上传文件规则


        if(!$upload->upload()){
            //捕获上传异常
            //res:(
// 上传目录/kaojizhongxin/Public/downloads/不存在
// 页面自动 跳转 等待时间： 2

            $this->error($upload->getErrorMsg());
            // $this->show($upload->getErrorMsg());
            $file = '';

        }else{
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
            $file = $uploadList[0]['savename'];
        }


        $data['title']   = I('title');
        // var_dump($_POST);
        // die(I('is_special'));
        $data['is_special'] = I('is_special');

         $date = new DateTime();
         $data['odate'] = $date->format("U");

        // $data['url']     = $_POST['url'];



        $Update = M('Update');

        if(I('action') == 'add'){
            $data['path']  = $file;
            $res = $Update->data($data)->add();
        }else{
            $data['id'] = I('id' ,0 ,'intval');//intval($_GET['id']);
            if($file != '') $data['path'] = $file; //判断有无重新上传图片
            $res = $Update->save($data);
        }


        if($res){
        	// $this->show('操作成功！');
            $this->success('操作成功');
        }else{
            var_dump(I('id'));
            print_r('-------------------------------');
            var_dump($Update);
                        print_r('-------------------------------');

            var_dump($data);
                        print_r('-------------------------------');

            var_dump($file);
            // $this->error('操作失败');
        }

    }

	public function login(){

			//如果已登录直接跳转
			 if(session('username')){
				$this->index();
				exit;
				}
			//提交检测，如果正确调整到登录页面
		  if($_GET['action']==1){
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			//echo $username.$password;
			$Data     = M('bm_admin');
			//echo "name=\"$username\" AND password=\"$password\"";

			if($user=$Data->where("name=\"$username\" AND password=\"$password\"")->select()){
				        // print_r($user);
				         session('username',$user[0]['name']);
					     session('zt',$user[0]['zt']);
						 session('kjj_id',$user[0]['kjj_id']);
						 session('id',$user[0]['id']);
					   // print_r($_SESSION);
					   $this->index();
					   exit;


			}else{
				$this->h="密码错误请重新填写" ;
			};
			//print_r($user);
			//echo "dddddd";


	    }

		$this->display('login');

	}
	//退出
	public function bm_quit(){
		  session(null);
		  $this->login();
	}

	public function  cb_add(){

		 $Kjj   =   D('Kjj');
        if($Kjj->create()) {
            $result =   $Kjj->add();
            if($result) {
                $this->show('操作成功！');
            }else{
                $this->show('写入错误！');
            }
        }else{
            $this->error($Kjj->getError());
        }
			//$this->show("添加成功");

		}
		//考级更新画面
		public function  cb_update(){
		 $id=$this->_get("id");
		 $Kjj   =   M('Kjj');
		 $list = $Kjj->where('bm_id='.$id)->select();
		 //$this->show(print_r($list));
		 $this->data= $list;
         $this->display('cb_show');


		}
		//考生报名更新
		public function  ksbm_update(){

            $id=$this->_get("id");
            $stu_info = D('ksbm')->where("id=".$id)->select();
            $stu_info = $stu_info[0];
            $stu_status = $stu_info['bm_kszt'];
            $exam_id = $stu_info['kshd_id'];
            $exam_info = D('kshd')->where("bm_id=".$exam_id)->select();
            $exam_info = $exam_info[0];
            $exam_ison = $exam_info['on_off'];
            $exam_time = $exam_info['ks_time'];
            $event_start_time = $exam_info['k_time'];
            $event_end_time = $exam_info['j_time'];

            if ($_SESSION['zt'] == 2 && ($stu_status != 0 or $exam_ison == 'false' or strtotime($exam_time) > strtotime($event_end_time) or strtotime($exam_time) < strtotime($event_start_time))) {
            # code...
            // $this->show($exam_id);
                $this->show("考生资料已确认，无法修改。如需修改请联系福建考级中心。");
            }
            else
            {
                $Zygl   =   M('Zygl');
             $list1 = $Zygl->select();

             $ksbm   =   M('ksbm');
             $list = $ksbm->where('id='.$id)->select();
             $kjj  =M('kjj');
             $list2=$kjj->where('bm_id='.$list[0]['bm_kjj_id'])->select();
             //$this->show(print_r($list));
            // print_r($list2);
             $this->data=$list1;
             $this->data2=$list2;
             $this->data3= $list[0];
             $this->display('ksbm_update');
            }

		}
	//考生报名确认
	public function kshd_update_ac(){

		$ksbm =D("ksbm");
         if($ksbm->create()) {
        		$result =   $ksbm->save();
        		if($result) {
            		$this->success('操作成功！');
        		}else{
            		$this->error('写入错误！');
        		}
    		}else{
        		$this->error($ksbm->getError());
    		}


	}

		//考级更新数据
		public function  cb_update_ac(){
			$Kjj = D("Kjj"); // 实例化User对象
			 // 根据表单提交的POST数据创建数据对象
			 if($Kjj->create()) {
        		$result =   $Kjj->save();
        		if($result) {
            		$this->success('操作成功！');
        		}else{
            		$this->error('写入错误！');
        		}
    		}else{
        		$this->error($Kjj->getError());
    		}


		}

	//报考专业更新画面
		public function  zy_update(){
		 $id=$this->_get("id");
		 $Zygl   =   M('Zygl');
		 $list = $Zygl->where('bm_id='.$id)->select();
		 //$this->show(print_r($list));
		 $this->data= $list;
         $this->display('zy_show');
		}

	//报考专业更新数据
		public function  zy_update_ac(){
			$Zygl = D("Zygl"); // 实例化User对象
			 // 根据表单提交的POST数据创建数据对象
			 if($Zygl->create()) {
        		$result =   $Zygl->save();
        		if($result) {
            		$this->success('操作成功！');
        		}else{
            		$this->error('写入错误！');
        		}
    		}else{
        		$this->error($Zygl->getError());
    		}
		}

	//考试活动更新画面
		public function  ks_update(){
		 $id=$this->_get("id");
		 $kshd   =   M('kshd');
		 $list = $kshd->where('bm_id='.$id)->select();
		 //$this->show(print_r($list));
		 $this->data1= $list;
		// print_r($list);
		 $this->ks_show();
        // $this->display('ks_show');
		}

	//考试活动更新数据
		public function  ks_update_ac(){
			$kshd = D("kshd"); // 实例化User对象
			 // 根据表单提交的POST数据创建数据对象
			 if($kshd->create()) {
        		$result =   $kshd->save();
        		if($result) {
            		$this->success('操作成功！');
        		}else{
            		$this->error('写入错误！');
        		}
    		}else{
        		$this->error($kshd->getError());
    		}
		}

	//专业添加
	public function  zy_add(){

		 $Zygl   =   D('Zygl');
        if($Zygl->create()) {
            $result =   $Zygl->add();
            if($result) {
                $this->show('操作成功！');
            }else{
                $this->show('写入错误！');
            }
        }else{
            $this->error($Zygl->getError());
        }
			//$this->show("添加成功");

		}
	//考试活动添加
	public function  ks_add(){
		 $Kshd   =   D('Kshd');
        if($Kshd->create()) {
            $result =   $Kshd->add();
            if($result) {
                $this->show('操作成功！');
            }else{
                $this->show('写入错误！');
            }
        }else{
            $this->error($Kshd->getError());
        }
			//$this->show("添加成功");

		}
	//用户名添加
	public function  admin_add(){
		    $Bm_admin   =   D('Bm_admin');
        if($Bm_admin->create()) {
            $result =   $Bm_admin->add();
            if($result) {
                $this->show('操作成功！');
            }else{
                $this->show('写入错误！');
            }
        }else{
            $this->error($Bm_admin->getError());
        }
			//$this->show("添加成功");

		}
	//用户名修改
	public function  admin_xg(){
		    $Bm_admin   =   D('Bm_admin');
        if($Bm_admin->create()) {
            $result =   $Bm_admin->save();
            if($result) {
                $this->show('操作成功！');
            }else{
                $this->show('写入错误！');
            }
        }else{
            $this->error($Bm_admin->getError());
        }
			//$this->show("添加成功");

		}
	//用户修改页面
		public function  bm_admin_xg(){
		$id=$this->_get("id");
		$Bm_admin = M('Bm_admin'); // 实例化Data数据模型
        $this->data = $Bm_admin->where("id=$id")->select();
		//print_r($this->data);
		$this->display('bm_admin_xg');
	}
	//用户查看
	public function  bm_admin_select(){
		$Bm_admin = M('Bm_admin'); // 实例化Data数据模型
        $this->data = $Bm_admin->select();
		$this->display('bm_admin_select');
	}
	public function  cb_select(){

		$Kjj = M('Kjj'); // 实例化Data数据模型
        $this->data = $Kjj->select();
		$this->display('cb_select');

	}
	//会员管理 考点编号 显示
	public function  bm_admin_show(){

		$Kjj = M('Kjj'); // 实例化Data数据模型
        $this->data = $Kjj->select();
		$this->display('bm_admin_show');

	}

	public function  zy_select(){

		$Zygl = M('Zygl'); // 实例化Data数据模型
        $this->data = $Zygl->select();
		$this->display('Zy_select');

	}
	//考试状态显示
	public function  ks_select(){

		$Kshd = D('Kshd'); // 实例化Data数据模型
       // $this->data = $Kshd->select();
		$list = $Kshd->relation(true)->Select();
		 $this->data=$list;
		//$this->show(print_r($list));
		$this->display('ks_select');

	}
	public function  bm_dele(){
		$name = $this->_post('name');
		$id	  =	$this->_post('id');
		$name1 = M($name);
        $stu_info = D('ksbm')->where("id=".$id)->select();
        $stu_info = $stu_info[0];
        $stu_status = $stu_info['bm_kszt'];
        $exam_id = $stu_info['kshd_id'];
        $exam_info = D('kshd')->where("bm_id=".$exam_id)->select();
        $exam_info = $exam_info[0];
        $exam_ison = $exam_info['on_off'];
        $exam_time = $exam_info['ks_time'];
        $event_start_time = $exam_info['k_time'];
        $event_end_time = $exam_info['j_time'];
        // var_dump($_SESSION);
        // var_dump($exam_info);
        if ($_SESSION['zt'] == 2 && ($stu_status != 0 or $exam_ison == "false" or strtotime($exam_time) > strtotime($event_end_time) or strtotime($exam_time) < strtotime($event_start_time))) {
            # code...
            // $this->show($exam_id);
            $this->show("alert('考生资料已确认，无法删除。如需删除请联系福建考级中心。');");
        }
		else if($name1->delete($id)){
				if($name=="Kjj"){
					$this->show("alert('删除成功');bm_load('cb_select');");
				}elseif($name=="Zygl"){
					$this->show("alert('删除成功');bm_load('zy_select');");
				}elseif($name=="kshd"){
					$this->show("alert('删除成功');bm_load('ks_select');");
				}elseif($name=="ksbm"){
					$this->show("alert('删除成功');bm_load('ksbm_select');");
				}elseif($name=="bm_admin"){
					$this->show("alert('删除成功');bm_load('bm_admin_select');");
				}
			}
        else{
			$this->show("alert('删除失败');");
		}


	}

           public function  port_update_exam(){
         $id=$this->_get("id");
         $kshd   =   M('kshd');
         $list = $kshd->where('bm_id='.$id)->select();
         //$this->show(print_r($list));
         $this->data1= $list;
        // print_r($list);
         $this->port_edit_exam();
        // $this->display('ks_show');
        }

            public function  port_edit_exam(){
        $Kjj = M('Kjj'); // 实例化Data数据模型
        $this->data = $Kjj->select();
        $this->display('port_edit_exam');
    }
    public function port_show_exam()
    {
        # code...
        $id=session("kjj_id");
        // var_dump($_SESSION);
        // echo $id;
        // echo $id;
         $kshd   =   M('kshd');
         $kshd_where = "kjj_id =".$id;
         $list = $kshd->where($kshd_where)->select();
         //$this->show(print_r($list));
         $this->data1= $list;
        // var_dump($list);
         $this->display('port_show_exam');

        // $Kjj = M('kshd');
        // $bm_where.='bm_kjj_id = '.session('kjj_id');
    }
	//修改
	public function  bm_xg(){
		$mima = $this->_post('value1');
		$id	  =	$this->_post('id');
		$name1 = M("bm_admin");
		$data['password'] = md5($mima);
		$name1->where("id=$id")->save($data);
		$this->bm_admin_select();
	}

	//考试时间添加
	public function  ks_show(){

		$Kjj = M('Kjj'); // 实例化Data数据模型
        $this->data = $Kjj->select();
		$this->display('ks_show');

	}
	//考试报考表格打印
	public function ksbm_bg(){

		$Kjj = M('Kjj');
		$id	 =	I("post.id");
        $this->kd = $Kjj->select();
		$Zygl = M('Zygl');
		 $bm_where=session('bm_where');
		$bm_where=stripslashes($bm_where)."";

		if(session('kjj_id')==0){
			$bm_where.=' id<>0 ';
		}else{
			$bm_where.='bm_kjj_id = '.session('kjj_id');
		}
		if($id!=""){
			$bm_where.=" and id in ($id)";
		}
		//print_r($bm_where);
		$ksbm = M('ksbm'); // 实例化Data数据对象



		$list = $ksbm->where($bm_where)->order('bm_zy,bm_level desc')->select();
		//print_r($list);
    	$this->assign('data',$list);// 赋值数据集

    	$this->display("ksbm_bg"); // 输出模板
	}
	//考试报考资料show
	public function ksbm_select(){
		$bm_where=$this->_post("bm_where",false);
		if(isset($_POST["bm_where"])){
		 session('bm_where',$this->_post("bm_where",false));
		 }
		 $bm_where=session('bm_where');
		$bm_where=stripslashes($bm_where)."";
		//print_r($bm_where);
		$Kjj = M('Kjj');
        $this->kd = $Kjj->select();
		$Zygl = M('Zygl');
        $this->zy = $Zygl->select();
		if(session('kjj_id')==0){
			$bm_where.=' id<>0 ';
		}else{
			$bm_where.='bm_kjj_id = '.session('kjj_id');
		}

		$ksbm =D('ksbm'); // 实例化Data数据对象
    	import('ORG.Util.Page');// 导入分页类
    	//$count      = $Data->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件

		// echo $bm_where;
		//$bm_where="bm_time >= '2014-04-16' and id<>0";
		$count      = $ksbm->where($bm_where)->count();
		//print_r($count);
    	$Page       = new Page($count,30);// 实例化分页类 传入总记录
		//$Page->setConfig('theme',"%totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first% %prePage% %linkPage% %nextPage% %end%");
		$show       = $Page->show();// 分页显示输出
    	//$list = $Data->where($map)->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		//print_r(session('kjj_id'));
	$list = $ksbm->relation('kjj')->where($bm_where)->order('bm_zy,bm_level desc')->limit($Page->firstRow.','.$Page->listRows)->select();
	//print_r($list);
    	$this->assign('data',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->display("ksbm_select"); // 输出模板
	}
	//导出xml
	public function ksbm_xml(){
		//对应表


		header("Content-Disposition: attachment;filename=zl".date("Y-m-d").".xml");
	     $mz=array('汉族'=>1,'蒙古族'=>2,'回族'=>3,'藏族'=>4,'维吾尔族'=>5,'苗族'=>6,'彝族'=>7,'壮族'=>8,'布依族'=>9,'朝鲜族'=>10,'满族'=>11,'侗族'=>12,'瑶族'=>13,'白族'=>14,'土家族'=>15,'哈尼族'=>16,'哈萨克族'=>17,'傣族'=>18,'黎族'=>19,'傈僳族'=>20,'佤族'=>21,'畲族'=>22,'高山族'=>23,'拉祜族'=>24,'水族'=>25,'东乡族'=>26,'纳西族'=>27,'景颇族'=>28,'柯尔克孜族'=>29,'土族'=>30,'达斡尔族'=>31,'仫佬族'=>32,'羌族'=>33,'布朗族'=>34,'撒拉族'=>35,'毛南族'=>36,'仡佬族'=>37,'锡伯族'=>38,'阿昌族'=>39,'普米族'=>40,'塔吉克族'=>41,'怒族'=>42,'乌孜别克族'=>43,'俄罗斯族'=>44,'鄂温克族'=>45,'德昂族'=>46,'保安族'=>47,'裕固族'=>48,'京族'=>49,'塔塔尔族'=>50,'独龙族'=>51,'鄂伦春族'=>52,'赫哲族'=>53,'门巴族'=>54,'珞巴族'=>55,'基诺族'=>56,'其它未识别民族'=>97,'外国人入中国籍'=>98);
		 $zy=array('人物'=>030101,'山水'=>030102,'花鸟'=>030103,'漫画'=>0304,'软笔书法'=>030801,'硬笔书法'=>030802,'素描'=>031901,'速写'=>031902,'水粉画'=>031903,'水彩画'=>031904,'油画'=>031905,);
		 $ksbm   =   D('ksbm');
		 $id1	  =	$this->_get('id');
		 if($id1!=""){
			 $wh="id in ($id1)";
			 }else{
			  $wh=session('bm_where');
			  $wh.=' id<>0 ';

				 }
			$wh=stripslashes($wh);
			//print_r($wh);

		 $list = $ksbm->relation('zygl')->where("$wh")->order('bm_zy,bm_level desc')->select();
		  //print_r($list);
		 $xml='<?xml version="1.0" standalone="yes"?>'."\n";
		 $xml.='<NewDataSet xmlns="ImportStudent">'."\n";
		 $i=13;
		foreach($list as $value){
			if($i<100){
				$ii="00".$i."";
				$iii="00".($i-13)."";
				}else if($i<1000){
				$ii="0".$i."";
				$iii="0".($i-13)."";
				}else if($i==9999){
				$i=13;
				}else{
				$ii=$i;
				$iii=($i-13);
				}
				//print_r($value['bm_sex']);
			if($value['bm_sex']==0){
				$sex="男";
				}else{
				$sex="女";
					}

				foreach($mz as $key=> $va){
					if($value['bm_mz']==$key)$mz1=$va;
					}
			$value['zygl']['bm_bm']=trim($value['zygl']['bm_bm']);
		$xml.="
	<Student>\n
    <StudentID>$ii</StudentID>\n
    <StudentName>{$value['bm_name']}</StudentName>\n
    <StudentPY>{$value['bm_py']}</StudentPY>\n
    <Sex>{$value['bm_sex']}</Sex>\n
    <SexDes>$sex</SexDes>\n
    <Nation>$mz1</Nation>\n
    <NationName>{$value['bm_mz']}</NationName>\n
    <Birthday>{$value['bm_csdate']}</Birthday>\n
    <CountryNo>CN</CountryNo>\n
    <CountryName>中国</CountryName>\n
    <PostCode />\n
    <Address />\n
    <ImportStatus>末导出</ImportStatus>\n
    <OrgNo>001007009</OrgNo>\n
    <RegId>$iii</RegId>\n
    <SubjectNo>0{$value['zygl']['bm_bm']}</SubjectNo>\n
    <SubjectName>{$value['bm_zy']}</SubjectName>\n
    <Level>{$value['bm_level']}</Level>\n
  	</Student>\n";

			$i++;

			}
		header('Content-Type: text/xml');
		echo $xml.'</NewDataSet>';
	}
	//待考已考修改
	public function ksbm_kszt(){
		//对应表

		 $ksbm   =   D('ksbm');
		 $id1	  =	$this->_post('id');
		 $kszt	  =	$this->_post('bm_kszt');
		// print_r($id1);
		 if($id1!=""){
			 $wh="id in ($id1)";
			 }else{
			  $wh=session('bm_where');
			  $wh.=' id<>0 ';

				 }
			$wh=stripslashes($wh);
			 // print_r($wh);
			$data['bm_kszt'] = $kszt;
			$ksbm->where($wh)->save($data);
			$this->ksbm_select();
		 //$list = $ksbm->relation('zygl')->where("$wh")->order('bm_zy,bm_level desc')->select();


	}

	//打印报表
	public function ksbm_dy(){
		 $id=$this->_get("id");
		// $id	 =	I("post.id");
		 // $ksbm   =   M('ksbm');
		 // $list = $ksbm->where('id='.$id)->select();

		 // $this->data=$list[0];
         $ksbm   =   D('ksbm');
        // print_r(I('post.'));

        // $id	 =	I("post.id");
         $list = $ksbm->relation('kshd')->where("id in ($id)")->order('bm_zy,bm_level desc')->select();
         // print_r($list);exit;
         $this->data=$list;
		 $this->display("ksbm_dy"); // 输出模板


		}
		public function ksbm_dyb(){
		 // $id=$this->_get("id");
		$id	 =	I("post.id");
		 // $ksbm   =   M('ksbm');
		 // $list = $ksbm->where('id='.$id)->select();

		 // $this->data=$list[0];
         $ksbm   =   D('ksbm');
        // print_r(I('post.'));

        // $id	 =	I("post.id");
         $list = $ksbm->relation('kshd')->where("id in ($id)")->order('bm_zy,bm_level desc')->select();
         // print_r($list);exit;
         $this->data=$list;
		 $this->display("ksbm_dy"); // 输出模板


		}

	public function ksbm_dybc(){

		 $ksbm   =   D('ksbm');
		// print_r(I('post.'));
		 $id	 =	I("post.id");


		 $list = $ksbm->relation('kshd')->where("id in ($id)")->order('bm_zy,bm_level desc')->select();
		 // print_r($list);
		 $this->data=$list;
		 // print_r($list);
		$this->display("ksbm_dyb"); // 输出模板

		}

		/*public function cl999(){
		  $ksbm   =   M('ksbm');
		 $list = $ksbm->where("bm_cell='MA0999' and bm_kjj_id=12")->select();
		   $co=100;
		 foreach ($list as $value) {
		// print_r($co++);
		 $data['bm_cell'] = 'MA0'.($co++);
		 //print_r($data);
		$ksbm->where('id='.$value['id'])->save($data); // 根据条件保存修改的数据



		 }


		}
		*/
}
