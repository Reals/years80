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
		<div data-role="page" data-add-back-btn="true" data-back-btn-text="返回">
			 <div data-role="header" style="display:none;"> <h3> 奖励规则 </h3>></div>
			 <div data-role="content">
          <div class="intent" style="text-indent: 2em"> <b>欢迎参与多宝拼图游戏，为了保障小盆友们的利益，我们制定了6大条奖励规则： </b></div>
          <div class="item"> <b> 1. 奖励对象</b>：奖励仅征对各区前三名，周期为自游戏上线起每个第3天的24:00截止；</div>
          <div class="item"> <b> 2. 奖励金额</b>：第1名100元，第2名50元，第3名20元，关于到帐方式，小盆友可以与Reals_JIANG私下沟通，支付宝、微信和银行卡都是可以的；</div>
          <div class="item"> <b> 3. 领奖时间</b>：每个统计周期结束后的第1天上午10点前，请小盆友们及时关注自己的排名哦，错过了就只能再接再励了；</div>
          <div class="item"> <b> 4. 领奖方式</b>：请先关注多宝的微信公众号"多宝互动"并分享自己的获奖页面，然后，与微信号Reals_JIANG联系领取现金奖励；</div>
          <div class="item"> <b> 5. 注意事项</b>：提交成绩时务必输入自己正确的微信号和手机号，因为为了安全起见，领取现金时这些都是要核实的，否则被冒领就不好办了；</div>
          <div class="item"> <b> 6. 多宝拥有对本次游戏奖励规则的解释权。 </b></div>
			 </div>
			 <div data-role="footer" class="status">
			 	<p> (C)多宝互动(北京)科技有限公司 </p>
			 </div>
		</div>
	</body>			 	
</html>