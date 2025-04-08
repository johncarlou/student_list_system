<?php 
    include_once('connection.php');
    $con = connection();

    if(!isset($_SESSION)){
        session_start();
    }

    $id = $_GET['ID'];
    $query = "SELECT * FROM student_info WHERE id = '$id'";
    $students = $con->query($query) or die ($con->error);
    $row = $students->fetch_assoc();

    if(isset($_POST['update_info'])){
        $f_name = $_POST['firstname'];
        $l_name = $_POST['lastname'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $grade = $_POST['grade'];
        $subject = $_POST['subject'];

        // Check if a new image is uploaded
        if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_path = "assets/uploads/" . basename($image_name);

            // Move uploaded image to your server folder
            move_uploaded_file($image_tmp, $image_path);

            // Include image in update
            $query = "UPDATE `student_info` 
                    SET `first_name`='$f_name', `last_name`='$l_name', `gender`='$gender', 
                        `age`='$age', `address`='$address', `grade`='$grade', 
                        `subject`='$subject', `image`='$image_name' 
                    WHERE `id` = '$id'";
        } else {
            // Update without image
            $query = "UPDATE `student_info` 
                    SET `first_name`='$f_name', `last_name`='$l_name', `gender`='$gender', 
                        `age`='$age', `address`='$address', `grade`='$grade', 
                        `subject`='$subject' 
                    WHERE `id` = '$id'";
        }

        $con->query($query) or die ($con->error);
        echo header("Location:details.php?ID=".$id);
    }
?>

<?php include('views/header.php'); ?>
<?php include('views/navbar.php'); ?>
<div class="details-container">
    <div class="d-flex justify-content-center">
        <div class="container my-5 d-flex flex-column align-items-center ">
            <div class="card" style="width: 500px;">
                <img class="card-img-top" src="assets/uploads/<?php echo $row['image']; ?>" alt="Student Image" width="100px" height="350px" style="object-fit: cover; border-radius: 5px;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['first_name']." ".$row['last_name']?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Age: <?php echo $row['age']?></li>
                    <li class="list-group-item">Grade: <?php echo $row['grade']?></li>
                    <li class="list-group-item">Subject: <?php echo $row['subject']?></li>
                    <li class="list-group-item">Address: <?php echo $row['address']?></li>
                </ul>
            </div>

            <div class="box1 mt-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Update Information</button>
            </div>
        </div>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD STUDENTS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $row['first_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo $row['last_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Grade</label>
                            <select name="gender" id="gender">
                                <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '';?>>Male</option>
                                <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '';?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" name="age" class="form-control" value="<?php echo $row['age']?>">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $row['address']?>">
                        </div>
                        <div class="form-group">
                            <label for="grade">Grade</label>
                            <select name="grade" id="gender">
                                <option value="1" <?php echo ($row['grade'] == "1")? 'selected' : '';?>>1</option>
                                <option value="2" <?php echo ($row['grade'] == "2")? 'selected' : '';?>>2</option>
                                <option value="3" <?php echo ($row['grade'] == "3")? 'selected' : '';?>>3</option>
                                <option value="4" <?php echo ($row['grade'] == "4")? 'selected' : '';?>>4</option>
                                <option value="5" <?php echo ($row['grade'] == "5")? 'selected' : '';?>>5</option>
                                <option value="6" <?php echo ($row['grade'] == "6")? 'selected' : '';?>>6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subjects</label>
                            <input type="text" name="subject" class="form-control" value="<?php echo $row['subject']?>">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <br>
                            <?php if(!empty($row['image'])): ?>
                                <img src="assets/uploads/<?php echo $row['image']; ?>" alt="Current Image" style="width: 100px; height: 100px;">
                                <br>
                                <small>Leave blank to keep the current image.</small>
                            <?php endif; ?>
                            <input type="file" name="image" />
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" name="update_info" value="Update">
                </div>
                </div>
            </div>
            </div>
        </form>
</div>
<?php include('views/footer.php'); ?>