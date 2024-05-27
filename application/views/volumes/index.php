<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  
    <link href="assets/dist/css/style.min.css" rel="stylesheet" />
  
  </head>

  <body>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="my-2"></div>
                <!-- Corrected to use PHP tags for echoing the URL -->
                <buttoh class="btn btn-light btn-icon-split" onclick="location.href='<?= base_url('volumes/add'); ?>'" data-bs-toggle="tooltip" data-bs-placement="top" title="Add user">
                                            Add Volume</button>
            <div class="col-6">              
            </div>
        </div>
    </div>
</div>

</body>


        <div class="container-fluid">
        <h3 class="text-center mt-5"><?php echo $title; ?></h3>
        <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Volume Name</th>
                <th>Description</th>

                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($volumes as $volume):?>
            <tr>
            <td>
                <img src="<?php echo base_url('assets/users/' . $volume['profile_pic']); ?>" width="100" height="100" alt="User Image" style="border-radius: 50%;">
                    </td>
                <td><?php echo $volume['vol_name'];?></td> 
                <td><?php echo $volume['description'];?></td> 

                <td style='text-align: center; vertical-align:middle;'>
                                                 <a href="<?= base_url('volumes/view/' . $volume['volumeid']); ?>" class="btn btn-info btn-circle" title= "View User">
                                                <i class="fas fa-info-circle"></i>
                                                     </a>
                                                <a  href="<?php echo base_url(); ?>volumes/edit/<?php echo $volume['volumeid'];?>"class="btn btn-warning btn-circle btn-sm" title= "Edit User">
                                                 <i class="fas fa-exclamation-triangle"></i>
                                                 </a>
                                                <a href="<?php echo base_url(); ?>volumes/delete/<?php echo $volume['volumeid'];?>"class="btn btn-danger btn-circle btn-sm" title= "Delete User">
                                                <i class="fas fa-trash"></i>
                                                </a>
                                                
    
                                            </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/dist/js/custom.js"></script>
  </body>
  
</html>

