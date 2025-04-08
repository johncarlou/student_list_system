
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <ul class="nav justify-content-end">
            <?php if(isset($_SESSION['UserLogin'])){?>
                <li class="nav-item">
                    <a class="nav-link" href="">Welcome <?php echo $_SESSION['UserFirstName']?>!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="">Welcome Guest!</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                
            <?php } ?>

        </ul>
    </nav>