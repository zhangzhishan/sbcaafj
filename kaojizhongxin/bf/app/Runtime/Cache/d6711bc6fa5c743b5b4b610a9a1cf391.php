<?php if (!defined('THINK_PATH')) exit();?><script>
</script>
<div class="row">
<div id="cb_add" class="col-sm-8 col-sm-offset-2">
	<form role="form">
  		<div class="form-group">
    		<label for="exampleInputEmail1">添加承办点名称</label>
    		<input type="text" name="bm_name" value="<?php echo ($data[0]["bm_name"]); ?>"  id="bm_name" class="form-control" placeholder="必填">
  		</div>
        <div class="form-group">
    		<label for="exampleInputEmail1">添加点编号</label>
    		<input name="bm_bm" type="text" id="bm_bm" value="<?php echo ($data[0]["bm_bm"]); ?>" class="form-control" placeholder="必填">
            <input name="bm_id" id="bm_id" type="hidden" value="<?php echo ($data[0]["bm_id"]); ?>" /> 
  		</div>
  
  
  		<button type="button" onclick="<?php echo ($data[0]==""?"bm_add('cb_add')":"bm_add('cb_update_ac','cb_select')"); ?>" class="btn btn-default">Submit</button>
	</form>
</div>
</div>