<!DOCTYPE HTML>

<html>
	<head>
	   <meta charset='gbk' />
	   <title> 一起玩 | 多宝出品 </title>
	   <meta name="viewport" content="width=device-width, initial-scale=1" />
     <link rel="shortcut icon" type="image/x-icon" href="image/title.ico" />
		 <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		 <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		 <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> 
		 <style type="text/css">
		 	  /* content */
		 	  body {-webkit-user-select:none;user-select:none;}
		 	  .ui-page {background-color:rgb(240,240,240);}
		 	  .result b {color:red;}
		 	  .t_name {margin-top:10px;text-align:center;font-size:18px;font-weight:bold;color:green;}
		 	  .t_mark {text-align:center;font-size:16px;color:green;}
		 	  .rank p {text-align:center;font-size:16px;}
		 	  .rank b {text-align:center;font-size:18px;color:red;}
		 	  .control {color:green;}
		 	  .control p {margin-top:20px;font-size:15px;text-align:center;font-weight:bold;}
		 	  .tips {color:gray;font-size:10px;text-align:center;}
		 	  #name,$phone {text-align:center;line-height:15px;}
				/* footer */
				.status {-webkit-user-select:none;user-select:none;}
		 	  .status p {font-size:15px;color:green;text-align:center;}
		 </style>
		 
		 <?php
	     echo "<script>";
		   echo "var u_step=".str_replace(" ","",$_GET['step']).";";
		   echo "var u_time=".str_replace(" ","",$_GET['time']).";";
		   echo "var u_zone='".str_replace(" ","",$_GET['zone'])."';";
		   echo "</script>";
		 ?>
		 
     <script>
	   	 $(document).ready(function(){ 	        	     
		   	   $(".status").offset({top:$(document).height()-$(".status").height()-4,left:0});
	   	 });	  
	   	 function pageReady() {
	   	 	   switch(u_zone) {
			       case 'fruit': $("#zone").html("水果区"); break;	
			       case 'people': $("#zone").html("人物区"); break;
			       case 'scene': $("#zone").html("风景区"); break;
			       case 'food': $("#zone").html("美食区"); break;	 
	      	   default: $("#zone").html("未知区"); break;			      	  	 	   	
	   	 	   }
           $("#times").html(('0'+parseInt(u_time/60)).slice(-2)+':'+('0'+u_time%60).slice(-2));
           $("#steps").html(('00'+parseInt(u_step)).slice(-3));
           document.body.ontouchmove = function(e) { e.preventDefault(); };
		       $("#submit").click(function(){
		       	 var u_phone = $("#phone").val();
		       	 if( isNaN(u_phone) || u_phone == "") {
		       	   alert("请输入手机号");
		       	   return false;	
		       	 }
					   $.post("submit.php",
						   {
						     'phone': u_phone,
						     'step': u_step,
						     'time': u_time,
						     'zone': u_zone
						   },
						   function(data,status){
						   	 if( (status) != "success" ) {
						   	 	 $("#t_name").html("提交失败了。。");
						   	   return;
						   	 }
	               var json_arr = eval("("+data+")");
	               if( json_arr.length == 0 || !json_arr['rank'] || !json_arr['zone']
	                  || !json_arr['step'] || !json_arr['time'] ) {
	                 alert("返回数据的结构有误，请尽快调试！");
	                 return;
	               }               
	               $("#sept_line").remove();
	               $("#info").remove();
	               $("#phone").remove();
	               $("#submit").remove();
				   	 	   switch(json_arr['zone']) {
						       case 'fruit': var ch_zone = "水果"; break;	
						       case 'people': var ch_zone = "人物"; break;
						       case 'scene': var ch_zone = "风景"; break;
						       case 'food': var ch_zone = "美食"; break;	 
				      	   default: var ch_zone = "未知"; break;			      	  	 	   	
				   	 	   }
	               $(".rank").append("<p>目前排名<p>");
	               $(".rank").append("<p>全世界第 <b>"+json_arr['rank']+"</b> 位</p>");
	               $(".rank").append("<p>你上次在<font color='red'>"+ch_zone+"</font>区花了<font color='red'>"+parseInt(json_arr['step'])+"</font>步完成拼图任务，共耗费时间<font color='red'>"+parseInt(json_arr['time']/60)+"</font>分<font color='red'>"+parseInt(json_arr['time']%60)+"</font>秒</p>");
	               $(".rank").css({'display':'block'});
						   });
		       });
		       $("#backto").click(function(){
		       	 location.href = "../index.php";
       	   });
       }
	   </script>
	</head>
	
	<body onload="pageReady()">
		<div data-role="page">
			 <div data-role="header" style="display:none;"><h3> 成绩单 </h3></div>
			 <div data-role="content">
			 	 <div class="result">
	         <p class="t_name" id="t_name"> 我的成绩单 </p>
	         <p class="t_mark"> 
	         	 时间:<b id="times"></b> &nbsp&nbsp 
	         	 步数:<b id="steps"></b> &nbsp&nbsp
	         	 选区:<b id="zone"></b>
	         </p>			 	 	
			 	 </div>
         <div class="control">
         	   <div class="rank"></div>
         	   <hr id="sept_line">         	   
         	   <p id="info"> 请输入以下信息 </p>
          <!--   <input type="text" name="name" id="name" placeholder="你的微信号..." /> -->
             <input type="text" name="phone" id="phone" placeholder="你的手机号..." />
					 	 <button class="ui-btn ui-corner-all ui-shadow" id="submit"> 提&nbsp&nbsp交 </button>
					 	 <button class="ui-btn ui-corner-all ui-shadow" id="backto"> 返&nbsp&nbsp回 </button>	
         </div>  
         <div class="tips">
            <p>提交成绩后可参与世界排名，而且，只要成绩进入对应 </p>
            <p>区域前<font color=red>3</font>名，你将获得我们的<font color=red>现金奖励</font>，具体请查看 </p>
            <p><a href="rules.php" target="_blank">《游戏奖励规则》</a>。</p>
         </div>
			 </div>
			 <div data-role="footer" class="status" style="display:none;">
			 	<p> (C)多宝互动(科技)有限公司 </p>
			 </div>
		</div>
	</body>	 
			 	
</html>