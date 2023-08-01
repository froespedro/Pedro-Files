<?php
require './inc/header.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:signin.php');
    exit();
} else {
    require './inc/database.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM phppeople WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $person = $stmt->fetch(PDO::FETCH_ASSOC);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // File upload handling
        $file_name = $person['profile_image'];  // use existing image by default
        if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $file_name = $_FILES['profile_image']['name'];
            $file_tmp = $_FILES['profile_image']['tmp_name'];
            $target_dir = "./uploads/";
            $target_file = $target_dir . basename($file_name);
            move_uploaded_file($file_tmp, $target_file);
        }

        // Update database
        $sql = "UPDATE phppeople SET fname = :fname, lname = :lname, email = :email, telNumber = :telNumber, profile_image = :profile_image WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fname', $_POST['fname']);
        $stmt->bindParam(':lname', $_POST['lname']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':telNumber', $_POST['telNumber']);
        $stmt->bindParam(':profile_image', $file_name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('location:manage-person.php');
        exit();
    }
}

?>

<!-- The form to edit a person -->
<form method="post" class="w-50 mx-auto" enctype="multipart/form-data">
    <div class="form-group">
        <label for="fname">First Name:</label>
        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $person['fname']; ?>">
    </div>
    <div class="form-group">
        <label for="lname">Last Name:</label>
        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $person['lname']; ?>">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $person['email']; ?>">
    </div>
    <div class="form-group">
        <label for="telNumber">Phone Number:</label>
        <input type="text" class="form-control" id="telNumber" name="telNumber" value="<?php echo $person['telNumber']; ?>">
    </div>
    <div class="form-group">
        <label for="profile_image">Profile Image:</label>
        <input type="file" class="form-control" id="profile_image" name="profile_image">
    </div>
    <div class="form-group text-center">
        <input type="submit" class="btn btn-primary" value="Update">
    </div>
</form>

<?php
    require './inc/footer.php';
?>
