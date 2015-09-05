<?php
// 本类由系统自动生成，仅供测试用途
class HomeAction extends Action {
    public function index(){
		
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
		$this->data=$list;
		//$this->data1=$list;
		if($list){
			$this->bmb_sele($data,$bm_bm);
			
		}
		//$this->show(print_r($list));
		//$this->display('ks_select');
	}
	public function bmb_sele($data,$bm_bm){
		//print_r($bm_bm);
		 $Zygl   =   M('Zygl');
		 $list = $Zygl->select();
		 //$this->show(print_r($list));
		 $this->data  = $list;
		 $this->data1 = $data;
		 $this->data2 = $bm_bm;
		 $this->data3 = $this->_post();
		 //print_r($this->_post());
		// print_r($list);
		 $this->display('bmb_sele');
			
	}
	public function kshd_qr(){
           $this->kshd_qr_sele($this->_post());
	}
	//确认页面显示
	public function kshd_qr_sele($bm_post){
		     // print_r($bm_post);
			 $this->data1= json_encode($bm_post);
		     $this->data = $bm_post;
			 $this->display('kshd_qr_sele');
		}
	//打印页面显示，并储存	
	public function kshd_dy(){
			
		$ksbm =D("ksbm");
        if($ksbm->create()) {
            $result =   $ksbm->add();
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