<?php include ('connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE `id`='$id'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Deletion Failed : " . mysqli_error($conn));
    } else {
        header("location:index.php?deletion_message=Data is successfully deleted !!");
    }
}
?>