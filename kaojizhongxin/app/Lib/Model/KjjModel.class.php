<?php
class KjjModel extends Model {
    protected $_validate    =   array(
        array('bm_name','require','标题必须'),
        array('bm_bm','require','编码必须'),
        );
  
    // 定义自动完成
    protected $_auto    =   array(
        array('bm_time','time',1,'function'),
        );
}

?>