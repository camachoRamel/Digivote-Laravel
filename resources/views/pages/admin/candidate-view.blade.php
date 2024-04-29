<!DOCTYPE html>
<html lang="en" >
<?php
    $pageTitle = "Admin"; 
    include('../includes/head.php');
?>
<link rel="stylesheet" href="../custom-styles/admin.css">
<body class="bg-light pb-5">
    <?php
        include('../templates/header.html');
    ?>  
    <section class="content-header">
        test
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-5 mx-auto">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">Nina Mcintire</h3>

                            <p class="text-muted text-center">Software Engineer</p>

                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                            </ul>

                            <form action="" method="post" class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

                
                <!-- about card -->
            </div>
        </div>
    </section>
    <!-- content end -->

    <section class="content-footer">
        test
    </section>
</body>
</html>