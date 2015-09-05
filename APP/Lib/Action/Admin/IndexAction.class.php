<?php

Class IndexAction extends CommonAction{

	public function index(){

		
		
		$this->display();
	
	}
	


	Public function logout (){

		session('userid',null);
		session('username',null);

		//$this->redirect('Login/index' ,'' ,'');
		//$this->redirect(U('index' ,'' ,''));
		$this->redirect(U('Admin/Login/index' ,'' ,''));
	}
 


}



?>