<?php if (!defined('THINK_PATH')) exit();?><script>
	
</script>
<div class="row">
<div id="cb_add" class="col-sm-8 col-sm-offset-2">
	<table class="table table-striped">
        <thead>
          <tr>
            <th>id</th>
            <th>考点名称</th>
            <th>考试时间</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>开启状态</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["bm_id"]); ?></td>
            <td><?php echo ($vo['Kjj']["bm_name"]); ?></td>
            <td><?php echo ($vo["ks_time"]); ?></td>
            <td><?php echo ($vo["k_time"]); ?></td>
            <td><?php echo ($vo["j_time"]); ?></td>
            <td><?php echo ($vo['on_off']=='true'?'开启':'关闭'); ?></td>
            <td>
            	<button onclick="bm_dele(<?php echo ($vo["bm_id"]); ?>,'kshd')" type="button" class="btn btn-default">删除</button>
                <button onClick="bm_load('ks_update/id/<?php echo ($vo["bm_id"]); ?>')"  type="button" class="btn btn-default">修改</button>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
</div>
</div>