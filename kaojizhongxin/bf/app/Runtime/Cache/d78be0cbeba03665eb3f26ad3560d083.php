<?php if (!defined('THINK_PATH')) exit();?><script>
</script>
<div class="row">
<div id="cb_add" class="col-sm-8 col-sm-offset-2">
	<form role="form">
    	<div class="form-group">
    		<label for="exampleInputEmail1">权限</label>
             <select class="form-control" id="admin_zt">
             	<option value="1|0">管理员</option>
            		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bm_bm"]); ?>|<?php echo ($vo["bm_id"]); ?>"><?php echo ($vo["bm_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 
    		
  		</div>
  		<div class="form-group">
    		<label for="exampleInputEmail1">用户名添加</label>
    		<input name="name" type="text" id="name" class="form-control" placeholder="管理员可自填，其他为考点编号" readonly>
  		</div>
        <div class="form-group">
    		<label for="exampleInputEmail1">密码</label>
    		<input name="password " type="text" id="password" class="form-control" placeholder="必填">
  		</div>        
  		<button type="button" onclick="bm_add('admin_add')" class="btn btn-default">Submit</button>
	</form>
</div>
</div>

<script type="text/javascript">
	 var id ,arr1 ;
	//取考点名称值
	function get_id(){
		arr1= $("#admin_zt").children('option:selected').val(); 
		//alert(arr);
		arr1=arr1.split("|");
		//alert(arr1[0]);
		if(arr1[0]==1){
			 $("#name").removeAttr("readonly");
			  $("#name").val("");
		}else{
			
			 $("#name").attr("readonly","readonly");
			 $("#name").val(arr1[0]);	
		}		
		
		}
		get_id();
   
   //点击去考点名称值   
   $("#admin_zt").change(function(){ 
		get_id();	
  });
</script>