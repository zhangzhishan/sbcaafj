<?php if (!defined('THINK_PATH')) exit();?><form role="form" >
	<div class="form-group row" style="margin-top:20px;" >
    <div class="col-sm-12 col-sm-offset-1">
    	<label for="exampleInputEmail1">考生报名表</label>
    </div>
    </div>
	<div class="form-group row" >
   
        <div class="col-sm-4 col-sm-offset-1">
        	<label for="exampleInputEmail1">姓名</label>
            <input type="text" name="bm_name"  id="bm_name" class="form-control"   value="<?php echo ($data3["bm_name"]); ?>"  placeholder="" >
        </div>
        <div class="col-sm-4 ">
        	<label for="exampleInputEmail1">拼音</label>
            <input type="text" name="bm_py"  id="bm_py"  value="<?php echo ($data3["bm_py"]); ?>" class="form-control" placeholder="" >
        </div>
         <div class="col-sm-2 ">
        	<label for="exampleInputEmail1">性别</label>
            <select class="form-control" id="bm_sex">
            		  	<option value="0" <?php if(($data3['bm_sex']) == "0"): ?>selected<?php endif; ?> >男 </option>
                        <option value="1" <?php if(($data3['bm_sex']) == "1"): ?>selected<?php endif; ?> >女</option> 					
				</select> 
        </div>
     </div>
     <div class="form-group row">
        <div class="col-sm-4 col-sm-offset-1">
        	<label  for="exampleInputEmail1">出生日期</label>
             <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="bm_csdate" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="<?php echo ($data3["bm_csdate"]); ?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="bm_csdate" value="<?php echo ($data3["bm_csdate"]); ?>" />
         </div>
         
         <div class="col-sm-4 ">
        	<label for="exampleInputEmail1">电话</label>
            <input type="text" name="bm_cell"  id="bm_cell" class="form-control" value="<?php echo ($data3["bm_cell"]); ?>" placeholder="" >
        </div>
        
         <div class="col-sm-2 ">
        	<label for="exampleInputEmail1">民族</label>
            <input type="text" name="bm_mz"  id="bm_mz" class="form-control" value="<?php echo ($data3["bm_mz"]); ?>" placeholder="" >
        </div>
        
        
      </div>
      
      <div class="form-group row">
      		<div class="col-sm-3 col-sm-offset-1">
        		<label for="exampleInputEmail1">邮箱</label>
            	<input type="text" name="bm_mail"  id="bm_mail" class="form-control" value="<?php echo ($data3["bm_mail"]); ?>" placeholder="" >
       		 </div>
             <div class="col-sm-7 ">
        		<label for="exampleInputEmail1">地址</label>
            	<input type="text" name="bm_add"  id="bm_add" class="form-control" value="<?php echo ($data3["bm_add"]); ?>" placeholder="" >
        	</div>
      </div>
      <div class="form-group row">
      		 <div class="col-sm-3 col-sm-offset-1">
        	<label for="exampleInputEmail1">报考专业</label>
             <select class="form-control" id="bm_zy">
            		  <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bm_id"]); ?>|<?php echo ($vo["bm_name"]); ?>"  <?php if(($data3['bm_zy_id']) == $vo["bm_id"]): ?>selected<?php endif; ?>><?php echo ($vo["bm_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>					
				</select> 
             </div>
             <div class="col-sm-2 ">
        	<label for="exampleInputEmail1">报考级别</label>
            <select class="form-control" id="bm_level">
            		  	<?php $__FOR_START_25060__=1;$__FOR_END_25060__=10;for($i=$__FOR_START_25060__;$i < $__FOR_END_25060__;$i+=1){ ?><option value="<?php echo ($i); ?>"  <?php if(($data3['bm_level']) == $i): ?>selected<?php endif; ?> ><?php echo ($i); ?> </option>
                         		 
							 </if><?php } ?>
                     				
				</select> 
        	</div>
             <div class="col-sm-2 ">
        	<label for="exampleInputEmail1">已过级别</label>
            <select class="form-control" id="bm_ylevel">
            			<option value="0">无</option>
            		  	 	<?php $__FOR_START_22093__=1;$__FOR_END_22093__=9;for($i=$__FOR_START_22093__;$i < $__FOR_END_22093__;$i+=1){ ?><option value="<?php echo ($i); ?>"  <?php if(($data3['bm_ylevel']) == $i): ?>selected<?php endif; ?> ><?php echo ($i); ?> </option>
                         		 
							 </if><?php } ?> 					
				</select> 
        	</div>
             <div class="col-sm-3 ">
        	<label for="exampleInputEmail1">考试地点</label>
            <input type="text" name="bm_name"  id="bm_kjj" class="form-control" placeholder="" value="<?php echo ($data1[0]["bm_name"]); ?>" readonly>
            <input type="hidden" id="bm_kjj_id" value="<?php echo ($data1[0]["bm_id"]); ?>">
            <input type="hidden" id="bm_bm" value="<?php echo ($data2); ?>">
            <button style="float:right; margin-top:10px;" type="button" onclick="bm_add1('kshd_qr','ks_select')" class="btn btn-default">报名</button>
        </div> 
       
      </div>
       
    </div>   
</form>        
<script>

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