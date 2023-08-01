<?php
	require './inc/header.php';
	
	//connect to db
	require './inc/database.php';
	
	//set up query
	$sql = "SELECT * FROM phppeople";
	
	//run the query and store the results
	$result = $conn->query($sql);
	
	//start our table
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
	
	//disconnect
	$conn = null;
	require './inc/footer.php';
?>
