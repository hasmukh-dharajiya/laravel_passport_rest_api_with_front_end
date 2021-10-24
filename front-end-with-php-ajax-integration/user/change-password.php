<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/meta.php" ?>
    <title>
        Change Password | Dashboard
    </title>
    <?php include "../include/css.php" ?>
</head>
<body class="g-sidenav-show  bg-gray-100">
<?php include "../include/sidebar.php" ?>
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">

            </nav>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row my-4">
            <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Change Password</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="change_password">
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="current Password" name="current_password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="New Password" name="new_password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Conform Password" name="confirm_password">
                            </div>
                            <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include "../include/js.php" ?>
<script src="../assets/js/custom/change-password.js"></script>
</body>
</html>