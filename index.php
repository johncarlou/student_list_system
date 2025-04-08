<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once('connection.php');
    $con = connection();

    $query = "SELECT * from student_info";
    $students = $con->query($query) or die ($con->error);
    $row = $students->fetch_assoc();

?>

<?php if(isset($_SESSION['UserLogin'])){?>
    <?php include('views/header.php'); ?>
    <?php include('views/navbar.php'); ?>
    <div class="index-container">
        <h2 class="text-center py-5 text-white">STUDENTS LIST</h2>
        <div class="container py-5 index-inner-container">
            <?php if(isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator"){?>
                <button class="btn btn-primary my-1" data-toggle="modal" data-target="#exampleModal">ADD STUDENTS</button>
            <?php }?>
            <table class="table table-hover table-bordered table-striped text-white">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Grade</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php do {?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['last_name'];?></td>
                        <td><?php echo $row['gender'];?></td>
                        <td><?php echo $row['grade'];?></td>
                        <td class="text-center">
                            <?php if (!empty($row['image'])): ?>
                                <img src="assets/uploads/<?php echo $row['image']; ?>" alt="Student Image" width="100px" height="100px" style="object-fit: cover; background: transparent; border-radius: 5px; ">
                            <?php else: ?>
                                <span>No image</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center" style="margin-bottom:5px;"><?php if(isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator"){?>
                            <button class="btn btn-primary" style="margin-bottom:3px;"><a href="details.php?ID=<?php echo $row['id']?>" class="text-white">view</a></button>
                            <form action="delete.php" method="post">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                <input type="hidden" name="ID" value="<?php echo $row['id'];?>">
                            </form>
                            </td>
                            <?php }else{?>
                                <button class="btn btn-primary"><a href="details.php?ID=<?php echo $row['id']?>" class="text-white">view</a></button>
                            <?php }?>
                        </td>

                    </tr>
                    <?php } while($row = $students->fetch_assoc());?>
                </tbody>
            </table>

            <form action="add.php" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="firstname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="gender">Grade</label>
                                <select name="gender" id="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" name="age" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select name="grade" id="gender">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subjects</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" />
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" name="add_student" value="ADD">
                    </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
<?php include('views/footer.php'); ?>
<?php }else{ echo header("Location:login.php");}?>