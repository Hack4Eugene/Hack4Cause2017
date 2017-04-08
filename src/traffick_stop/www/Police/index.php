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
		<div class="col-md-4"><h2>Welcome <?php echo $login_session; ?></h2></div>
		<div class="col-md-4"><h2 class="center">Police Panel</h2></div>
		<div class="col-md-4"><h5 class="right"><a class="btn btn-default" href="logout.php">Sign Out</a></h5></div>
		</div>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4 center">
			Thing to authorize police users, ignore this for now
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="col-md-4">
					<div class="form-group"><input name="search" class="form-control" placeholder="Search Term"></div>
				</div>
				<div class="col-md-4">
					<div class="form-group"><select class="form-control">
						<option value="id">Report ID</option>
						<option value="location">Location</option>
						<option value="room_number">Room Number</option>
						<option value="person_type">Person Type</option>
						<option value="name">Name</option>
						<option value="sex">Sex</option>
						<option value="race">Race</option>
						<option value="age">Age</option>
						<option value="build">Build</option>
						<option value="hair_color">Hair Color</option>
						<option value="hair_length">Hair Length</option>
						<option value="eye_color">Eye Color</option>
						<option value="clothing">Clothing</option>
						<option value="person_blob">Person Additional Details</option>
						<option value="car_color">Car Color</option>
						<option value="car_make">Car Make</option>
						<option value="car_model">Car Model</option>
						<option value="plate">Plate Number</option>
						<option value="state">Plate State</option>
						<option value="driven_by">Driver</option>
						<option value="car_blob">Car Additional Details</option>
						<option value="reporter_details">Other Additional Details</option>
					</select></div>
				</div>
				<div class="col-md-4 center">
					<div class="form-group"><input type="submit" value="search" class="form-control btn btn-info"></div>
				</div>
			
				
			</form>
		</div>
		<div class="row">
			<dive class="col-md-12">
				<table class="table table-striped table-condensed  table-responsive">
					<tr>
						<?php
						$Table = 'vehicles';
						$sql = "SHOW COLUMNS FROM $Table";
						$result = mysqli_query($db,$sql);
							while ($row = mysqli_fetch_array($result)) {
								echo "<th>".$row['Field']."</th>";
							}
						?>
					</tr>
					<?php
					$search = $_POST['search'];
						$Table = 'vehicles';
						$sql = "SHOW COLUMNS FROM $Table";
						$result = mysqli_query($db,$sql);
							while ($row = mysqli_fetch_array($result)) {
								$row_ = $row['Field'];
								$sql2 = "SELECT $row_ FROM $Table WHERE $row_ LIKE '%$search%'";
								$result2 = mysqli_query($db,$sql2);
								while ($row2 = mysqli_fetch_array($result2)){
									
								}
							}
					?>
				</table>
			</dive>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
	</script> <!-- Latest compiled and minified JavaScript -->
	 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
	</script>
</body>
</html>