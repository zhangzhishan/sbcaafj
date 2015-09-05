<?php if (!defined('THINK_PATH')) exit();?><script>
	
</script>
<div class="row">
<div id="cb_add" class="col-sm-12 ">
	<div class="row">
    <div class="form-group col-sm-2">
		<form class="form-horizontal" role="form">
 			<label  for="exampleInputEmail1">添加开始时间</label>
             <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="k_time" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text"  readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" id="k_time"  />
		</form>
    </div>
       <div class="form-group col-sm-2">
		<form class="form-horizontal" role="form">
 			<label  for="exampleInputEmail1">添加结束时间</label>
             <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="j_time" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text"  readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
             <input type="hidden" id="j_time"  />   
		</form>
    </div>
	<div class="form-group col-sm-3">
		<form class="form-horizontal"  role="form">
 			<label for="disabledTextInput">考点名称</label>
			<select class="form-control" name="kjj" id="kjj">
  				<option value="0">全选</option>
  	 			<?php if(is_array($kd)): $i = 0; $__LIST__ = $kd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bm_id"]); ?>"><?php echo ($vo["bm_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</form>
    </div>
    <div class="form-group col-sm-3">
		<form class="form-horizontal" role="form">
 			<label for="disabledTextInput">专业名称</label>
			<select class="form-control" name="zygl" id="zygl">
  				<option value="0">全选</option>
  				<?php if(is_array($zy)): $i = 0; $__LIST__ = $zy;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["bm_id"]); ?>"><?php echo ($vo["bm_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</form>
    </div>
    <div class="form-group col-sm-1">
		<form class="form-horizontal" role="form">
 			<label for="disabledTextInput">等级</label>
			<select class="form-control" name="bm_level" id="bm_level">
  				<option value="0">全选</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
  	
			</select>
		</form>
    </div>
    
    <div class="form-group col-sm-1">
		<form class="form-horizontal" role="form">
        <label for="disabledTextInput">确认  </label>
 			<button type="button"  onclick="ksbm_select()" class="btn btn-default">确认</button>
		</form>
    </div>
    
    
    </div>    
	<table class="table table-striped">
        <thead>
          <tr>
          	<th>选择</th>
            <th>id</th>
            <th>考生姓名</th>
            <th>拼音</th>
            <th>性别</th>
            <th>出生日期</th>
            <th>民族</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>地址</th>
            <th>专业</th>
            <th>级别</th>
            <th>已过级别</th>
            <th>考点</th>
            <th>报名时间</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
           	<td><input name="on_off" class="q" value="<?php echo ($vo["id"]); ?>" type="checkbox"> </td>
            <td><?php echo ($vo["id"]); ?></td>
            <td><?php echo ($vo["bm_name"]); ?></td>
            <td><?php echo ($vo["bm_py"]); ?></td>
            <td> <?php echo ($vo['bm_sex']==0?'男':'女'); ?></td>
            <td><?php echo ($vo["bm_csdate"]); ?></td>
            <td><?php echo ($vo["bm_mz"]); ?></td>
            <td><?php echo ($vo["bm_cell"]); ?></td>
            <td><?php echo ($vo["bm_mail"]); ?></td>
            <td><?php echo ($vo["bm_add"]); ?></td>
            <td><?php echo ($vo["bm_zy"]); ?></td>
            <td><?php echo ($vo["bm_level"]); ?></td>
            <td><?php echo ($vo["bm_ylevel"]); ?></td>
            <td><?php echo ($vo["bm_kjj"]); ?></td>
            <td><?php echo ($vo["bm_time"]); ?></td>
            
            <td>
            	<button onclick="bm_dele(<?php echo ($vo["id"]); ?>,'ksbm')" type="button" class="btn btn-default">删除</button>
                <button onClick="bm_load('ksbm_update/id/<?php echo ($vo["id"]); ?>')"  type="button" class="btn btn-default">修改</button>
            </td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
           <tr>
            	<td colspan="4">
          		  <button onclick="ksbm_q()" type="button" class="btn btn-default">全选</button>
                  <button onclick="ksbm_noq()" type="button" class="btn btn-default">取消</button>
                 </td>
           		<td colspan="11">
          		 <div class="result page"><?php echo ($page); ?></div>
                 </td>
                 <td colspan="1">
          		  <button onclick="ksbm_dele()" type="button" class="btn btn-default">删除</button>
                 </td>
           </tr>
        </tbody>
      </table>
      
</div>
</div>
<script>
$(".page a").click(function(){
		$.get($(this).attr("href")+"", 
  					function(data){
						
					$("#bm_body").html(data);
   					 
 					 });
	return false;
	;
	});
function ksbm_q(){
	$(".q").each(function() {
		this.checked=true;
	});
	}
	
function ksbm_noq(){
	$(".q").each(function() {
		this.checked=false;
	});
	}
function ksbm_dele(){
	var chen=" " ,no_off="";
	$(".q").each(function() {
		//alert($(this).prop("checked"));
		if($(this).prop("checked")){
			
			chen+=no_off+$(this).val();
			no_off=",";
		}
		
	});
	bm_dele(chen,"ksbm");
	}
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
function ksbm_select(){
	var k_time,j_time,kjj,zygl,bm_level,bm_where ;
	bm_where="";
	k_time=$("#k_time").val();
	j_time=$("#j_time").val();
	kjj	  =$("#kjj").val();
	zygl  =$("#zygl").val();
	bm_level=$("#bm_level").val(); 	
 	if(k_time){
		bm_where="bm_time > ="+k_time+" and "; 
	}
	if(j_time){
		bm_where+="j_time< ="+j_time+" and ";
	}
	if(kjj !=0){
		bm_where+="bm_kjj_id="+kjj+" and ";
	}
	 if(zygl!=0){
		bm_where+="bm_zy_id="+zygl+" and ";
	}
	if(bm_level!=0){
		bm_where+="bm_level="+bm_level +" and ";
	}
	$.post("__URL__/ksbm_select",{"bm_where":bm_where},
  					function(data){
					$("#bm_body").html(data);
					//bm_load('ksbm_select');	
	});
	//alert(bm_where);
	
	
	}		
</script>