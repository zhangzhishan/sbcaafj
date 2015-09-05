<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        </script>
        </script>
    <![endif]--> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    </script>
   
    
     </script> 
     <link rel="stylesheet" href="__PUBLIC__/bootstrap/css/bootstrap-datetimepicker.css">
         </script>
    <style>
    body {
		background-color: #f7f2db;
		color: #666666;
		padding:0px;
		margin:0px;
	}
	.body_1{
		width:962px;
		margin:auto;
		
		}
	.bo{
		border: 1px solid #f1e9c3;
		background-color: #fff6cb;
		min-height:500px;
		}
    </style>

 	//统一载入ajax页面
    	function bm_load(bm_action){
			//alert(__ACTION__+"");
			$.get("__URL__/"+bm_action, 
  					function(data){
						
					$("#bm_body").html(data);
   					 
 					 });
			}
	//统一写入	
		function bm_add(bm_action,load_url){
			var data;
			
			if(bm_action=="kshd_sele"){
				data={"bm_bm":$("#bm_bm").val()};
				//alert($("#bm_bm").val());
		
			}
			$.post("__URL__/"+bm_action,data,
  					function(data){	
						if(!data){
							alert("当前考点没有考试活动");	
						}else{
							$("#bo").html(data);
						}
			
			});		
		}
	function jc(data){
		 if(!/^[\u4e00-\u9fa5]+$/gi.test(data.bm_name)){
			 alert('姓名含有非汉字字符'); 
			 return false;
		 }else if(!/^[_a-zA-Z \s]+$/gi.test(data.bm_py)){
			 alert('拼音含有非字母字符'); 
			 return false;
		}else if(!/^[0-9]+$/g.test(data.bm_cell)){
			alert('电话含有非数字'); 
			 return false;
		}else if(!data.bm_mz){
			alert("民族没有填写");
			return false;
		}else if(!data.bm_add){
			alert("地址没有填写");
			return false;
		}else if(!data.bm_csdate){
			alert("日期没有填写");
			return false;
		}
		  return true;
	}	
	function bm_add1(bm_action,load_url){
			var data;
			data={};
			if(bm_action=="kshd_sele"){
				data=kshd;
				//alert($("#bm_bm").val());
		
			}else if(bm_action=="kshd_qr"){
				var arr ;
				arr=$("#bm_zy").val();
				arr=arr.split("|");
				data.bm_name=$("#bm_name").val();
				data.bm_py	=$("#bm_py").val();
				data.bm_sex =$("#bm_sex").val();
				data.bm_csdate=$("#bm_csdate").val();
				data.bm_mz  =$("#bm_mz").val();
				data.bm_cell=$("#bm_cell").val();
				data.bm_mail=$("#bm_mail").val();
				data.bm_add=$("#bm_add").val();
				data.bm_zy_id  = arr[0];
				data.bm_zy     = arr[1];
				data.bm_level=$("#bm_level").val();
				data.bm_ylevel =$("#bm_ylevel").val();
				data.bm_kjj_id= $("#bm_kjj_id").val();
				data.bm_kjj	  = $("#bm_kjj").val();
				data.bm_bm	  = $("#bm_bm").val();
				//data.bm_bm	  = $("#bm_bm").val();
				if(!jc(data)){
					return;
					}
			
				
			}else if(bm_action=="kshd_dy"){
				data=kshd;
				$.post("__URL__/"+bm_action,data,
  					function(data){	
					
						if(!data){
							alert("填写失误，不能成功。");	
						}else{
							
							$("body").html(data);
							
						}	
					});	
						return;
				}
			$.post("__URL__/"+bm_action,data,
  					function(data){	
					
						if(!data){
							alert("填写失误，不能成功。");	
						}else{
							
							$("#bo").html(data);
							
						}	
						
			
			});		
		}
		function XN_CheckAllCnText(str) { 
			var reg=/[\u4E00-\u9FA5]/g ; 
			if (reg.test(str)){
					alert("含有汉字");
				}else{
					alert("不含有汉字");
			} 
		} 
		
 </script>
 </head>
 <body>
 	<div class="body_1" style=" height:32px; text-align:right;">
    	<span style=" float:left;">您好，欢迎来到中国美术学院 福建考级中心</span><span><a >首页</a></span>
    </div>
   	<div class="body_1">
    	<a class="big_pic" href="#"><img  id="lunbo_1" src="__PUBLIC__/images/1.jpg" width="962" height="225"></a>
    </div>
    <div class="body_1 bo" id="bo">
    	<form role="form" style=" margin-top:150px;">
        	<div class="form-group row">
        		<div class="col-sm-6 col-sm-offset-3">
                	<label for="exampleInputEmail1">考点编号</label>
           			 <input type="text" name="bm_bm"  id="bm_bm" class="form-control" placeholder="" >
                     	<button style="float:right; margin-top:10px;" type="button" onclick="bm_add('kshd_sele','ks_select')" class="btn btn-default">确认</button>
                        <br>
                       <span style="color:#F00;">非承办点考生，请与就近的考级承办点联系。<a href="http://www.caafj.com/index.php/Home/Index/detail/id/2">《考点信息》</a></span>
                </div>
              
                
        
            </div>    	
        </form>
    </div>

 </body>
 
</html>