<?php
class ksbmModel extends RelationModel {
	protected $_auto = array ( 
    array('bm_time',"date1",1,'callback'), // 对create_time字段在更新的时候写入当前时间戳
 );
 
  protected function date1() {
	   return date('Y-m-d');
	  }	 
}

?>