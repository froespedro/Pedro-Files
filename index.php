<?php
require './inc/header.php';
require './inc/database.php';

// File upload handling
$file_name = "";
if(isset($_FILES['profile_image'])){
    $file_name = $_FILES['profile_image']['name'];
    $file_tmp = $_FILES['profile_image']['tmp_name'];
    $target_dir = "./uploads/";
    $target_file = $target_dir . basename($file_name);
    move_uploaded_file($file_tmp, $target_file);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $telNumber = $_POST['telNumber'];

    // Insert the file name into the database along with other details
    $sql = "INSERT INTO phppeople(fname, lname, email, telNumber, profile_image) VALUES ('$fname', '$lname', '$email', '$telNumber', '$file_name')";
    $conn->exec($sql);
    $conn = null;
    echo '<section class="success-row">';
    echo '<div>';
    echo '<h3>Record Created Successfully</h3>';
    echo '</div>';
    echo '</section>';
}
?>
<!-- The form to create a new person -->
<form class="custom-form" method="post" enctype="multipart/form-data">
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" required>

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="telNumber">Phone Number:</label>
    <input type="tel" id="telNumber" name="telNumber" required>

    <input type="file" name="profile_image" id="profile_image">


    <input class="submit-btn" type="submit" value="Add Employee">
</form>

<section class="links-section">
    <div>
        <a class="custom-link" href="view-person.php">See All Employees</a>
    </div>
</section>

<!-- button to redirect to registration page -->
<section class="links-section">
    <div>
        <a class="custom-link" href="registration.php">Manage Employees</a>
    </div>
</section>

<?php
    require './inc/footer.php';
?>
