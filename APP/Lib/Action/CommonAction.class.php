<?php

Class CommonAction extends Action{

	Public function _initialize(){
	
		if(!isset($_SESSION['userid']) || !isset($_SESSION['username'])){
			redirect(U('Admin/Login/index' ,'' ,''));
		}

	}

}





?>