<?php
  require './inc/header.php';
  session_start();
  if (!isset($_SESSION['user_id'])) {
    header('location:signin.php');
    exit();
  } else {
    require './inc/database.php';
    // Read records
    $sql = "SELECT * FROM phppeople";
    $result = $conn->query($sql);
    echo '<h1>You now have <span class="red-text">admin</span> permissions</h1>';
    echo '<section class="person-row">';
    echo '<table class="table table-striped">
        <tr>
            <th>Profile Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>';
    foreach ($result as $row) {
        echo '<tr>
                <td><img src="uploads/'.$row['profile_image'].'" width="50" height="50" /></td>
                <td>' . $row['fname']  . '</td>
                <td>' . $row['lname']  . '</td>
                <td>' . $row['email']  . '</td>
                <td>' . $row['telNumber']  . '</td>
                <td>
                    <a href="edit-person.php?id='.$row['ID'].'" class="btn btn-primary">Edit</a>
                    <a href="delete-person.php?id='.$row['ID'].'" class="btn btn-danger">Delete</a>
                </td>
            </tr>';
    }
    echo '</table>';
    echo '<a class="btn btn-warning" href="logout.php">Logout</a>';
    echo '</section>';

    // Create new record
    echo '<section class="create-person">';
    echo '<h2>Add New Employee</h2>';
    echo '<form method="post" action="create-person.php" enctype="multipart/form-data">
            <p><input class="form-control" name="fname" type="text" placeholder="First Name" required/></p>
            <p><input class="form-control" name="lname" type="text" placeholder="Last Name" required /></p>
            <p><input class="form-control" name="email" type="email" placeholder="Email" required /></p>
            <p><input class="form-control" name="telNumber" type="tel" placeholder="Phone Number" required /></p>
            <p><input type="file" name="profile_image" id="profile_image"></p>
            <input class="btn btn-primary" type="submit" name="submit" value="Add Employee" />
          </form>';
    echo '</section>';

    $conn = null;
  }
  require './inc/footer.php';
?>
