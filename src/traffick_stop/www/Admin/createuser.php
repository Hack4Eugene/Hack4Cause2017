<?php
include('session.php');
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	//Variables
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$password = mysqli_real_escape_string($db,$_POST['password']); 
	$firstname = mysqli_real_escape_string($db,$_POST['firstname']); 
	$lastname = mysqli_real_escape_string($db,$_POST['lastname']);
	$address1 = mysqli_real_escape_string($db,$_POST['address1']);
	$address2 = mysqli_real_escape_string($db,$_POST['address2']);
	$zipcode = mysqli_real_escape_string($db,$_POST['zipcode']);
	$phone = mysqli_real_escape_string($db,$_POST['phone']);
	$govt_id = mysqli_real_escape_string($db,$_POST['govt_id']);
	$id_type = mysqli_real_escape_string($db,$_POST['id_type']);
	$admin_id = mysqli_real_escape_string($db,$login_session);
	$role = mysqli_real_escape_string($db,$_POST['role']);
	/*$username = 'test';
	$password = 'test';
	$firstname = 'test';
	$lastname = 'test';
	$address1 = 'test';
	$address2 = 'test';
	$zipcode = '97401';
	$phone = '5415555555';
	$govt_id = '123456';
	$id_type = 'id';
	$admin_id = 0;
	$role = 'admin';*/
	
	//If role is not reporter or admin then account is disabled by default.
	if ($role == ('reporter' || 'admin')) {
		$is_enabled = true;
	} else {
		$is_enabled = false;
	}
	
	//Take any special characters out of phone numbers
	$phone = preg_replace('/[^0-9]/', '', $phone);
	
	//Hash password before storing
	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$password_hash = mysqli_real_escape_string($db,$password_hash); 
	
	$sql = "INSERT INTO users (
		username,
		password_hash,
		firstname,
		lastname,
		address1,
		address2,
		zipcode,
		phone,
		govt_id,
		id_type,
		admin_id,
		is_enabled,
		role
		) Values (
		'$username',
		'$password_hash',
		'$firstname',
		'$lastname',
		'$address1',
		'$address2',
		'$zipcode',
		'$phone',
		'$govt_id',
		'$id_type',
		'$admin_id',
		'$is_enabled',
		'$role'
	)";
	if (mysqli_query($db, $sql)) {
    	echo "New record created successfully";
	} else {
		echo "Error: " . $sql . mysqli_error($db);
	}

}
?>