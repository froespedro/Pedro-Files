<?php
require './inc/database.php';

// File upload handling
if(isset($_FILES['profile_image'])){
    $file_name = $_FILES['profile_image']['name'];
    $file_tmp = $_FILES['profile_image']['tmp_name'];
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($file_name);
    move_uploaded_file($file_tmp, $target_file);
} else {
    $file_name = "";  // default value if no image is uploaded
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$telNumber = $_POST['telNumber'];

// Insert the file name into the database along with other details
$sql = "INSERT INTO phppeople(fname, lname, email, telNumber, profile_image) VALUES ('$fname', '$lname', '$email', '$telNumber', '$file_name')";
$conn->exec($sql);
$conn = null;

header('location:manage-person.php');
?>
