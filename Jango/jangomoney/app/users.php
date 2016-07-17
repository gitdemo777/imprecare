<?php
	include("config.php");
	
	$funct = $_REQUEST['function'];
	switch($funct){
		case 'login':
				doLogin();
		      break;
		case 'registration':
	           doRegistration();
	           break; 
		case 'update_profile':
		        updateProfile();
	           break; 
	   case 'get_profile':
		        getProfile();
	           break; 
		case 'forgot_password':
	           forgotPassword();
	           break;
	   case 'change_password':
	           changePassword();
	           break;
	   case 'get_country':
	           getCountry();
	           break;
	    case 'get_earn_more':
	           getEarnMore();
	           break;
	    case 'get_earn_more_by_country':
	           getEarnMoreByCountry();
	           break;       
	    case 'get_invite_earn_more':
	           getInviteEarnMore();
	           break;
	    case 'get_invite_earn_unlimited':
	           getInviteEarnUnlimited();
	           break;     
	     case 'get_users_level':
	           getUsersLevel();
	           break;   
	      case 'check_password':
	           checkPassword();
	           break;     
	     case 'get_upline':
	           getUpline();
	           break;
	     case 'get_network':
	           getNetwork();
	           break;         
	     case 'get_rank':
	           getRank();
	           break;      
	     case 'search_user':
	           searchUser();
	           break;       
	     case 'get_hot_list':
	           getHotList();
	           break;     
	     case 'verify_user':
	           verifyUser();
	           break;    
	     case 'check_device':
	           checkDevice();
	           break;
	     case 'remove_account':
	           removeAccount();
	           break;    
	     case 'send_feedback':
	           sendFeedback();
	           break;
	     case 'active_id':
	           activeID();
	           break;   
	     case 'get_balance':
	           getBalance();
	           break;                                            
	}               
	
	function doLogin(){
			$ref_id = $_REQUEST['ref_id'];
	      $query="SELECT * FROM users Where ref_id='".$ref_id."' and password='".$_REQUEST['password']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "Enter valid reference id or password.";
				$response['data'] = "";
			}else{
				$query1="UPDATE users set device_id = '".$_REQUEST['device_id']."'  WHERE ref_id='".$ref_id."'";
				mysql_query($query1);
				
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = mysql_fetch_array($result);
			}
			echo json_encode($response);
			exit;
	}
	
	function doRegistration(){
			$query="SELECT * FROM users Where email='".$_REQUEST['email']."'";
			$result = mysql_query($query);
			
			if(mysql_num_rows($result) > 0){
				$response['success'] = "no";
				$response['message'] = "Email already exist.";
				$response['data'] = "";
			} else {
				$query1="SELECT ref_id from users order by ref_id desc limit 1";
				$result1 = mysql_query($query1);
				if(mysql_num_rows($result1)>0){
					$dataref = mysql_fetch_array($result1);
					$ref_id=intval($dataref['ref_id'])+1;
				}else{
					$ref_id=101;	
				}
		      $query="INSERT INTO users(fb_id,device_id,ref_id,upline_id,first_name,last_name,email,password,phone,birth_date,country) values('".$_REQUEST['fb_id']."','".$_REQUEST['device_id']."','".$ref_id."','".$_REQUEST['upline_id']."','".$_REQUEST['first_name']."','".$_REQUEST['last_name']."','".$_REQUEST['email']."','".$_REQUEST['password']."','".$_REQUEST['phone']."','".$_REQUEST['birth_date']."','".$_REQUEST['country']."')";
				if(mysql_query($query)){
					updateJoining($_REQUEST['upline_id']);
					
					$query2="SELECT * FROM users Where device_id='".$_REQUEST['device_id']."'";
					$result2 = mysql_query($query2);
					$row2 = mysql_fetch_array($result2);
					
					$response['success'] = "yes";
					$response['message'] = "Registered successfully.";
					$response['data'] = $row2;
				}else{
					$response['success'] = "no";
					$response['message'] = "Something went wrong! please try again.";
					$response['data'] = "";
				}
			}
			echo json_encode($response);
			exit;
	}
	
	function updateJoining($ref_id){
	       $query="SELECT * FROM users where ref_id='".$ref_id."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				$is_upline=true;
				do {
					while($row = mysql_fetch_array($result)){
						$level = getLevel($row['joining']);
						$query="UPDATE users set joining=joining+1,current_level='".$level."'  WHERE ref_id='".$row['ref_id']."'";
						mysql_query($query);
								
						$query1="SELECT * FROM users where ref_id='".$row['upline_id']."'";
						$result = mysql_query($query1);
						if(mysql_num_rows($result) == 0){
							$is_upline = false;
						}
					}
				}while($is_upline);
			}
			return true;
	}
	
	function getLevel($joining){
			if($joining+1 <= 10) {
				$level = 1;
			}else if($joining+1 <= 100) {
				$level = 2;
			}else if($joining+1 <= 1000) {
				$level = 3;
			}else if($joining+1 <= 10000) {
				$level = 4;
			}else if($joining+1 <= 100000) {
				$level = 5;
			}else if($joining+1 <= 1000000) {
				$level = 6;
			}else if($joining+1 <= 10000000) {
				$level = 7;
			}else if($joining+1 <= 100000000) {
				$level = 8;
			}
			return $level;
	}
	
	function updateProfile(){
			$query1="SELECT * FROM users Where email='".$_REQUEST['email']."' and id!='".$_REQUEST['user_id']."'";
			$result1 = mysql_query($query1);
			
			if(mysql_num_rows($result1) > 0){
				$response['success'] = "no";
				$response['message'] = "Email already exist.";
				$response['data'] = "";
			}else {
				$pro="";
				if(isset($_FILES['file'])) {
					$profile = $_REQUEST['user_id']."_image.jpg";
					$target = './images/'.$profile;
					move_uploaded_file( $_FILES['file']['tmp_name'], $target);
					$pro = ",profile_image='".$profile."'";
				}
		      $query="UPDATE users set first_name = '".$_REQUEST['first_name']."' , email = '".$_REQUEST['email']."' , phone = '".$_REQUEST['phone']."', is_visible = '".$_REQUEST['is_visible']."', is_notification = '".$_REQUEST['is_notification']."' ".$pro."  WHERE id='".$_REQUEST['user_id']."'";
				if(mysql_query($query)){
					$response['success'] = "yes";
					$response['message'] = "Updated successfully.";
					$response['data'] = "";
				}else{
					$response['success'] = "no";
					$response['message'] = "Something went wrong! please try again.";
					$response['data'] = "";
				}
			}
			echo json_encode($response);
			exit;
	}
	
	function getProfile(){
	       $query="SELECT * FROM users Where id='".$_REQUEST['user_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				$data = mysql_fetch_array($result);
				$query1="SELECT * FROM users where ref_id='".$data['upline_id']."'";
				$result1 = mysql_query($query1);
				$data1 = mysql_fetch_array($result1);
				$data['upline_contact'] = $data1['phone'];
				if($data['profile_image'] != '') {
					$data['profile_image'] = "./images/".$data['profile_image'];
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $data;
			}
			echo json_encode($response);
			exit;
	}
	
	function forgotPassword(){
	      $query="SELECT * FROM users Where email='".$_REQUEST['email']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "Enter valid email.";
				$response['data'] = "";
			}else{
				$encrypt = randomPassword();
            $message = "Your password send to your e-mail address.";
            $to=$_REQUEST['email'];
            $subject="JangoMoney - Forget Password";
            $from = 'info@jangomoney.com';
            $body='Hi, <br/> <br/>Your new password is: '.$encrypt.' .';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
				if(mail($to,$subject,$body,$headers)){
					$data = mysql_fetch_array($result);
					$query="UPDATE users set password = '".$encrypt."' where id='".$data['id']."'";
					mysql_query($query);
				
					$response['success'] = "yes";
					$response['message'] = $message;
					$response['data'] = "";
				}else{
					$response['success'] = "no";
					$response['message'] = "Something went wrong! please try again.";
					$response['data'] = "";
				}
			}
			echo json_encode($response);
			exit;
	}
	
	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	function changePassword(){
	      $query="SELECT * FROM users Where id='".$_REQUEST['user_id']."' and password='".$_REQUEST['old_password']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "Enter correct old password.";
				$response['data'] = "";
			}else{
				$query="UPDATE users set password='".$_REQUEST['new_password']."' where id='".$_REQUEST['user_id']."'";
				if(mysql_query($query)){
					$response['success'] = "yes";
					$response['message'] = "Password changed successfully.";
					$response['data'] = "";
				}else{
					$response['success'] = "no";
					$response['message'] = "Something went wrong! please try again.";
					$response['data'] = "";
				}
			}
			echo json_encode($response);
			exit;
	}
	
	function getCountry(){
	       $query="SELECT * FROM country";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function getEarnMore(){
	       $query="SELECT * FROM earn_more where status='1'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$query1="SELECT id FROM complete_earnmore Where user_id='".$_REQUEST['user_id']."' and app_id='".$data['id']."'";
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
	
	function getEarnMoreByCountry(){
	       $query="SELECT * FROM earn_more where country_id='".$_REQUEST['country_id']."' and status='1'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function getInviteEarnMore(){
	       $query="SELECT * FROM invite_earn_more where status='1'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function getInviteEarnUnlimited(){
	       $query="SELECT * FROM invite_earn_unlimited where status='1'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function getUsersLevel(){
	       $query="SELECT * FROM user_level where user_id='".$_REQUEST['user_id']."' order by level";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function checkPassword(){
	       $query="SELECT id FROM users where id='".$_REQUEST['user_id']."' and password='".$_REQUEST['password']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "Enter correct password.";
				$response['data'] = "";
			}else{
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = "";
			}
			echo json_encode($response);
			exit;
	}
	
	function getUpline(){
	       $query="SELECT * FROM users where ref_id='".$_REQUEST['ref_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "No record found.";
				$response['data'] = "";
			}else{
				$query2="SELECT * FROM rank";
				$result2 = mysql_query($query2);
				while($row2 = mysql_fetch_array($result2)){
					$rankArray[] = $row2;
				}
			
				$is_upline=true;
				do {
					while($row = mysql_fetch_array($result)){
						if($row['rank'] == 0){
							$row['rank'] = "";
						}else{
							$row['rank'] = getCurrentRank($rankArray,$row['rank']);						
						}
						$data[] = $row;			
						$query1="SELECT * FROM users where ref_id='".$row['upline_id']."'";
						$result = mysql_query($query1);
						if(mysql_num_rows($result) == 0){
							$is_upline = false;
						}
					}
				}while($is_upline);
				$new = array();
				foreach ($data as $key => $row)
				{
				    $new[$key] = $row['ref_id'];
				}
				array_multisort($new, SORT_ASC, $data);
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $data;
			}
			echo json_encode($response);
			exit;
	}
	
	function getCurrentRank($rankArray,$rank){
		for($i=0;$i<count($rankArray);$i++)
		{
			if($rankArray[$i]['id'] == $rank) {
				$rank = $rankArray[$i]['name'];
				break;	
			}
		}
		
		return $rank;
	}
	
	function getNetwork(){
	       $query="SELECT * FROM users where ref_id!='".$_REQUEST['ref_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "No record found.";
				$response['data'] = "";
			}else{
				while($row = mysql_fetch_array($result)){
					$data[] = $row;				
				}
				
				$list = fetch_recursive($data, $_REQUEST['ref_id']);
				$new = array();
				foreach ($list as $key => $row)
				{
				    $new[$key] = $row['upline_id'];
				}
				array_multisort($new, SORT_ASC, $list);
				
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $list;
			}
			echo json_encode($response);
			exit;
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
	
	function getRank(){
	       $query="SELECT * FROM rank";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function searchUser(){
			$con = "1";
			$order = "";
			if(isset($_REQUEST['ref_id']) && $_REQUEST['ref_id'] != '') {
				$con .= " and ref_id='".$_REQUEST['ref_id']."'";	
			}
			if(isset($_REQUEST['phone']) && $_REQUEST['phone'] != '') {
				$con .= " and phone='".$_REQUEST['phone']."'";	
			}
			if(isset($_REQUEST['level']) && $_REQUEST['level'] > 0) {
				$con .= " and current_level='".$_REQUEST['level']."'";	
			}
			if(isset($_REQUEST['order_by'])) {
				if(strtolower($_REQUEST['order_by']) == 'toppers up') {
					$order = "order by rank desc";
				}else if(strtolower($_REQUEST['order_by']) == 'new up') {
					$order = "order by created_date desc";
				}else if(strtolower($_REQUEST['order_by']) == 'old up') {
					$order = "order by created_date asc";
				}
			}
			if(isset($_REQUEST['sort_by'])) {
				if(strtolower($_REQUEST['sort_by']) == 'challenge active') {
					$con .= " and status='1'";
				}else if(strtolower($_REQUEST['sort_by']) == 'challenge pending') {
					$con .= " and status='0'";
				}
			}
			if(isset($_REQUEST['rank']) && $_REQUEST['rank'] > 0) {
				$con .= " and rank='".$_REQUEST['rank']."'";	
			}
			if(isset($_REQUEST['country']) && $_REQUEST['country'] > 0) {
				$con .= " and country='".$_REQUEST['country']."'";	
			}
	       $query="SELECT * FROM users where $con $order";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				while($data = mysql_fetch_array($result)) {
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function getHotList(){
	       $query="SELECT * FROM users order by joining desc limit 50";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				$query1="SELECT * FROM users";
				$result1 = mysql_query($query1);
				$data1 = array();
				if(mysql_num_rows($result1) > 0){
					while($row = mysql_fetch_array($result1)){
						$data1[] = $row;				
					}
				}
				while($data = mysql_fetch_array($result)) {
					if($data['profile_image'] != '') {
						$data['profile_image'] = "./images/".$data['profile_image'];
					}
					$ref_id = $data['ref_id'];
					$list = fetch_recursive($data1, $ref_id);
					$data['total_joining'] = $data['joining'];
					$data['joining'] = getMonthJoining($list)."";
					$dataArray[] = $data;
				}
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = $dataArray;
			}
			echo json_encode($response);
			exit;
	}
	
	function getMonthJoining($list){
		$return = -1;
		foreach($list as $drow){
			if(date('m-Y') == date("m-Y", strtotime($drow['created_date']))){
				$return++;					
			}
		}
		return $return;
	}
	
	function getTotalJoining($level){
			if($level == '1') {
				$joining = 10;
			}else if($level == '2') {
				$joining = 100;
			}else if($level == '3') {
				$joining = 1000;
			}else if($level == '4') {
				$joining = 10000;
			}else if($level == '5') {
				$joining = 100000;
			}else if($level == '6') {
				$joining = 1000000;
			}else if($level == '7') {
				$joining = 10000000;
			}else if($level == '8') {
				$joining = 100000000;
			}
			return $joining;
	}
	
	function verifyUser(){
	       $query="SELECT * FROM users Where ref_id='".$_REQUEST['ref_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "Enter correct reference ID.";
				$response['data'] = "";
			}else{
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = mysql_fetch_array($result);
			}
			echo json_encode($response);
			exit;
	}
	
	function checkDevice(){
	       $query="SELECT * FROM users Where device_id='".$_REQUEST['device_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = mysql_fetch_array($result);
			}
			echo json_encode($response);
			exit;
	}
	
	function removeAccount(){
		      $query="UPDATE users set device_id = '' WHERE id='".$_REQUEST['user_id']."'";
				if(mysql_query($query)){
					$response['success'] = "yes";
					$response['message'] = "Deleted successfully.";
					$response['data'] = "";
				}else{
					$response['success'] = "no";
					$response['message'] = "Something went wrong! please try again.";
					$response['data'] = "";
				}
			
			echo json_encode($response);
			exit;
	}
	
	function sendFeedback(){
			$query="INSERT INTO feedback(type,name,email,message) values('".$_REQUEST['type']."','".$_REQUEST['name']."','".$_REQUEST['email']."','".$_REQUEST['message']."')";
	      
			if(mysql_query($query)){
				$response['success'] = "yes";
				$response['message'] = "Feedback saved successfully.";
				$response['data'] = "";
			}else{
				$response['success'] = "no";
				$response['message'] = "Something went wrong! please try again.";
				$response['data'] = "";
			}
			
			echo json_encode($response);
			exit;
	}
	
	function activeID(){
			$query="SELECT * FROM activator_id Where user_id='".$_REQUEST['user_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 1){
				$response['success'] = "no";
				$response['message'] = "You already active maximum no. of ID.";
				$response['data'] = "";
			}else{
				if(checkUpline()){
				$query1="INSERT INTO activator_id(user_id,ref_id) values('".$_REQUEST['user_id']."','".$_REQUEST['ref_id']."')";
				mysql_query($query1);
				
				$query2="UPDATE users set status = '1' WHERE ref_id='".$_REQUEST['ref_id']."'";
				mysql_query($query2);
				
				$response['success'] = "yes";
				$response['message'] = "ID activated successfully.";
				$response['data'] = "";
				}else{
					$response['success'] = "no";
					$response['message'] = "Enter correct reference ID.";
					$response['data'] = "";
				}
			}
			
			echo json_encode($response);
			exit;
	}
	
	function checkUpline(){
	       $query="SELECT * FROM users where ref_id='".$_REQUEST['ref_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				return false;
			}else{
				$is_upline=true;
				do {
					while($row = mysql_fetch_array($result)){
						$query1="SELECT * FROM users where ref_id='".$row['upline_id']."'";
						$result = mysql_query($query1);
						if(mysql_num_rows($result) == 0){
							$is_upline = false;
						}
						if($row['id'] == $_REQUEST['user_id']) {
							return true;
						}
					}
				}while($is_upline);
				return false;
			}
			return false;
	}
	
	function checkNetwork(){
	       $query="SELECT * FROM users where id!='".$_REQUEST['user_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				return false;
			}else{
				while($row = mysql_fetch_array($result)){
					$data[] = $row;				
				}
				
				$list = fetch_recursive($data, $_REQUEST['ref_id']);
				$new = array();
				foreach ($list as $key => $row)
				{
				    $new[$key] = $row['upline_id'];
				}
				array_multisort($new, SORT_ASC, $list);
				print_r($new);
				return true;
			}
			return false;
	}
	
	function getBalance(){
			$query="SELECT joining,earning,balance FROM users where id='".$_REQUEST['user_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) == 0){
				$response['success'] = "no";
				$response['message'] = "";
				$response['data'] = "";
			}else{
				$response['success'] = "yes";
				$response['message'] = "";
				$response['data'] = mysql_fetch_array($result);
			}
			echo json_encode($response);
			exit;
	}
?>
