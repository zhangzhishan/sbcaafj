<?php
class Bm_adminModel extends Model {
    protected $_validate    =   array(
        array('name','require','名称必须'),
        array('password','require','编码必须'),
		array('zt','require','权限必须'),
        );
  
    // 定义自动完成
    protected $_auto    =   array(
       array('password','md5',1,'function') ,
	   
     );
}

?>