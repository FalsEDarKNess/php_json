<?php 

	$name = $_POST['name'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$profile = $_FILES['profile'];

	// print_r($profile);
	// echo "<br>";

	// echo "$name and $email and $gender and $address";

	$basepath="photo/";
	$fullpath=$basepath.$profile["name"];
	move_uploaded_file($profile['tmp_name'], $fullpath);

	$student=[
		"name"=>$name,
		"email"=>$email,
		"gender"=>$gender,
		"address"=>$address,
		"profile"=>$fullpath

	];

	// print_r($student);

	$stuJson=file_get_contents("student.json");
	if (!$stuJson) {
		$stuJson="[]";
	}

	$data_arr=json_decode($stuJson,true);

	array_push($data_arr, $student);

	$jsonStr=json_encode($data_arr,JSON_PRETTY_PRINT); //json-pertty-print ka hla chin loe

	file_put_contents("student.json", $jsonStr);

	header("location:index.php");

	
 ?>