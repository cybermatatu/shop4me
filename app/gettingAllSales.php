<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
	
	require_once('dbConnect.php');
	
	$strDate= $_POST['strDate'];	
	
	//$conn = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
	
	//Checking if any error occured while connecting
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}
	
	
	
	//creating a query
	$stmt = $conn->prepare("SELECT * FROM cs_sales WHERE strDate = '$strDate' ORDER BY id DESC");
	
	//executing the query 
	$stmt->execute();
	
	//binding results to the query 
	$stmt->bind_result($id,$strDocumentId,$strOrderNumber,$strAmount,$strDate);
	
	$products['sales'] = array(); 
	
	//traversing through all the result 
	while($stmt->fetch()){

		$temp = array();
		
		$temp['strDocumentId'] = $strDocumentId; 
		$temp['id'] = $id; 
		$temp['strOrderNumber'] = $strOrderNumber; 
		$temp['strAmount'] = $strAmount; 
		$temp['strDate'] = $strDate; 

		array_push($products['sales'], $temp);
	}
	
	//displaying the result in json format 
	echo json_encode($products);
	
}
	?>
