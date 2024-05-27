<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <title>View User Profile</title>
    <style>
        .profile-pic {
            width: 250px;
            height: 250px;
            object-fit: cover;
        }
        .user-info {
            margin-top: 20px;
            text-align: center;
        }
        .user-info p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <ol class="breadcrumb d-flex align-items-center">
            <li class="breadcrumb-item">
                <a class="text-decoration-none" href="<?php echo site_url('authors'); ?>">Back to Authors</a>
            </li>
        </ol>

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-body text-center">
                                <?php
                                $profilePicPath = site_url('assets/users/' . $author['images']);
                                ?>
                                <img src="<?php echo $profilePicPath; ?>" onerror="this.onerror=null; this.src='<?php echo base_url('assets/img/default-profile.png'); ?>'" class="rounded-circle profile-pic" id="profilePic">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="p-5">
                            <div class="user-info">
                                <p><strong>Complete Name:</strong> <?php echo $author['title']; ?><?php echo $author['author_name']; ?></p>
                                <p><strong>Emaiil Address:</strong> <?php echo $author['email']; ?></p>
                                <p><strong>Contact Number:</strong> <?php echo $author['contact_num']; ?></p>
                                <!-- Add more user information here as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/demo/datatables-demo.js'); ?>"></script>
</body>
</html>
