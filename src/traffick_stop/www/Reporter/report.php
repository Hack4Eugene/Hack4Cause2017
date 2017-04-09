<?php
include('session.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$date = mysqli_real_escape_string($db,$_POST['date']);
	$location = mysqli_real_escape_string($db,$_POST['location']);
	$room_number = mysqli_real_escape_string($db,$_POST['location2']);
	$person_type = mysqli_real_escape_string($db,$_POST['person_type']);
	$name = mysqli_real_escape_string($db,$_POST['person_name']);
	$sex = mysqli_real_escape_string($db,$_POST['person_gender']);
	$race = mysqli_real_escape_string($db,$_POST['person_race']);
	$height_inches = mysqli_real_escape_string($db,$_POST['person_height']);
	$age_low = mysqli_real_escape_string($db,$_POST['person_age_low']);
	$age_high = mysqli_real_escape_string($db,$_POST['person_age_high']);
	$build = mysqli_real_escape_string($db,$_POST['build']);
	$hair_color = mysqli_real_escape_string($db,$_POST['person_hair_color']);
	$hair_length = mysqli_real_escape_string($db,$_POST['person_hair_length']);
	$eye_color = mysqli_real_escape_string($db,$_POST['person_eye_color']);
	$clothing = mysqli_real_escape_string($db,$_POST['person_clothing']);
	$person_blob = mysqli_real_escape_string($db,$_POST['person_blob']);
	$car_color = mysqli_real_escape_string($db,$_POST['car_color']);
	$car_make = mysqli_real_escape_string($db,$_POST['car_make']);
	$car_model = mysqli_real_escape_string($db,$_POST['car_model']);
	$plate = mysqli_real_escape_string($db,$_POST['car_license_number']);
	$state = mysqli_real_escape_string($db,$_POST['car_license_state']);
	$driven_by = mysqli_real_escape_string($db,$_POST['car_driver']);
	$car_blob = mysqli_real_escape_string($db,$_POST['car_blob']);
	$reporter_details = mysqli_real_escape_string($db,$_POST['info_blob']);
	
	$when_created = NULL; //TODO: Get the timestamp when created, currently testing MySQL NOW()
	//TODO: Add support for additional media
	$today = date("Y-m-d H:i:s"); 
	
	$sql_report = "INSERT INTO reports (
		when_occurred,
		when_created,
		username,
		submit_lat,
		submit_long,
		location,
		room_number,
		media_available,
		reporter_details
	) VALUES (
		'$date',
		UTC_TIMESTAMP(),
		'$login_session',
		'',
		'',
		'$location',
		'$room_number',
		'', 
		'$reporter_details'
		
	)";

	if (mysqli_query($db, $sql_report)) {
    	//echo "Main report created successfully";
		$report_id = mysqli_insert_id($db);
		$sql_person = "INSERT INTO people (
			ReportID,
			person_type,
			name,
			sex,
			race,
			height_inches,
			age_low,
			age_high,
			build,
			hair_color,
			hair_length,
			eye_color,
			clothing,
			reporter_details
		) VALUES (
			'$report_id',
			'$person_type',
			'$name',
			'$sex',
			'$race',
			'$height_inches',
			'$age_low',
			'$age_high',
			'$build',
			'$hair_color',
			'$hair_length',
			'$eye_color',
			'$clothing',
			'$person_blob'
		)";
		$sql_car = "INSERT INTO vehicles (
			ReportID,
			driven_by,
			color,
			make,
			model,
			plate,
			state,
			reporter_details
		) VALUES (
			'$report_id',
			'$driven_by',
			'$car_color',
			'$car_make',
			'$car_model',
			'$plate',
			'$state',
			'$car_blob'
		)";
		if (mysqli_query($db, $sql_person)) {
			//echo "New person record created successfully";
			
		} else {
			echo "Error: " . $sql_person . mysqli_error($db);
		}
		if (mysqli_query($db, $sql_car)) {
			//echo "New vehicle record created successfully";
		} else {
			echo "Error: " . $sql_car . mysqli_error($db);
		}
		header("location: thankyou.php");
	} else {
		echo "Error: " . $sql_report . mysqli_error($db);
	}
	
}
?>