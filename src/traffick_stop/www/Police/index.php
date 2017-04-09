<?php
   include('session.php');
	$hide_recent = false;
	$hide_reports = true;
	$hide_vehicles = true;
	$hide_people = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$search =  $_POST['search'];
		$filter =  $_POST['filter'];
		if ($_POST['table'] == 'reports'){
			$hide_recent = true;
			$hide_reports = false;
			$hide_vehicles = true;
			$hide_people = true;
		}
		if ($_POST['table'] == 'vehicles'){
			$hide_recent = true;
			$hide_reports = true;
			$hide_vehicles = false;
			$hide_people = true;
		}
		if ($_POST['table'] == 'people'){
			$hide_recent = true;
			$hide_reports = true;
			$hide_vehicles = true;
			$hide_people = false;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1" name="viewport"><!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Police Panel</title><!-- Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"><!-- Theme -->
	<link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
		<div class="col-md-4"><h2 class="center">Welcome <?php echo $login_session; ?></h2></div>
		<div class="col-md-4"><h2 class="center">Police Panel</h2></div>
		<div class="col-md-4"><h5 class="center"><a class="btn btn-default" href="logout.php">Sign Out</a></h5></div>
		</div>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4 center police_auth">
				New police users requiring authorization: 0 <!-- Next feature -->
			</div>
			<div class="col-md-4">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Find a Report: Filter By</h3>
			</div>
		</div>
		
		<div class="row">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="col-md-4">
				
					<div class="form-group"><input name="search" class="form-control" placeholder="Search Term"></div>
				</div>
				<div class="col-md-4">
					<div class="form-group"><select name="filter" class="form-control">
						<option value="ReportID">Report ID</option>
						<option value="username">Username</option>
						<option value="location">Location</option>
					</select></div>
				</div>
				<div class="col-md-4 center">
					<input type="hidden" name="table" value="reports">
					<div class="form-group"><input type="submit" value="Search" class="form-control btn btn-info"></div>
				</div>			
			</form>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Find a Vehicle: Filter By</h3>
			</div>
		</div>
		<div class="row">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="col-md-4">
				
					<div class="form-group"><input name="search" class="form-control" placeholder="Search Term"></div>
				</div>
				<div class="col-md-4">
					<div class="form-group"><select name="filter" class="form-control">
						<option value="ReportID">Report ID</option>
						<option value="make">Make</option>
						<option value="model">Model</option>
						<option value="color">Color</option>
						<option value="plate">Plate Number</option>
						<option value="state">Plate State</option>
					</select></div>
				</div>
				<div class="col-md-4 center">
					<input type="hidden" name="table" value="vehicles">
					<div class="form-group"><input type="submit" value="Search" class="form-control btn btn-info"></div>
				</div>			
			</form>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h3>Find a Person: Filter By</h3>
			</div>
		</div>
		<div class="row">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<div class="col-md-4">
				
					<div class="form-group"><input name="search" class="form-control" placeholder="Search Term"></div>
				</div>
				<div class="col-md-4">
					<div class="form-group"><select name="filter" class="form-control">
						<option value="ReportID">Report ID</option>
						<option value="name">Name</option>
						<option value="age">Age</option>
						<option value="race">Race</option>
						<option value="sex">Sex</option>
						<option value="height">Height</option>
						<option value="eye_color">Eye Color</option>
						<option value="hair_color">Hair Color</option>
						<option value="hair_length">Hair Length</option>
						<option value="clothing">Clothing</option>
					</select></div>
				</div>
				<div class="col-md-4 center">
					<input type="hidden" name="table" value="people">
					<div class="form-group"><input type="submit" value="Search" class="form-control btn btn-info"></div>
				</div>			
			</form>
		</div>

		<!-- --------------------------- Forms above, results below ----------------------- -->

		<div class="row">
			<?php if (!$hide_recent) { ?>
			<dive class="col-md-12" id="recent_reports">
				<h3>Recent Reports</h3>
				<table class="table table-striped table-condensed  table-responsive">
						<tr>
							<th>Report ID</th>
							<th>Location</th>
							<th>Person Type</th>
							<th>Age Range</th>
							<th>Sex</th>
							<th>Hair Color</th>
							<th>Additional Info</th>
						</tr>
						<?php
							$sql = "(SELECT * FROM reports ORDER BY ReportID DESC LIMIT 50) ORDER BY ReportID DESC";
							$sql2 = "(SELECT * FROM people ORDER BY ReportID DESC LIMIT 50) ORDER BY ReportID DESC";
							$result = mysqli_query($db,$sql);
							$result2 = mysqli_query($db,$sql2);
							while ($row = mysqli_fetch_array($result)) {
								$row2 = mysqli_fetch_array($result2);
                   				echo "<tr>";
                   				$reportNum = $row['reportID'];
	                   			$link="<a href=\"full_report.php?id=".$reportNum.">";
	                   			$link="<a href=\"https://www.youtube.com/watch?v=dQw4w9WgXcQ\">";
								echo "<td>".$link.$row['ReportID']."</a></td>";
								echo "<td>".$row['location']."</td>";
								echo "<td>".$row2['person_type']."</td>";
								echo "<td>".$row2['age_low']." - ".$row2['age_high']."</td>";
								echo "<td>".$row2['sex']."</td>";
								echo "<td>".$row2['hair_color']."</td>";
								echo "<td>".$row['reporter_details']."</td>";
								echo "</tr>";
							}
						?>
				</table>
				<?php } ?>
			<?php if (!$hide_reports) { ?>

			<!-- ------------------------ Report people ----------------------- -->

			<dive class="col-md-12" id="recent_reports">
				<h3>Filtered Reports</h3>
				<table class="table table-striped table-condensed  table-responsive">
						<tr>
							<th>Report ID</th>
							<th>Location</th>
							<th>Person Type</th>
							<th>Age Range</th>
							<th>Sex</th>
							<th>Hair Color</th>
							<th>Additional Info</th>
						</tr>
						<?php
							$sql = "SELECT * FROM reports WHERE $filter LIKE '%$search%' ORDER BY ReportID DESC LIMIT 50";
							$sql2 = "SELECT * FROM people ORDER BY ReportID DESC LIMIT 50";
							$result = mysqli_query($db,$sql);
							$result2 = mysqli_query($db,$sql2);
							while ($row = mysqli_fetch_array($result)) {
								$row2 = mysqli_fetch_array($result2);
                   				echo "<tr>";
								echo "<td>".$row['ReportID']."</td>";
								echo "<td>".$row['location']."</td>";
								echo "<td>".$row2['person_type']."</td>";
								echo "<td>".$row2['age_low']." - ".$row2['age_high']."</td>";
								echo "<td>".$row2['sex']."</td>";
								echo "<td>".$row2['hair_color']."</td>";
								echo "<td>".$row['reporter_details']."</td>";
								echo "</tr>";
							}
						?>
				</table>
				<?php } ?>
			<?php if (!$hide_vehicles) { ?>

			<!-- ---------------------- Show vehicles --------------------------- -->

			<dive class="col-md-12" id="recent_reports">
				<h3>Vehicles</h3>
				<table class="table table-striped table-condensed  table-responsive">
						<tr>
							<th>Report ID</th> <!-- Add link -->
							<th>Color</th> <!-- Add date/time before this -->
							<th>Make</th>
							<th>Model</th>
							<th>State</th>
							<th>License</th>
							<th>Location</th>
							<th>Additional Info</th>
						</tr>
						<?php
							$sql = "(SELECT * FROM reports ORDER BY ReportID DESC LIMIT 50) ORDER BY ReportID DESC";
							$sql2 = "SELECT * FROM vehicles WHERE $filter LIKE '%$search%' ORDER BY ReportID DESC LIMIT 50;";
							$result = mysqli_query($db,$sql);
							$result2 = mysqli_query($db,$sql2);
							while ($row2 = mysqli_fetch_array($result2)) {
								$row = mysqli_fetch_array($result);
                   				echo "<tr>";
								echo "<td>".$row['ReportID']."</td>";
								echo "<td>".$row2['color']."</td>";
								echo "<td>".$row2['make']."</td>";
								echo "<td>".$row2['model']."</td>";
								echo "<td>".$row2['state']."</td>";
								echo "<td>".$row2['plate']."</td>";
								echo "<td>".$row['location']."</td>";
								echo "<td>".$row2['driven_by']."</td>";
								echo "<td>".$row['reporter_details']."</td>";
								echo "</tr>";
							}
						?>
				</table>
				<?php } ?>
			<?php if (!$hide_people) { ?>

			<!-- -------------------------- People ----------------------- -->

			<dive class="col-md-12" id="recent_reports">
				<h3>Recent Reports</h3>
				<table class="table table-striped table-condensed  table-responsive">
						<tr>
							<th>Report ID</th>
							<th>Location</th>
							<th>Name</th>
							<th>Race</th>
							<th>Age Range</th>
							<th>Sex</th>
							<th>Height (In)</th>
							<th>Hair Color</th>
							<th>Hair Length</th>
							<th>Eye Color</th>
							<th>Clothing</th>
							<th>Additional Info</th>
						</tr>
						<?php
							$sql = "SELECT * FROM reports ORDER BY ReportID DESC LIMIT 50 ";
							$sql2 = "SELECT * FROM people WHERE $filter LIKE '%$search%' ORDER BY ReportID DESC LIMIT 50;";
							$result = mysqli_query($db,$sql);
							$result2 = mysqli_query($db,$sql2);
							while ($row2 = mysqli_fetch_array($result2)) {
								$row = mysqli_fetch_array($result);
                   				echo "<tr>";
								echo "<td>".$row2['ReportID']."</td>";
								echo "<td>".$row['location']."</td>";
								echo "<td>".$row2['name']."</td>";
								echo "<td>".$row2['race']."</td>";
								echo "<td>".$row2['age_low']." - ".$row2['age_high']."</td>";
								echo "<td>".$row2['sex']."</td>";
								echo "<td>".$row2['height_inches']."</td>";
								echo "<td>".$row2['hair_color']."</td>";
								echo "<td>".$row2['hair_length']."</td>";
								echo "<td>".$row2['eye_color']."</td>";
								echo "<td>".$row2['clothing']."</td>";
								echo "<td>".$row['reporter_details']."</td>";
								echo "</tr>";
							}
						?>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
	</script> <!-- Latest compiled and minified JavaScript -->
	 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
	</script>
</body>
</html>