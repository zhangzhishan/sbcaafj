<?php
// 本类由系统自动生成，仅供测试用途
class HomeAction extends Action {
    public function index(){
	    // $info = '测试信息';
       //trace($info,'提示ddddddd');
	    if($this->_get("act")==1){
	   		$this->data=$this->_cookie("act");
		}
		  //print_r($this->_cookie());
		  //print_r($this->data);
		$this->display("index");
    }
	public function kshd_sele(){
		$Kshd = D('Kshd'); // 实例化Data数据模型
		$Kjj = D('Kjj'); // 实例化Data数据模型
       	// $this->data = $Kshd->select();
		$bm_bm=$this->_post("bm_bm");
		//print_r($bm_bm);
		$data= $Kjj->where("bm_bm=$bm_bm")->Select();
		
		$bm_date=date('Y-m-d');
		$list = $Kshd->where("kjj_id={$data[0]['bm_id']} and k_time<='$bm_date' and j_time>='$bm_date' and on_off='true' ")->Select();
	     // print_r($list);
		$this->data=$list;
		//$this->data1=$list;
		if($list){
			$this->bmb_sele($data,$bm_bm,$list);
			
		}
		//$this->show(print_r($list));
		//$this->display('ks_select');
	}
	public function bmb_sele($data,$bm_bm,$list1){
		//print_r($bm_bm);
        $Kshd = D('Kshd'); // 实例化Data数据模型    //
		 $Zygl   =   M('Zygl');
		 $list = $Zygl->select();
		 //$this->show(print_r($list));
		 $arr1="汉族、蒙古族、回族、藏族、维吾尔族、苗族、彝族、壮族、布依族、朝鲜族、满族、侗族、瑶族、白族、土家族、哈尼族、哈萨克族、傣族、黎族、僳僳族、佤族、畲族、高山族、拉祜族、水族、东乡族、纳西族、景颇族、柯尔克孜族、土族、达斡尔族、仫佬族、羌族、布朗族、撒拉族、毛南族、仡佬族、锡伯族、阿昌族、普米族、塔吉克族、怒族、乌孜别克族、俄罗斯族、鄂温克族、德昂族、保安族、裕固族、京族、塔塔尔族、独龙族、鄂伦春族、赫哲族、门巴族、珞巴族、基诺族、其它未识别民族、外国人入中国籍";
		 $arr1=explode("、",$arr1);
		// print_r($arr1);
		 $this->arr1  =$arr1 ;
		 $this->data  = $list;
		 $this->data1 = $data;
		 $this->data4 = $list1;
		 $this->data2 = $bm_bm;
		 $this->data3 = $this->_post();
         // print_r($this->data3);
		  setcookie("act",$bm_bm,time()+336000,"/") ;
		// print_r($this->_cookie());
		  //$this->_cookie("act")=$bm_bm;
		 //print_r($this->_post());
		// print_r($list);
		 $this->display('bmb_sele');
			
	}
	public function kshd_qr(){
        $Kshd = D('Kshd'); 
        // var_dump($this->_post());
        $data['ks_time'] = $this->_post('ks_time');
        $result = $Kshd->where("bm_id={$this->_post('kshd_id')}")->save($data);
        // echo $result;
        // var_dump($data);
        // if ($result != '') {
            $this->kshd_qr_sele($this->_post());
            $_SESSION['cf']=1;

        //     # code...
        // }
        // else{
        //     $Kshd->getError();
        // }
        
        // $name1->where("id=$id")->save($data);
           
	}
	//确认页面显示
	public function kshd_qr_sele($bm_post){
		     // print_r($bm_post);
			 $this->data1= json_encode($bm_post);
		     $this->data = $bm_post;
			 $this->display('kshd_qr_sele');
		}
	//打印页面显示，并储存	

	public function myprint(){

		if( $_SESSION['cf']==1){
			  $_SESSION['cf']=2;
			 
			}else{
			  $this->data =$this->_post();
			  // print_r($this->data);
              $this->display('myprint');
			return;
			
			}
		$ksbm =D("ksbm");
        if($ksbm->create()) {
			//print_r($ksbm);
			
            $result =   $ksbm->add();

            if($result) {
				//print_r($this->_post());
				 $this->data =$this->_post();
				 $list = $ksbm->relation('kshd')->where("id = ($result)")->order('bm_zy,bm_level desc')->select();
				 $this->data = $list;
                // var_dump($this->data);
                 $this->display('myprint');
            }else{
                //$this->show('写入错误！');
            }
        }else{
            //$this->error($ksbm->getError());
        }

		
		
	}


        public function kshd_dy(){
            if( $_SESSION['cf']==1){
              $_SESSION['cf']=2;
             
            }else{
              $this->data =$this->_post();
              $this->display('kshd_dy');
            return;
            
            }
        $ksbm =D("ksbm");
        if($ksbm->create()) {
            //print_r($ksbm);
            
            $result =   $ksbm->add();
            // print_r($result);
            if($result) {
                //print_r($this->_post());
                 $this->data =$this->_post();
                 $this->display('kshd_dy');
            }else{
                //$this->show('写入错误！');
            }
        }else{
            //$this->error($ksbm->getError());
        }
        
        
    }
		  
}