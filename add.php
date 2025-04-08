<?php
    include_once('connection.php');
    $con = connection();

    if(isset($_POST['add_student'])){
        $f_name = $_POST['firstname'];
        $l_name = $_POST['lastname'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];
    
        // Handle image upload
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = "assets/uploads/" . basename($image_name);
    
        // Move uploaded image to your server folder
        move_uploaded_file($image_tmp, $image_path);
    
        $query = "INSERT INTO `student_info`(`first_name`, `last_name`, `gender`, `age`, `address`, `grade`, `subject`, `image`) 
                  VALUES ('$f_name','$l_name','$gender','$age','$address','$grade','$subject','$image_name')";
    
        $con->query($query) or die ($con->error);
        echo header("Location: index.php");
    }
    


?>