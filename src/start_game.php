<!DOCTYPE HTML>

<html>
	<head>
	   <meta charset='gbk' />
	   <title> 一起玩拼图 | 多宝出品 </title>
	   <meta name="viewport" content="width=device-width, initial-scale=1" />
     <link rel="shortcut icon" type="image/x-icon" href="image/title.ico" />	
		 <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		 <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		 <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
		 <style type="text/css">
		 	  /* content */
		 	  body {-webkit-user-select:none;user-select:none;}
		 	  .ui-page {background-color:rgb(240,240,240);}
				.shell {position:absolute;}
			<?php
				  $image_set = array(0,1,2,3,4,5);
				  shuffle($image_set);
				  $image_index = 0;//$image_set[0];
				  $image_path = "../pintuImage/".$_GET['zone']."_".$image_index.".jpg";
				  echo ".shell p {position:absolute;margin:0;background:url('".$image_path."') no-repeat 0 0;cursor:pointer;}";
			?>
				
				/* footer */
				.status {-webkit-user-select:none;user-select:none;}
		 	  .status p {font-size:15px;color:green;text-align:center;}
		 	  .status b {color:red;font-weight:bold;}
		 </style>
		 
	   <?php
		   echo "<script> var bg_image = new Image(); bg_image.src ='".$image_path."';</script>";
		   echo "<script> var bg_zone = '".$_GET['zone']."';</script>";
		 ?>
 
	   <script>
	   	  var bWidth = 0; // picture block width
	   	  var level = 100; // hard or easy
	   	  var fre_timer, fre_indicator=0;// refresh
//	   	  var pre_skipped = 1;
	   	  $(document).ready(
	   	    function () {  	        	     
		   	     $(".status").offset({top:$(document).height()-$(".status").height()-4,left:0}); // status bar location
		   	     $(".status p").bind('tap',function(e){
		   	     	 if(speller.going == false) 
		   	     	   return; 
		   	     	 fre_indicator = 1;
		   	     	 if( confirm("打乱图片重新来？") )
		   	     	   speller.init(level);
		   	     	 fre_indicator = 0;
		   	     });
//		   	     $(".shell").bind('tap',function(e) {
//		   	     	 if(speller.going == true)
//		   	     	   return;
//	   	     	   pre_skipped = 0;
//		   	     });
    	    }
	   	  ) // ready	 
	   	    	  
	   	  function initialCanvas() {
		   	     var scr_width = $(document).width();
		   	  	 var scr_height = $(document).height();
		   	     var pic_width = $(document).width();
		   	     var pic_height = $(document).height() - $(".status").height();	
	     	     document.body.ontouchmove = function(e) { e.preventDefault(); };  // 禁用页面拖动   	       	     
		   	     // get valid block width   
             bWidth = parseInt((pic_width-20)/3);
             while(1) {
             	 var widthValid=true;
               widthValid &= ( bWidth*3 ) < (pic_width-20); // 3 columns
               widthValid &= ( bWidth*4 ) < (pic_height-20); // 5 rows
               widthValid &= ( bWidth*3 ) <= bg_image.width;
               if( widthValid ) 
                 break;
               else
               	 bWidth = bWidth - 1; // find valid width by step 2px
             }
             // canvas located
	   	  	   $(".shell").offset({top:parseInt(pic_height/2-bWidth*4/2),left:parseInt(pic_width/2-bWidth*3/2)});
	   	  	   $(".shell").css({width:bWidth*3,height:bWidth*4});
    	  } // initialCanvas

				speller={
					init:function(n) {
							this.hard=n||3;
							this.useTime = 0;
							this.step=0;
							this.going=false; // 预览结束后为true
							this.blank=11;
							this.createGrid();
							clearInterval(this.timer);
					}, // init
					createGrid:function() {
							var X=function(n){return (n%3)*bWidth;};
							var Y=function(n){return Math.floor(n/3)*bWidth;};
							for(var i=0,html=[];i<12;i++) 
								html.push("<p onclick='speller.move(this)' id="+i+" class="+i+" style='left:"+X(i)+"px;top:"+Y(i)+"px;width:"+(bWidth-1)+"px;height:"+(bWidth-1)+"px;background-position:"+(-X(i))+"px "+(-Y(i))+"px;background-size:"+(bWidth*3)+"px "+(bWidth*4)+"px;'></p>");
							$('#shell').html(html.join(''));
							if( fre_indicator > 0 ) // 用户长按页面任一位置，只随机，不预览
								speller.random();
							else {
							  this.preViewImage();
							  setTimeout(function(){speller.random();},6500);
							}
					}, // createGrid
					preViewImage:function() {
							var seconds = 5;
							var timer = setInterval(printTip,1000);
							$('.status p').html("&nbsp");
		          $('.status p').html("我的灵魂总在<b id='second'>+"+seconds+"</b>秒后凌乱不已。。");
							function printTip() {
								seconds --;
								$("#second").html("+"+seconds);
							  if(seconds < 0) {
							    clearInterval(timer);
							    $(".status p").html("&nbsp");// for fade or hide
							    $(".shell").fadeOut(500);
							    return;	
							  }			  
							}												
					}, // preViewImage
					random:function(p) {
							var ps=document.getElementById("shell").getElementsByTagName("P");
							var l=ps.length;
							var me=this;
							clearTimeout(this);
							$(".shell").fadeIn(500);
							ps[this.blank].style.display="none";
							var en=function(n){
								var arr=[];
								if( n<11 && ((n%3)!=2) )
								  arr.push(n+1);
								if( n>0 && ((n%3)!=0) )
								  arr.push(n-1);
								if( n>2 )
								  arr.push(n-3);
								if( n<6 )
								  arr.push(n+3);
								return arr[parseInt(Math.random()*arr.length)]*1;
							}
							var getp = function(n) { for(var i=0;i<l;i++) {if(ps[i].className==n) {return ps[i];}} }
							for(var i=0;i<me.hard;i++)
								this.move2(getp(en(this.blank*1)));
						  $(".status p").html("&nbsp");
							$(".status p").append("计时: ");
							$(".status p").append("<b id='times'></b>&nbsp&nbsp&nbsp");
							$(".status p").append("步数: ");
							$(".status p").append("<b id='steps'></b>");
              $("#times").html(('0'+parseInt(this.useTime/60)).slice(-2)+':'+('0'+speller.useTime%60).slice(-2));
					    $("#steps").html(('00'+parseInt(this.step)).slice(-3));
					    this.going = true;						    
					}, // random
					move2:function(p) {
							var pos = p.className*1;
							var POS = this.blank*1;
							var abs = Math.abs(pos-POS);
							var max = (pos > POS) ? pos : POS;
							p.style.top = Math.floor(POS/3)*bWidth+"px";
							p.style.left = (POS%3)*bWidth+"px";
							p.className = POS;
							this.blank = pos;
					}, // move2
					move:function(p) {
							var pos=p.className*1;
							var POS=this.blank*1;
							var abs = Math.abs(pos-POS);
							var max = (pos > POS) ? pos : POS;
							if(this.going == false)
							  return;
							if( abs==3 )
								this.fx(Math.floor(pos/3)*bWidth,Math.floor(POS/3)*bWidth,function(x){p.style.top=x+"px";},function(){},100,.4)
							else if( abs==1 && ((max%3)!=0) )
								this.fx(pos%3*bWidth,POS%3*bWidth,function(x){p.style.left=x+"px";},function(){},100,.4)
							else
								return;
							if( this.step==0 ) {
								this.timer=setInterval(function(){
									speller.useTime++;
									document.getElementById("times").innerHTML=('0'+parseInt(speller.useTime/60)).slice(-2)+':'+('0'+speller.useTime%60).slice(-2);
							  },1000);
							}
							p.className = POS;
							this.blank = pos;
							this.step ++;
							$("#steps").html(('00'+parseInt(this.step)).slice(-3));
						  if( this.check() ){
								var me=this;
								var last=document.getElementById("shell").getElementsByTagName("P")[11];
								last.style.display="block";
								this.blank=10000;
								this.fx(0,200,function(x){last.style.opacity=x/200;last.style.filter="alpha(opacity="+x+")";},function(){speller.result();},200,1)
							}
					}, // move
					check:function(){
							var p=document.getElementById("shell").getElementsByTagName("P");
							for(var i=0,l=p.length;i<l;i++){
								if(p[i].className!=p[i].id) {
									return false;
								}
							}
							return true;
					}, // check
					fx:function(f,t,fn,end,tm,pow) {
						var D=Date;
						var d=new D;
						var e;
						var c=tm||240;
						var pow=pow||2;
						return e = setInterval(function() {
							var z=Math.min(1,(new D-d)/c);		
							(false===fn(+f+(t-f)*Math.pow(z,pow),z)||z==1) && end && end(clearTimeout(e));
						  },5);	
					}, // fx
					result:function() {
					  var get_str = "";
					  get_str += "time="+this.useTime+"&";
					  get_str += "step="+this.step+"&";
					  get_str += "zone="+bg_zone;
					  location.href = "result.php?"+get_str;
					}
				} // speller
        
        function gameReady() {
	          initialCanvas();	
	          speller.init(level); // 函数调用
	          document.all&&document.execCommand("BackgroundImageCache", false, true);	          
        }
	   </script>
	</head>
	
	<body onload="gameReady()">
		<div data-role="page" id="screen">
			 <div data-role="content">
			 	 <div class="shell" id="shell"></div>			 	 		   
			 </div>
			 <div data-role="footer" class="status">
			 	<p>&nbsp</p>
			 </div>
		</div>
	</body>	 
			 	
</html>