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
		  $this->display('index');
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
			$Zygl   =   M('Zygl');
		 $list1 = $Zygl->select();
		 $id=$this->_get("id");	
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
		if($name1->delete($id)){
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
			}else{
			$this->show("alert('删除失败');");				
		}
		
		
	}
	//考试时间添加
	public function  ks_show(){
		
		$Kjj = M('Kjj'); // 实例化Data数据模型
        $this->data = $Kjj->select();
		$this->display('ks_show');
		
	}
	//考试报考资料show
	public function ksbm_select(){
		$bm_where=$this->_post("bm_where");
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
		print_r($bm_where);
		$ksbm = M('ksbm'); // 实例化Data数据对象
    	import('ORG.Util.Page');// 导入分页类
    	//$count      = $Data->where($map)->count();// 查询满足要求的总记录数 $map表示查询条件
		
		$count      = $ksbm->where($bm_where)->count();
    	$Page       = new Page($count,30);// 实例化分页类 传入总记录
		//$Page->setConfig('theme',"%totalRow% %header% %nowPage%/%totalPage% 页 %upPage% %downPage% %first% %prePage% %linkPage% %nextPage% %end%");
		$show       = $Page->show();// 分页显示输出
    	//$list = $Data->where($map)->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
		//print_r(session('kjj_id'));
		$list = $ksbm->where($bm_where)->order('bm_time')->limit($Page->firstRow.','.$Page->listRows)->select();
    	$this->assign('data',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出
    	$this->display("ksbm_select"); // 输出模板		           
	}
		
}