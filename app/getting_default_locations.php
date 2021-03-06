<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	require_once('dbConnect.php');
	
	$user_id= $_POST['user_id'];
	
	require_once('dbConnect.php');
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	//creating a query
	$stmt = $conn->prepare("SELECT * FROM default_locations  WHERE user_id = '$user_id';");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($user_id,$home,$work_place,$gym);
	
	$products['default_locations']= array(); 
	
	//traversing through all the result 
	if($stmt->fetch()>0){
		
		$temp = array();
		
		$temp['user_id'] = $user_id; 
		$temp['home'] = $home;
		$temp['work_place'] = $work_place;
		$temp['gym'] = $gym; 
		$temp["status"] = "0";
		
		array_push($products['default_locations'], $temp);
	}else{
		$temp["status"] = "1";
		
		array_push($products['default_locations'], $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($products);
}
	

	?>
