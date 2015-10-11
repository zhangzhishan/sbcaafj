<?php if (!defined('THINK_PATH')) exit();?><script>
</script>
<div class="row">
<div id="cb_add" class="col-sm-8 col-sm-offset-2">
	<form role="form">
  		<div class="form-group row">
        <div class="col-sm-6">	
    		<label  for="exampleInputEmail1">添加考点名称</label>
            <select class="form-control" id="Kjj_id">
            		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bm_bm"]); ?>|<?php echo ($vo["bm_id"]); ?>"   <?php if(($vo["bm_id"]) == $data1[0]["kjj_id"]): ?>selected<?php endif; ?> ><?php echo ($vo["bm_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 
         </div>
         <div class="col-sm-6"> 
         	<label for="exampleInputEmail1">对应编号</label>
            <input type="text" name="bm_name"  id="bm_name" class="form-control" placeholder="" readonly>
         </div>
  		</div>
        
        <div class="form-group row">
        <div class="col-sm-6">	
    		<label  for="exampleInputEmail1">添加开始时间</label>
             <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="k_time" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php echo ($data1[0]["k_time"]); ?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="k_time" value="<?php echo ($data1[0]["k_time"]); ?>" />
         </div>
         <div class="col-sm-6"> 
         	<label for="exampleInputEmail1">添加结束时间</label>
            <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="j_time" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php echo ($data1[0]["j_time"]); ?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="j_time" value="<?php echo ($data1[0]["j_time"]); ?>" />
         </div>
  		</div>
   		<div class="form-group row">
        	<div class="col-sm-12">
        	<label  for="exampleInputEmail1">添加考试时间</label>
             <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="ks_time" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php echo ($data1[0]["ks_time"]); ?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="ks_time" value="<?php echo ($data1[0]["ks_time"]); ?>" />
         </div>
         </div>
        <div class="form-group row">
        	<div class="col-sm-12">
                  <div class="checkbox">
    				<label>
      					<input name="on_off" id="on_off"  <?php if(($data1[0]["on_off"]) == "true"): ?>checked<?php endif; ?>  type="checkbox"> 是否开启
                        <input name="bm_id" id="bm_id" type="hidden" value="<?php echo ($data1[0]["bm_id"]); ?>" /> 
    				</label>
  				  </div>
            </div>
        </div>
  
  
  
         <div class="row">
         	<div class="col-sm-12">
  				<button type="button" onclick="<?php echo ($data1[0]?"bm_add('ks_update_ac','ks_select')":"bm_add('ks_add')"); ?>" class="btn btn-default">Submit</button>
            </div>
        </div>
	</form>
</div>
</div>

<script type="text/javascript">
	 var id ,arr ;
	//取考点名称值
	function get_id(){
		arr= $("#Kjj_id").children('option:selected').val(); 		
		arr=arr.split("|");
		id=arr[1];
		 $("#bm_name").val(arr[0]);	
		//alert(id);
		}
		get_id();
   
   //点击去考点名称值   
   $("#Kjj_id").change(function(){ 
		get_id();	
  });
   $('.form_date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	
</script>