
var objNode = function(o){return document.getElementById(o);}

String.prototype.trim = function(){ return this.replace(/(^\s*)|(\s*$)/g, ""); }  
String.prototype.ltrim = function(){ return this.replace(/(^\s*)/g, ""); }    
String.prototype.rtrim = function(){ return this.replace(/(\s*$)/g, ""); } 


//图片等比例缩小
var flag=false;
function DrawImage(ImgD, num){
	var image=new Image();	
	image.src=ImgD.src;




	if(image.width>0 && image.height>0){
		flag=true;
		if(image.width/image.height>= 1){

			if(image.width>num){ 
				ImgD.width=num;
				ImgD.height=(image.height*num)/image.width;

			}
			else{
				ImgD.width=image.width; 
				ImgD.height=image.height;
			}
		}
		else{

			if(image.height>num){ 
				ImgD.height=num;
				ImgD.width=(image.width*num)/image.height; 
			}
			else{
				ImgD.width=image.width; 
				ImgD.height=image.height;
			}
		}
	}
} 




window.onload = function(){

		var imgs = document.getElementById("iContent");
		
		if(imgs){

			imgs = imgs.getElementsByTagName("img");

			for(var i = 0 ;i < imgs.length ;i++){
				DrawImage(imgs[i] ,650);
			}

		}

		//添加单个页面分页
		var mypage = $('#mypage');
		if (mypage.length > 0) {

			var objText = $('.mypage-text')
			var text = objText.html();
			var pagelist = '';
			text = text.split('_ueditor_page_break_tag_');

			if(text.length == 1){return;}

			objText.html(text[0]);  //显示第一页

			for (var i = 0; i<text.length; i++) {
				var tmp_class = '';
				if (i == 0) {tmp_class = 'class="cur"'};
				pagelist += '<span '+ tmp_class +'>' + (i+1) + '</span>';
			}

			mypage.html(pagelist); //显示分页

			$('#mypage span').click(function(){
				var index = $('#mypage span').index($(this));
				objText.html(text[index]);

				$('#mypage span').removeClass('cur');
				$(this).addClass('cur');
			});	
		}

	}






//滚动函数
function toleft(demo,demo1,demo2,speed,flag){
	
	demo  = objNode(demo);
	demo1 = objNode(demo1);
	demo2 = objNode(demo2);
	
	demo2.innerHTML=demo1.innerHTML
	
	function Marquee(){
		if(demo2.offsetWidth-demo.scrollLeft<=0){
			demo.scrollLeft -= demo1.offsetWidth
		}else{
			demo.scrollLeft++
		}
	}
	
	flag = setInterval(Marquee,speed)
	demo.onmouseover = function(){clearInterval(flag);}
	demo.onmouseout  = function(){flag=setInterval(Marquee,speed);}
}


function toright(demo,demo1,demo2,speed,flag){
	
	demo  = objNode(demo);
	demo1 = objNode(demo1);
	demo2 = objNode(demo2);
	
	demo2.innerHTML=demo1.innerHTML
	
	function Marquee(){
		if(demo.scrollLeft<=0){
			demo.scrollLeft=demo2.offsetWidth
		}
		else{
			demo.scrollLeft--
		}
	}
	
	flag = setInterval(Marquee,speed)
	demo.onmouseover = function(){clearInterval(flag);}
	demo.onmouseout = function(){flag=setInterval(Marquee,speed);}
}

function totop(demo,demo1,demo2,speed,flag){
	
	demo  = objNode(demo);
	demo1 = objNode(demo1);
	demo2 = objNode(demo2)
	
	demo2.innerHTML=demo1.innerHTML
	
	function Marquee(){
		if(demo2.offsetTop-demo.scrollTop<=0){
			demo.scrollTop -= demo1.offsetHeight 
		}else{
			demo.scrollTop++
		}
	}
	
	flag = setInterval(Marquee,speed)
	demo.onmouseover = function(){clearInterval(flag);}
	demo.onmouseout  = function(){flag=setInterval(Marquee,speed);}
}

function toboth(demo,demo1,demo2,speed,flag){
	
	demo  = objNode(demo);
	demo1 = objNode(demo1);
	demo2 = objNode(demo2);
	
	demo2.innerHTML=demo1.innerHTML
	
	
	
		function Marquee(){
			
					if(direction == 1){
					
						if(demo2.offsetWidth-demo.scrollLeft<=0){
							demo.scrollLeft -= demo1.offsetWidth
						}else{
							demo.scrollLeft++
						}
					}
					
					if(direction == 2){
						if(demo.scrollLeft<=0){
							demo.scrollLeft=demo2.offsetWidth
						}
						else{
							demo.scrollLeft--
						}
					}
			
		}

	
	flag = setInterval(Marquee,speed)
	demo.onmouseover = function(){clearInterval(flag);}
	demo.onmouseout  = function(){flag=setInterval(Marquee,speed);}
}
