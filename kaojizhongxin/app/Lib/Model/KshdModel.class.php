<?php
class KshdModel extends RelationModel {
    protected $_validate    =   array(
        array('kjj_id','require','选择考点'),
        array('ks_time','require','考试时间必须'),
		array('k_time','require','开始时间必须'),
		array('j_time','require','结束时间必须'),
        );
  
    // 定义自动完成
    protected $_auto    =   array(
        array('bm_time','time',1,'function'),
        );
	//定义联接	
	protected $_link = array(
            'Kjj'=>array(
            'mapping_type'    => BELONGS_TO, 
                 'class_name'    =>'Kjj',
				//'foreign_key'   =>'kjj_id',
				 //'mapping_name' => 'Kshd23',
                 // 定义更多的关联属性
             
             ),
         );	
}

?>