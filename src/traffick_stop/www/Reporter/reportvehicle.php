<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport"><!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Admin Panel</title><!-- Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"><!-- Theme -->
	<link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col-md-4"><h2 class="center">Welcome <?php echo $login_session; ?></h2></div>
		<div class="col-md-4"><h2 class="center">Reporter Panel</h2></div>
		<div class="col-md-4"><h5 class="center"><a class="btn btn-default" href="logout.php">Sign Out</a></h5></div>
		</div>
		<div class="row">
			<div class="col-md-3 center">
				
			</div>
			<div class="col-md-6 center">
				<a href="index.php" class="btn btn-primary">Report Full</a>
				<a href="reportvehicle.php" class="btn btn-info">Report Vehicle</a>
				<a href="reportperson.php" class="btn btn-primary">Report Person</a>
				<h4 class="center" style="color:#b03030">Don't forget: If it's an emergency call 911!</h4>
				<form class="center" action="report.php" method="post">
					<p>Time and Place:</p>
					<div class="form-group"><input name="date" type="text" class="form-control" placeholder="Date"></div>
					<div class="form-group"><input name="location" type="text" class="form-control" placeholder="Location / Address"></div>
					<div class="form-group"><input name="location2" type="text" class="form-control" placeholder="Hotel / Suite Number"></div>
					<p>Transportation:</p>
					<div class="form-group"><input name="car_color" type="text" class="form-control" placeholder="Car Color"></div>
					<div class="form-group"><input name="car_make" type="text" class="form-control" placeholder="Car Make"></div>
					<div class="form-group"><input name="car_model" type="text" class="form-control" placeholder="Car Model"></div>
					<div class="form-group"><input name="car_license_number" type="text" class="form-control" placeholder="License Plate Number"></div>
					<div class="form-group"><input name="car_license_state" type="text" class="form-control" placeholder="License Plate State"></div>
					<div class="form-group"><select name="car_driver" class="form-control"></div>
					<option value="">Car Driver:</option>
					<option value="pimp">Pimp</option>
					<option value="victim">Victim</option>
					<option value="buyer">Buyer</option>
					<option value="witness">Witness</option>
					<option value="other">Other</option>
					</select></div>
					<div class="form-group"><textarea name="car_blob" class="form-control" placeholder="Additional Transportation Details" rows="5"></textarea></div>
					<p>Additional Info:</p>
					<div class="form-group"><textarea name="info_blob" class="form-control" placeholder="Additional Details" rows="5"></textarea></div>
					<div class="form-group"><input type="submit" class="btn btn-info" value="Submit Report"></div>
				</form>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
	</script> <!-- Latest compiled and minified JavaScript -->
	 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
	</script>
</body>
</html>