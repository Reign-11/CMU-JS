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
                <buttoh class="btn btn-light btn-icon-split" onclick="location.href='<?= base_url('articles/add'); ?>'" data-bs-toggle="tooltip" data-bs-placement="top" title="Add user">
                                            Add Articles</button>
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
                <th>Title</th>
                <th>Keywords</th>
                <th style="text-align: center;">Action</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) : ?>
                <tr>
            
                    <td><?php echo $article['title']; ?></td>
                    <td><?php echo $article['keywords']; ?></td>
                    <td style='text-align: center; vertical-align:middle;'>
                    <a href="<?= base_url('./assets/users/' . $article['filename']); ?>" target="_blank" class="btn btn-info btn-circle">
                                                <i class="fas fa-check"></i>
                                                     </a>
                                                 <a href="<?= base_url('articles/view/' . $article['articleid']); ?>" class="btn btn-info btn-circle" title= "View User">
                                                <i class="fas fa-info-circle"></i>
                                                     </a>
                                                <a  href="<?php echo base_url(); ?>articles/edit/<?php echo $article['articleid'];?>"class="btn btn-warning btn-circle btn-sm" title= "Edit User">
                                                 <i class="fas fa-exclamation-triangle"></i>
                                                 </a>
                                                <a href="<?php echo base_url(); ?>articles/delete/<?php echo $article['articleid'];?>"class="btn btn-danger btn-circle btn-sm" title= "Delete User">
                                                <i class="fas fa-trash"></i>
                                                </a>
                                                
    </td>
                    <td style='vertical-align:middle;'>
									
                            <a href="<?php echo base_url('articles/toggle_archive/' . $article['articleid']); ?>" 
                            class="btn <?php echo $article['archive'] ? 'btn-danger' : 'btn-success'; ?>" 
                            onclick="return confirm('Are you sure you want to <?php echo $article['archive'] ? 'Archive' : 'Unarchived'; ?> this volume?');"
                            title="<?php echo $article['archive'] ? 'Unarchived' : 'Archive'; ?>">
                                <?php echo $article['archive'] ? 'Unarchive' : 'Archive'; ?>
                            </a>
                            </td>

                            <td>
                            <a href="<?php echo base_url('articles/toggle_publish/' . $article['articleid']); ?>" 
                            class="btn <?php echo $article['published'] ? 'btn-danger' : 'btn-success'; ?>" 
                            onclick="return confirm('Are you sure you want to <?php echo $article['published'] ? 'Publish' : 'Unpublish'; ?> this volume?');"
                            title="<?php echo $article['published'] ? 'Unpublished' : 'Published'; ?>">
                                <?php echo $article['published'] ? 'Unpublished' : 'Published'; ?>
                            </a>
                            </td>
                    
                                            </td>
                </tr>
            <?php endforeach; ?>
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
