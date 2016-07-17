<?php
	include("config.php");
	
	$funct = $_REQUEST['function'];
	switch($funct){
		case 'save_detail':
				saveDetail();
		      break;
		 case 'get_detail':
				getDetail();
		      break;
		case 'get_debit_detail':
				getDebitDetail();
		      break;
		case 'get_bank_detail':
				getBankDetail();
		      break;
		case 'get_joining_detail':
				getJoiningDetail();
		      break;
		case 'get_earn_more_detail':
				getEarnMoreDetail();
		      break;
		case 'get_bonus_detail':
				getBonusDetail();
		      break;
		case 'get_credit_detail':
				getCreditDetail();
		      break;      
	}               
	
	function saveDetail(){
			$query="SELECT * FROM bank_detail Where user_id='".$_REQUEST['user_id']."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) > 0){
				 $query1="UPDATE bank_detail set account_no='".$_REQUEST['account_no']."',ifsc_code='".$_REQUEST['ifsc_code']."',amount='".$_REQUEST['amount']."',holder_name='".$_REQUEST['holder_name']."',state='".$_REQUEST['state']."',address='".$_REQUEST['address']."',pan_no='".$_REQUEST['pan_no']."' Where user_id='".$_REQUEST['user_id']."'";
				if(mysql_query($query1)){
					$response['success'] = "yes";
					$response['message'] = "Detail updated successfully.";
					$response['data'] = "";
				}else{
					$response['success'] = "no";
					$response['message'] = "Something went wrong! please try again.";
					$response['data'] = "";
				}
			}else{
		      $query2="INSERT INTO bank_detail(user_id,account_no,ifsc_code,amount,holder_name,state,address,pan_no) values('".$_REQUEST['user_id']."','".$_REQUEST['account_no']."','".$_REQUEST['ifsc_code']."','".$_REQUEST['amount']."','".$_REQUEST['holder_name']."','".$_REQUEST['state']."','".$_REQUEST['address']."','".$_REQUEST['pan_no']."')";
				if(mysql_query($query2)){
					$response['success'] = "yes";
					$response['message'] = "Detail saved successfully.";
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
	
	function getDetail(){
	       $query="SELECT * FROM bank_detail Where user_id='".$_REQUEST['user_id']."'";
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
	
	function getDebitDetail(){
	       $query="SELECT * FROM transaction Where user_id='".$_REQUEST['user_id']."' and type='debit' order by id desc";
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
	
	function getBankDetail(){
	       $query="SELECT * FROM transaction Where user_id='".$_REQUEST['user_id']."' and type='bank' order by id desc";
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
	
	function getJoiningDetail(){
	       $query="SELECT * FROM transaction Where user_id='".$_REQUEST['user_id']."' and type='joining' order by id desc";
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
	
	function getEarnMoreDetail(){
	       $query="SELECT * FROM transaction Where user_id='".$_REQUEST['user_id']."' and type='earn more' order by id desc";
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
	
	function getBonusDetail(){
	       $query="SELECT * FROM transaction Where user_id='".$_REQUEST['user_id']."' and type='bonus' order by id desc";
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
	
	function getCreditDetail(){
	       $query="SELECT * FROM transaction Where user_id='".$_REQUEST['user_id']."' and type='credit' order by id desc";
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
