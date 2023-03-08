<?php

require_once("includes/header.php");
//user 
require_once("includes/classes/User.php");

$usernameLoggedIn = User::isLoggedIn();


$userLoggedInObj = new User($con, $usernameLoggedIn);






if (!$usernameLoggedIn) {
    header("Location: signIn");
}


?>


<section class="conatiner p-5">
    <div class="container-fluid" id="main">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-md-3 col-lg-2 sidebar-offcanvas" id="sidebar" role="navigation" style="border: 1px solid #ccc;">
                <ul class="nav flex-column pl-1 p-2">
                    <li class="nav-item text-bg-secondary p-3">Overview</li>
                    <li class="nav-item p-3">
                        <a href="#" class="list-group-item  main-color-bg ">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="#" class="list-group-item ">
                            Add Jobs
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="#" class="list-group-item">
                            Add Company
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="#" class="list-group-item">
                            Add Internships
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="#" class="list-group-item ">
                            Change Password
                        </a>
                    </li>
                    <li class="nav-item p-3">
                        <a href="#" class="list-group-item ">
                            Users
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-9 col-lg-9 main">
                <h1 class="text-bold m-3">Admin Dashboard</h1>

                <div class="row mb-3 text-center mt-2">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse card-success">
                            <div class="card-block bg-success">
                                <div class="rotate mt-2">
                                    <i class="fa fa-user fa-3x"></i>
                                </div>
                                <h6 class="text-uppercase">Users</h6>
                                <h1 class="display-1">10</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse card-primary">
                            <div class="card-block bg-primary">
                                <div class="rotate mt-2">
                                    <i class="fa fa-share fa-3x"></i>
                                </div>
                                <h6 class="text-uppercase">Videos</h6>
                                <h1 class="display-1">36</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse card-danger">
                            <div class="card-block bg-danger">
                                <div class="rotate mt-2">
                                    <i class="fa fa-share fa-3x"></i>
                                </div>
                                <h6 class="text-uppercase">Vlogs</h6>
                                <h1 class="display-1">36</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-inverse card-warning">
                            <div class="card-block bg-warning">
                                <div class="rotate mt-2">
                                    <i class="fa fa-share fa-3x"></i>
                                </div>
                                <h6 class="text-uppercase">Course</h6>
                                <h1 class="display-1">36</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <hr />
                <table class="table align-middle mb-0 bg-white" style="font-weight: 600;">
                    <thead class="bg-light">
                        <tr>
                            <th>Profile</th>

                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $query = $con->prepare("SELECT * FROM users");
                        $query->execute();

                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $profilePic = $row['profilePic'];
                            $id = $row['id'];
                            $name = $row['firstName'] . " " . $row['lastName'];
                            $email = $row['email'];
                            $role = $row['role'];




                            echo "<tr >
                            <td><img src='$profilePic' alt='profile pic' class='rounded-circle' width='50px' height='50px'></td>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$email</td>
                           
                            <td>$role</td>
                            <td>
                                <a href='editUser.php?id=$id' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='deleteUser.php?id=$id' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>";
                        }

                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>



<?php require_once("includes/footer.php"); ?>