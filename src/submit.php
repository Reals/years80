
<?php
    $phone = $_POST['phone'];
    $step = $_POST['step'];
    $time = $_POST['time'];
    $zone = $_POST['zone'];
    
	  function sqlConnect() { // 
	      $sql_links = new SaeMysql();
	      if($sql_links->errno() != 0) // database connection check
	        echo "<script>alert('database connection failed.');</script>";	
	      $sql_links->setCharset("GBK");  
	      return $sql_links;  
	  }

    // database connection    
    $sql_links = sqlConnect();
    $sql_quote = "select * from `score_table` where phone='$phone'";
    $sql_query = $sql_links->getData( $sql_quote );  
    
    if( sizeof($sql_query) == 0) { // if not exist, then write it into table
		   $sql_quote0 = "(`phone`,`step`,`time`,`zone`)";
		   $sql_quote1 = "('$phone','$step','$time','$zone')"; 
		   $sql_quote  = "insert into `score_table` $sql_quote0 values $sql_quote1";
		   $sql_links->runSql($sql_quote);
		   if ($sql_links->errno() != 0) {
		      die("Error:" . $sql_links->errmsg());
		   }    
		   $sql_links->closeDb();   
		   $json_arr = array('rank'=>'102','step'=>$step,'time'=>$time,'zone'=>$zone); 	   	
    	 echo json_encode($json_arr);
    	 return;
    }
    $old_step = $sql_query[0]['step'];
    $old_time = $sql_query[0]['time'];
    $old_zone = $sql_query[0]['zone'];
    $sql_update = "`step`='$step',`time`='$time',`zone`='$zone'";    
    $sql_quote = "update `score_table` set $sql_update where `score_table`.`phone` = '$phone'";
	  $sql_links->runSql($sql_quote);
	  if ($sql_links->errno() != 0) {
	    die("Error:" . $sql_links->errmsg());
	  } 
	  $sql_links->closeDb(); 
	  $json_arr = array('rank'=>'101','step'=>$old_step,'time'=>$old_time,'zone'=>$old_zone);
	  echo json_encode($json_arr);
	  return;
?>