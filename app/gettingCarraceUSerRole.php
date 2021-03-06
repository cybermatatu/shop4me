<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	require_once('dbConnect.php');
	
	$strRole = $_POST['strRole'];
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	
	
	//creating a query
	$stmt = $conn->prepare("SELECT * FROM c_users WHERE strRole = '$strRole';");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id,$strUserId,$strUsername,$strPhone,$strImageUrl,$strEmail,$strYear,$strPassword,$strRole);
	
	$products['users'] = array(); 
	$response = array();
	
	//traversing through all the result 
	if($stmt->fetch()>0){

		$temp = array();		
		$temp['id'] = $id;
		$temp['strUserId'] = $strUserId;
		$temp['strUsername'] = $strUsername;
		$temp['strPhone'] = $strPhone;
		$temp['strImageUrl'] = $strImageUrl;
		$temp['strEmail'] = $strEmail;
		$temp['strYear'] = $strYear;
		$temp['strRole'] = $strRole;

        $temp["status"] = "0";
        $temp["message"] = "there..!";

		array_push($products['users'], $temp);
	
	//displaying the result in json format 
    	echo json_encode($products);
	
	}else {
        // failed to insert row
        $response["status"] = "1";
        $response["message"] = "Not there..!";
    // echoing JSON response
        echo json_encode($response);
    }
	
}
	?>
