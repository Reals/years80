<!DOCTYPE HTML>

<html>
	<head>
	   <meta charset='gbk' />
	   <title> һ���� | �౦��Ʒ </title>
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
			       case 'fruit': $("#zone").html("ˮ����"); break;	
			       case 'people': $("#zone").html("������"); break;
			       case 'scene': $("#zone").html("�羰��"); break;
			       case 'food': $("#zone").html("��ʳ��"); break;	 
	      	   default: $("#zone").html("δ֪��"); break;			      	  	 	   	
	   	 	   }
           $("#times").html(('0'+parseInt(u_time/60)).slice(-2)+':'+('0'+u_time%60).slice(-2));
           $("#steps").html(('00'+parseInt(u_step)).slice(-3));
           document.body.ontouchmove = function(e) { e.preventDefault(); };
		       $("#submit").click(function(){
		       	 var u_phone = $("#phone").val();
		       	 if( isNaN(u_phone) || u_phone == "") {
		       	   alert("�������ֻ���");
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
						   	 	 $("#t_name").html("�ύʧ���ˡ���");
						   	   return;
						   	 }
	               var json_arr = eval("("+data+")");
	               if( json_arr.length == 0 || !json_arr['rank'] || !json_arr['zone']
	                  || !json_arr['step'] || !json_arr['time'] ) {
	                 alert("�������ݵĽṹ�����뾡����ԣ�");
	                 return;
	               }               
	               $("#sept_line").remove();
	               $("#info").remove();
	               $("#phone").remove();
	               $("#submit").remove();
				   	 	   switch(json_arr['zone']) {
						       case 'fruit': var ch_zone = "ˮ��"; break;	
						       case 'people': var ch_zone = "����"; break;
						       case 'scene': var ch_zone = "�羰"; break;
						       case 'food': var ch_zone = "��ʳ"; break;	 
				      	   default: var ch_zone = "δ֪"; break;			      	  	 	   	
				   	 	   }
	               $(".rank").append("<p>Ŀǰ����<p>");
	               $(".rank").append("<p>ȫ����� <b>"+json_arr['rank']+"</b> λ</p>");
	               $(".rank").append("<p>���ϴ���<font color='red'>"+ch_zone+"</font>������<font color='red'>"+parseInt(json_arr['step'])+"</font>�����ƴͼ���񣬹��ķ�ʱ��<font color='red'>"+parseInt(json_arr['time']/60)+"</font>��<font color='red'>"+parseInt(json_arr['time']%60)+"</font>��</p>");
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
			 <div data-role="header" style="display:none;"><h3> �ɼ��� </h3></div>
			 <div data-role="content">
			 	 <div class="result">
	         <p class="t_name" id="t_name"> �ҵĳɼ��� </p>
	         <p class="t_mark"> 
	         	 ʱ��:<b id="times"></b> &nbsp&nbsp 
	         	 ����:<b id="steps"></b> &nbsp&nbsp
	         	 ѡ��:<b id="zone"></b>
	         </p>			 	 	
			 	 </div>
         <div class="control">
         	   <div class="rank"></div>
         	   <hr id="sept_line">         	   
         	   <p id="info"> ������������Ϣ </p>
          <!--   <input type="text" name="name" id="name" placeholder="���΢�ź�..." /> -->
             <input type="text" name="phone" id="phone" placeholder="����ֻ���..." />
					 	 <button class="ui-btn ui-corner-all ui-shadow" id="submit"> ��&nbsp&nbsp�� </button>
					 	 <button class="ui-btn ui-corner-all ui-shadow" id="backto"> ��&nbsp&nbsp�� </button>	
         </div>  
         <div class="tips">
            <p>�ύ�ɼ���ɲ����������������ң�ֻҪ�ɼ������Ӧ </p>
            <p>����ǰ<font color=red>3</font>�����㽫������ǵ�<font color=red>�ֽ���</font>��������鿴 </p>
            <p><a href="rules.php" target="_blank">����Ϸ��������</a>��</p>
         </div>
			 </div>
			 <div data-role="footer" class="status" style="display:none;">
			 	<p> (C)�౦����(�Ƽ�)���޹�˾ </p>
			 </div>
		</div>
	</body>	 
			 	
</html>