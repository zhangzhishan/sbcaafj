<?php
class ksbmModel extends RelationModel {
	protected $_auto = array ( 
    array('bm_time',"date1",1,'callback'), // 对create_time字段在更新的时候写入当前时间戳
	array('bm_cell',"date2",1,'callback'), 
 );
 
  protected function date1() {
	   return date('Y-m-d');
	  }
        protected function date2() {
		$ksbm   =   M('ksbm');
		$kjj   =   M('kjj');
		$map	=I('post.bm_kjj_id');
		$list1 = $kjj->where("bm_id=$map")->select(); 
		
		$list = $ksbm->where("bm_kjj_id=$map")->order('id desc')->limit(1)->select(); 
		$nu=((int)substr($list[0]['bm_cell'],-3)+1);
		//print_r($list);
		if($nu<10){
			$nu="00".$nu."";
		}else if($nu<100){
			$nu="0".$nu."";
		}else{
			$nu=$nu."";
			}
	    return $list1[0]["bm_t1"]."0".date("y").$nu;
	  }	 
	//定义联接	
	protected $_link = array(
            'kshd'=>array(
            'mapping_type'    => BELONGS_TO, 
                 'class_name'    =>'kshd',
				 'foreign_key'   =>'kshd_id',
				 
				 //'mapping_name' => 'Kshd23',
                 // 定义更多的关联属性
             
             ),
		'zygl'=>array(
            'mapping_type'    => BELONGS_TO, 
                 'class_name'    =>'zygl',
				 'foreign_key'   =>'bm_zy_id',
				 
				 //'mapping_name' => 'Kshd23',
                 // 定义更多的关联属性
             
			 ),
		'kjj'=>array(
            'mapping_type'    => BELONGS_TO, 
                 'class_name'    =>'kjj',
				 'foreign_key'   =>'bm_kjj_id',
				 
				 //'mapping_name' => 'Kshd23',
                 // 定义更多的关联属性
             
			 ),


         );	  	 
}

?>
