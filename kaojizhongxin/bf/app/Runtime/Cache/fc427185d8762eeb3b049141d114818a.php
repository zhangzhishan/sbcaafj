<?php if (!defined('THINK_PATH')) exit();?><style>
	td{
		height:50px;
		width:110px;
	}
	.t1{
		text-align:center;
		vertical-align:central;
		}
	body{
		background-color:#fff;
		}	
</style>

<div class="body_1" style="text-align:center">
	<img  id="lunbo_1" src="__PUBLIC__/images/b1.jpg" width="400">
</div>
<div class="row body_1" style="margin-top:30px;" >
	<div class="col-sm-10 col-sm-offset-1">
	 <table class="t1" width="100%" border="1">
	    <tr>
	      <td colspan="2" rowspan="4">
          
          			照片
          			<br/>
                    2寸
          </td>
	      <td>姓名：</td>
	      <td colspan="1"><?php echo ($data["bm_name"]); ?></td>
	      <td>拼音：</td>
	      <td colspan="1"><?php echo ($data["bm_py"]); ?></td>
           <td>电话：</td>
           <td><?php echo ($data["bm_cell"]); ?></td>
        </tr>
	    
	    <tr>
	      <td colspan="1">出生日期：</td>
	      <td colspan="3"><?php echo ($data["bm_csdate"]); ?></td>
          <td>民族</td>
	      <td colspan=""><?php echo ($data["bm_mz"]); ?></td>
         
        </tr>
        <tr>
	      <td>性别：</td>
	      <td>
             
          	
            <?php echo ($data['bm_sex']==0?'男':'女'); ?>
          </td>
	      
	       <td colspan="1">邮箱：</td>
	      <td colspan="1"><?php echo ($data["bm_mail"]); ?></td>
          <td colspan="1">考点：</td>
	      <td colspan="1"><?php echo ($data["bm_kjj"]); ?></td>
        </tr>
	    <tr>
	      <td colspan="1">地址：</td>
	      <td colspan="5"><?php echo ($data["bm_add"]); ?></td>
          
        </tr>
        
	    <tr>
	      <td colspan="2">报考专业</td>
	      <td colspan="2" ><?php echo ($data["bm_zy"]); ?></td>
	      <td>报考级别</td>
	      <td ><?php echo ($data["bm_level"]); ?></td>
	      <td>原有级别：</td>
	      <td ><?php echo ($data["bm_ylevel"]); ?></td>
        </tr>
	    <tr>
	      <td colspan="8" rowspan="3" style="text-align:left;">
          <div style="padding:30px 10px;">
          备注：<br/>
            1、如考生填报两个以上专业，需另填报名表。<br/>
			2、本表系录入文化部数据库的依据，请考生务必用正楷如实填写。<br/>
			3、一经报名，不得退考、更改考试科目、报考级别。<br/>
			4、因考生本人原因缺考视为自动弃权，恕不退费和补考。
             </div>
            </td>
           
        </tr>
      </table>
	      附：近期同底正面免冠小 2 寸照片三张，照片背后需写上考生姓名。<br />
A、1 张贴在报名表上。<br />
B、1 张用液体胶接在报名表照片旁供我中心做证书用。<br />
C、1 张贴在准考证上。
	</div>
</div>

</div>

<script>

	
</script>