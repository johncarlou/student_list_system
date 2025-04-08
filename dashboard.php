<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once('connection.php');
$con = connection();

function getCount($con, $query) {
    $result = $con->query($query) or die($con->error);
    $row = $result->fetch_assoc();
    return $row;
}

// Get counts
$total = getCount($con, "SELECT COUNT(*) as total FROM student_info");
$female = getCount($con, "SELECT COUNT(*) as female_students FROM student_info WHERE gender = 'Female'");
$male = getCount($con, "SELECT COUNT(*) as male_students FROM student_info WHERE gender = 'Male'");$total = getCount($con, "SELECT COUNT(*) as total FROM student_info", 'total');
$g_one = getCount($con, "SELECT COUNT(*) as grade_one FROM student_info WHERE grade = 1" );
$g_two = getCount($con, "SELECT COUNT(*) as grade_two FROM student_info WHERE grade = 2");$total = getCount($con, "SELECT COUNT(*) as total FROM student_info", 'total');
$g_three = getCount($con, "SELECT COUNT(*) as grade_three FROM student_info WHERE grade = 3");
$g_four = getCount($con, "SELECT COUNT(*) as grade_four FROM student_info WHERE grade = 4");$total = getCount($con, "SELECT COUNT(*) as total FROM student_info", 'total');
$g_five = getCount($con, "SELECT COUNT(*) as grade_five FROM student_info WHERE grade = 5");
$g_six = getCount($con, "SELECT COUNT(*) as grade_six FROM student_info WHERE grade = 6");
?>

<?php include('views/header.php'); ?>
<?php include('views/navbar.php'); ?>

<div class="dashboard-container">
    <div class="container py-5">
        <div class="row text-center dashboard-row ">
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1 class="m-0 ">Total Students: <?php echo $total['total']; ?></h1>
            </div>
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Female: <?php echo $female['female_students']; ?></h1>
            </div>
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Male: <?php echo $male['male_students']; ?></h1>
            </div>
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Grade one: <?php echo $g_one['grade_one']; ?></h1>
            </div>
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Grade two: <?php echo $g_two['grade_two']; ?></h1>
            </div>
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Grade three: <?php echo $g_three['grade_three']; ?></h1>
            </div>        
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Grade four: <?php echo $g_four['grade_four']; ?></h1>
            </div>       
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Grade five: <?php echo $g_five['grade_five']; ?></h1>
            </div>
            <div class="img col-sm-12 col-md-4 d-flex justify-content-center align-items-center">
                <h1>Grade six: <?php echo $g_six['grade_six']; ?></h1>
            </div>
        </div>
    </div>
</div>
<?php include('views/footer.php'); ?>