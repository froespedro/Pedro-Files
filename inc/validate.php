<?php
//store the user inputs in variables and hash the password
$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);

//connect to db
require 'database.php';

//set up and run the query
$sql = "SELECT user_id FROM phpadmins WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);
//store the number of results in a variable
$count = $result -> rowCount();
//check if any matches found
if ($count == 1){
	//echo 'Logged in Successfully.';
	foreach  ($result as $row){
		//access the existing session created automatically by the server
		session_start();
		//take the user's id from the database and store it in a session variable
		$_SESSION['user_id'] = $row['user_id'];
		//redirect the user
		Header('Location: ../display-person.php');
	}
}
else {
	echo 'Invalid Login';
}
$conn = null;
?>
