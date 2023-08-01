<?php
	require './inc/header.php';
	//check for authentication before we show any data
	session_start();
	if (!isset($_SESSION['user_id'])) {
		header('location:signin.php');
		exit();
	}
	else {
		//connect to db
		require './inc/database.php';
		//set up query
		$sql = "SELECT * FROM phppeople";
		//run the query and store the results
		$result = $conn->query($sql);
		//start our table
		echo '<h1>You are <span class="red-text">logged in</span></h1>';
		echo '<section class="person-row">';
		echo '<table class="table table-striped">
						<tr>
							<th>Profile Image</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Phone Number</th>
						</tr>';
		foreach ($result as $row) {
			echo '<tr>
							<td><img src="./uploads/' . $row['profile_image'] . '" width="50" height="50" /></td>
							<td>' . $row['fname']  . '</td>
							<td>' . $row['lname']  . '</td>
							<td>' . $row['email']  . '</td>
							<td>' . $row['telNumber']  . '</td>
					</tr>';
			}
		//close the table
		echo '</table>';
		//Add Logout and Manage Person buttons
		echo '<div class="button-container">';
		echo '<a class="btn btn-warning" href="logout.php">Logout</a>';
		echo ' ';
		echo '<a class="btn btn-primary" href="manage-person.php">Manage Employees <span class="red-text"> - Admin </span></a>';
		echo '</div>'; // Close button container
		echo '</section>';

		//disconnect
		$conn = null;
	}
	require './inc/footer.php';
?>
