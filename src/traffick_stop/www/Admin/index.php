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
		<div class="col-md-4"><h2 class="center">Admin Panel</h2></div>
		<div class="col-md-4"><h5 class="center"><a class="btn btn-default" href="logout.php">Sign Out</a></h5></div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<h3 class="center">Create User</h3>
				<form class="center" action="createuser.php" method="post">
					<div class="form-group"><input name="username" type="text" class="form-control" placeholder="Username"></div>
					<div class="form-group"><input name="password" type="text" class="form-control" placeholder="Password"></div>
					<div class="form-group"><input name="firstname" type="text" class="form-control" placeholder="First Name"></div>
					<div class="form-group"><input name="lastname" type="text" class="form-control" placeholder="Last Name"></div>
					<div class="form-group"><input name="address1" type="text" class="form-control" placeholder="Address 1"></div>
					<div class="form-group"><input name="address2" type="text" class="form-control" placeholder="Address 2"></div>
					<div class="form-group"><input name="zipcode" type="text" class="form-control" placeholder="ZIP Code"></div>
					<div class="form-group"><input name="govt_id" type="text" class="form-control" placeholder="State ID or License Number"></div>
					<div class="form-group"><select name="id_type" class="form-control"></div>
					<option value="license">License</option>
					<option value="id">ID</option>
					</select></div>
					<div class="form-group"><input name="phone" type="tel" class="form-control" placeholder="Phone Number"></div>
					<div class="form-group"><select name="role" class="form-control" >
  						<option value="reporter">Reporter</option>
  						<option value="admin">Admin</option>
  						<option value="police">Police</option>
  					</select></div>
  					<div class="form-group"><input type="submit" class="btn btn-info" value="Create User"></div>
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