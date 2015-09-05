<?php if (!defined('THINK_PATH')) exit();?><script>
	
</script>
<div class="row">
<div id="cb_add" class="col-sm-8 col-sm-offset-2">
	<table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>名称</th>
            <th>等级</th>
            
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["id"]); ?></td>
            <td><?php echo ($vo["name"]); ?></td>
            <td><?php echo ($vo['zt']==1? "管理员":"其他"); ?></td>
            <td><button onclick="bm_dele(<?php echo ($vo["id"]); ?>,'bm_admin')" type="button" class="btn btn-default">删除</button></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
</div>
</div>