<?php
    include_once("connection.php");
    $con = connection();

    if(isset($_POST['delete'])){
        $id = $_POST['ID'];
        $sql = "DELETE FROM student_info WHERE id = $id";
        $con->query($sql) or die ($con->error);

        echo header("Location:index.php");
    }

?>