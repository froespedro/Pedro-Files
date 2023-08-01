<?php
    require './inc/header.php';
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('location:signin.php');
        exit();
    }
    else {
        require './inc/database.php';
        $id = $_GET['id'];
        $sql = "DELETE FROM phppeople WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header('location:manage-person.php');
        exit();
    }
?>
