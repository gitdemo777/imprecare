<?php
	include("config.php");
	
	$funct = $_REQUEST['function'];
	switch($funct){
		case 'get_list':
				getList();
		      break;
		case 'complete_challenge':
				completeChallenge();
		      break;
		case 'complete_earnmore':
				completeEarnMore();
		      break;
		case 'get_home_detail':
				getHomeDetail();
		      break;
	}               
	
	function getList(){
	       $query="SELECT * FROM app_url Where status='1'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					 $query1="SELECT id FROM complete_challange Where user_id='".$_REQUEST['user_id']."' and app_id='".$data['id']."'";
					$result1 = mysql_query($query1);
					if(mysql_num_rows($result1) == 0){
						$data['is_complete'] = "no";
					}else{
						$data['is_complete'] = "yes";
					}
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function completeChallenge(){
			
			$query="INSERT INTO complete_challange(user_id,app_id) values('".$_REQUEST['user_id']."','".$_REQUEST['app_id']."')";
	      
			if(mysql_query($query)){
				$query2="UPDATE users set completed_challenge = completed_challenge+1 WHERE id='".$_REQUEST['user_id']."'";
				mysql_query($query2);
				
				activeUser();
				
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				$response['success'] = "no";
				$response['message'] = "Something went wrong! please try again.";
				$response['data'] = "";
			}
			
			echo json_encode($response);
			exit;
	}
	
	function activeUser(){
			
			$query="SELECT completed_challenge FROM users Where id='".$_REQUEST['user_id']."'";
	      $result = mysql_query($query);
	      $data = mysql_fetch_array($result);
	      
			if($data['completed_challenge'] >= 10){
				$earning = getEarning($row['current_level']);
				$query2="UPDATE users set status='1' WHERE id='".$_REQUEST['user_id']."'";
				mysql_query($query2);
				
				$query3="SELECT * FROM users where id='".$_REQUEST['user_id']."' and upline_id>0";
				$result3 = mysql_query($query3);
				if(mysql_num_rows($result3) > 0){
						$row = mysql_fetch_array($result3);
						updateJoining($row['upline_id']);
				}
			}
	}
	
	function updateJoining($ref_id){
	       $query="SELECT * FROM users where ref_id='".$ref_id."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$is_upline=true;
				do {
					while($row = mysql_fetch_array($result)){
						$earning = getEarning($row['current_level']);
						$query="UPDATE users set earning=earning+'".$earning."',balance=balance+'".$earning."' WHERE ref_id='".$row['ref_id']."'";
						mysql_query($query);
								
						$query1="SELECT * FROM users where ref_id='".$row['upline_id']."'";
						$result1 = mysql_query($query1);
						if(mysql_num_rows($result1) == 0){
							$is_upline = false;
						}
					}
				}while($is_upline);
			}
	}
	
	function getEarning($level){
			$point=40;
			if($level == '1') {
				$earning = ($point*50)/100;
			}else if($level == '2') {
				$earning = ($point*10)/100;
			}else if($level == '3') {
				$earning = ($point*10)/100;
			}else if($level == '4') {
				$earning = ($point*10)/100;
			}else if($level == '5') {
				$earning = ($point*10)/100;
			}else if($level == '6') {
				$earning = ($point*5)/100;
			}else if($level == '7') {
				$earning = ($point*3)/100;
			}else if($level == '8') {
				$earning = ($point*2)/100;
			}
			return $earning;
	}
	
	function completeEarnMore(){
			$point = $_REQUEST['point']*2;
			$query="INSERT INTO complete_earnmore(user_id,app_id,point) values('".$_REQUEST['user_id']."','".$_REQUEST['app_id']."', '".$point."')";
	      
			if(mysql_query($query)){
				$earning = ($_REQUEST['point']*2)/1000;
				$query2="UPDATE users set earning=earning+'".$earning."',balance=balance+'".$earning."' WHERE id='".$_REQUEST['user_id']."'";
				mysql_query($query2);
				
				updatePoints();
				
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				$response['success'] = "no";
				$response['message'] = "Something went wrong! please try again.";
				$response['data'] = "";
			}
			
			echo json_encode($response);
			exit;
	}
	
	function updatePoints(){
			$query3="SELECT * FROM users where id='".$_REQUEST['user_id']."' and upline_id>0";
			$result3 = mysql_query($query3);
			if(mysql_num_rows($result3) > 0){
					$row = mysql_fetch_array($result3);
					updateUplinePoints($row['upline_id']);
			}
	}
	
	function updateUplinePoints($ref_id){
	       $query="SELECT * FROM users where ref_id='".$ref_id."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$is_upline=true;
				do {
					while($row = mysql_fetch_array($result)){
						$point = getPoints($row['current_level'],$_REQUEST['point']*2);
						$earning = $point/1000;
						$query="UPDATE users set earning=earning+'".$earning."',balance=balance+'".$earning."' WHERE ref_id='".$row['ref_id']."'";
						mysql_query($query);
								
						$query1="SELECT * FROM users where ref_id='".$row['upline_id']."'";
						$result1 = mysql_query($query1);
						if(mysql_num_rows($result1) == 0){
							$is_upline = false;
						}
					}
				}while($is_upline);
			}
	}
	
	function getPoints($level,$point){
			if($level == '1') {
				$earning = ($point*50)/100;
			}else if($level == '2') {
				$earning = ($point*10)/100;
			}else if($level == '3') {
				$earning = ($point*10)/100;
			}else if($level == '4') {
				$earning = ($point*10)/100;
			}else if($level == '5') {
				$earning = ($point*10)/100;
			}else if($level == '6') {
				$earning = ($point*5)/100;
			}else if($level == '7') {
				$earning = ($point*3)/100;
			}else if($level == '8') {
				$earning = ($point*2)/100;
			}
			return $earning;
	}
	
	function getHomeDetail(){
		$user_id = $_REQUEST['user_id'];
		    $query="SELECT * FROM users Where id='".$user_id."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				$data = mysql_fetch_array($result);
				$ref_id = $data['ref_id'];
				$query1="SELECT * FROM users where ref_id!='".$ref_id."'";
				$result1 = mysql_query($query1);
				$data1 = array();
				if(mysql_num_rows($result1) > 0){
					while($row = mysql_fetch_array($result1)){
						$data1[] = $row;				
					}
				}
				$list = fetch_recursive($data1, $ref_id);
				$dataArray['total_joining'] = $data['joining'];
				$dataArray['today_joining'] = getTodayJoining($list)."";
				$dataArray['yesterday_joining'] = getYesterdayJoining($list)."";
				$dataArray['month_joining'] = getMonthJoining($list)."";
				$dataArray['current_balance'] = $data['balance'];
				$dataArray['total_earning'] = $data['earning'];
				$dataArray['today_earning'] = getTodayEarning($user_id)."";
				$dataArray['yesterday_earning'] = getYesterdayEarning($user_id)."";
				$dataArray['month_earning'] = getMonthEarning($user_id)."";
				$dataArray['total_earn_more'] = getTotalEarnMore($user_id)."";
				$dataArray['today_earn_more'] = getTodayEarning($user_id)."";
				
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function getTodayJoining($list){
		$return = 0;
		foreach($list as $drow){
			if(date('d-m-Y') == date("d-m-Y", strtotime($drow['created_date']))){
				$return++;					
			}
		}
		return $return;
	}
	
	function getYesterdayJoining($list){
		$return = 0;
		foreach($list as $drow){
			if(date('d-m-Y', strtotime("-1 days")) == date("d-m-Y", strtotime($drow['created_date']))){
				$return++;					
			}
		}	
		return $return;
	}
	
	function getMonthJoining($list){
		$return = 0;
		foreach($list as $drow){
			if(date('m-Y') == date("m-Y", strtotime($drow['created_date']))){
				$return++;					
			}
		}
		return $return;
	}
	
	function getTodayEarning($user_id){
		$query="SELECT SUM(point) as total FROM complete_earnmore where user_id='".$user_id."' and DATE(`created_date`) = CURDATE()";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$data = mysql_fetch_array($result);
				$return = $data['total']/1000;
			}else{
				$return = 0;
			}
		return $return;
	}
	
	function getYesterdayEarning($user_id){
		$query="SELECT SUM(point) as total FROM complete_earnmore where user_id='".$user_id."' and DATE(`created_date`) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY))";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$data = mysql_fetch_array($result);
				$return = $data['total']/1000;
			}else{
				$return =  0;
			}
		return $return;
	}
	
	function getMonthEarning($user_id){
		$query="SELECT SUM(point) as total FROM complete_earnmore where user_id='".$user_id."' and MONTH(`created_date`) = MONTH(CURDATE())";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$data = mysql_fetch_array($result);
				$return = $data['total']/1000;
			}else{
				$return = 0;
			}
		return $return;
	}
	
	function getTotalEarnMore($user_id){
		$query="SELECT SUM(point) as total FROM complete_earnmore where user_id='".$user_id."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$data = mysql_fetch_array($result);
				$return = $data['total']/1000;
			}else{
				$return = 0;
			}
		return $return;
	}
	
	function fetch_recursive($src_arr, $currentid, $parentfound = false, $list = array())
	{
	    foreach($src_arr as $row)
	    {
	    	  if((!$parentfound && $row['ref_id'] == $currentid) || $row['upline_id'] == $currentid)
	        {
	            $rowdata = array();
	            foreach($row as $k => $v)
	                $rowdata[$k] = $v;
	            $list[] = $rowdata;
	            if($row['upline_id'] == $currentid)
	                $list = array_merge($list, fetch_recursive($src_arr, $row['id'], true));
	        }
	    }
	    return $list;
	}
?>
