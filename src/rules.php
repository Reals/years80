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
		 	  .ui-page {background-color:rgb(240,240,240);}
		 	  .intent {margin-top:10px;color:black;font-size:14px;text-align:justify;line-height:1.5;}
		 	  .item {color:rgb(100,100,100);margin-top:5px;font-size:13px;text-align:justify;}
		 	  .item b {color:red;}
				/* footer */
		 	  .status p {font-size:15px;rgb(90,90,90);text-align:center;}
		 </style>
	   <script>
	   	 $(document).ready(function(){ 	        	     
		   	  $(".status").offset({top:$(document).height()-$(".status").height()-4,left:0});
	   	 });
	   	 function pageReady() {
	     	  document.body.ontouchmove = function(e) { e.preventDefault(); };
	   	 }  
	   </script>		 
	</head>
	
	<body onload="pageReady()">
		<div data-role="page" data-add-back-btn="true" data-back-btn-text="����">
			 <div data-role="header" style="display:none;"> <h3> �������� </h3>></div>
			 <div data-role="content">
          <div class="intent" style="text-indent: 2em"> <b>��ӭ����౦ƴͼ��Ϸ��Ϊ�˱���С�����ǵ����棬�����ƶ���6������������ </b></div>
          <div class="item"> <b> 1. ��������</b>�����������Ը���ǰ����������Ϊ����Ϸ������ÿ����3���24:00��ֹ��</div>
          <div class="item"> <b> 2. �������</b>����1��100Ԫ����2��50Ԫ����3��20Ԫ�����ڵ��ʷ�ʽ��С���ѿ�����Reals_JIANG˽�¹�ͨ��֧������΢�ź����п����ǿ��Եģ�</div>
          <div class="item"> <b> 3. �콱ʱ��</b>��ÿ��ͳ�����ڽ�����ĵ�1������10��ǰ����С�����Ǽ�ʱ��ע�Լ�������Ŷ������˾�ֻ���ٽ������ˣ�</div>
          <div class="item"> <b> 4. �콱��ʽ</b>�����ȹ�ע�౦��΢�Ź��ں�"�౦����"�������Լ��Ļ�ҳ�棬Ȼ����΢�ź�Reals_JIANG��ϵ��ȡ�ֽ�����</div>
          <div class="item"> <b> 5. ע������</b>���ύ�ɼ�ʱ��������Լ���ȷ��΢�źź��ֻ��ţ���ΪΪ�˰�ȫ�������ȡ�ֽ�ʱ��Щ����Ҫ��ʵ�ģ�����ð��Ͳ��ð��ˣ�</div>
          <div class="item"> <b> 6. �౦ӵ�жԱ�����Ϸ��������Ľ���Ȩ�� </b></div>
			 </div>
			 <div data-role="footer" class="status">
			 	<p> (C)�౦����(����)�Ƽ����޹�˾ </p>
			 </div>
		</div>
	</body>			 	
</html>