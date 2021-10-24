<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../include/meta.php" ?>
    <title>
        Dashboard
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
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0" style="display: block">
                        <div class="row">
                            <div class="col-md-9">
                                <h6>Projects</h6>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-sm btn-primary btn-floating" id="addProjectModel" data-toggle="modal" data-target="#addProject">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    create New
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">User Responsible</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Create At</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                </tr>
                                </thead>
                                <tbody id="showProject">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Add Modal-->
    <div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addProjectForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Project Name</label>
                            <input type="text" class="form-control" placeholder="Project Name" name="project_name"  id="name">
                        </div>
                        <div class="mb-3">
                            <label for="name">Budget</label>
                            <input type="text" class="form-control" placeholder="Budget" name="budget"  id="budget">
                        </div>
                        <div class="mb-3">
                            <label for="name">User Responsible</label>
                            <input type="text" class="form-control" placeholder="User Responsible" name="user_responsible"  id="user_responsible">
                        </div>
                        <div class="mb-3">
                            <label for="name">status</label>
                            <select class="form-control" name="status">
                                <option value="1">Complete</option>
                                <option value="0">Incomplete</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_1">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Edit Modal-->
    <div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateProjectForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Project Name</label>
                            <input type="text" class="form-control" placeholder="Project Name" name="project_name"  id="edit_name">
                        </div>
                        <div class="mb-3">
                            <label for="name">Budget</label>
                            <input type="text" class="form-control" placeholder="Budget" name="budget"  id="edit_budget">
                        </div>
                        <div class="mb-3">
                            <label for="name">User Responsible</label>
                            <input type="text" class="form-control" placeholder="User Responsible" name="user_responsible"  id="edit_user_responsible">
                        </div>
                        <div class="mb-3">
                            <label for="name">status</label>
                            <select class="form-control" name="status" id="edit_ststus">
                                <option value="1">Complete</option>
                                <option value="0">Incomplete</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_2">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
<?php include "../include/js.php" ?>
<script src="../assets/js/custom/project.js"></script>
</body>
</html>