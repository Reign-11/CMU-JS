<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article</title>
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>

<body class="bg-gradient-primary">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-lg-8 col-md-10">
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-4">
                <div class="d-sm-flex d-block justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold text-uppercase"></h5>
                    <nav aria-label="breadcrumb" class="d-flex align-items-center">
                        <ol class="breadcrumb d-flex align-items-center mb-0">
                            <li class="breadcrumb-item">
                                <a class="text-decoration-none" href="<?php echo site_url('articles'); ?>">Articles</a>
                            </li>
                            <li class="breadcrumb-item text-primary" aria-current="page">
                                Add Article
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form method="POST" action="<?php echo site_url('articles/add'); ?>" enctype="multipart/form-data" class="form-horizontal form-material">
                        <div class="mb-3">
                            <label class="col-md-12">Title</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Enter article title" name="title" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-md-12">Keywords</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Enter keywords" name="keywords" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-md-12">Abstract</label>
                            <div class="col-md-12">
                                <textarea name="abstract" id="abstract" placeholder="Enter abstract"></textarea>
                                <script>
                                    CKEDITOR.replace('abstract');
                                </script>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-md-12">DOI</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Enter DOI" name="doi" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-md-12">Volume</label>
                            <div class="col-md-12">
                                <select name="volumeid" class="form-control">
                                    <option value="">Select Volume</option>
                                    <?php foreach($volumes as $volume): ?>
                                    <option value="<?php echo $volume['volumeid']; ?>"><?php echo $volume['vol_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="error"><?php echo form_error('volumeid'); ?></small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-md-12">File (PDF)</label>
                            <div class="col-md-12">
                                <input type="file" name="filename" class="form-control form-control-line" accept=".pdf">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary w-100 py-2 mb-4 rounded-2">
                                Add Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
</body>

</html>
