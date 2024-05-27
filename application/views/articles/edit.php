<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link href="<?php echo base_url('./assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('./assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body class="bg-gradient-primary">
    <div class="body-wrapper">
        <div class="container-fluid">
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-4">
                <div class="d-sm-flex d-block justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold text-uppercase">Edit Article</h5>
                    <nav aria-label="breadcrumb" class="d-flex align-items-center">
                        <ol class="breadcrumb d-flex align-items-center">
                            <li class="breadcrumb-item">
                                <a class="text-decoration-none" href="<?php echo site_url('articles'); ?>">Back To aticles</a>
                            </li>
                            <li class="breadcrumb-item text-primary" aria-current="page">
                                Edit Article
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
    <div class="col-lg-7 col-xlg-9 col-md-7">
        <div class="card">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade active show" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <div class="card-body">
                        <form action="<?= base_url('articles/edit/' . $article['articleid']); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-material">
                            <div class="mb-3">
                                <label class="font-medium mb-2">Title</label>
                                <input type="text" value="<?= $article['title']?>" name="title" class="w-full h-[45px] form-control-line">
                            </div>
                            <div class="mb-3">
                                <label class="font-medium mb-2">Keywords</label>
                                <input type="text" value="<?= $article['keywords']?>" name="keywords" class="w-full h-[45px] form-control-line">
                            </div>
                            <div class="mb-3">
                                <label class="font-medium mb-2">Abstract</label>
                                <textarea name="abstract" id="abstract" class="w-full h-[45px] form-control-line"><?= $article['abstract']?></textarea>
                                <script>
                                    CKEDITOR.replace('abstract');
                                </script>
                            </div>
                            <div class="mb-3">
                                <label class="font-medium mb-2">DOI</label>
                                <input type="text" value="<?= $article['doi']?>"  name="doi" class="w-full h-[45px] form-control-line">
                            </div>
                            <div class="mb-3">
                                <label class="font-medium mb-2">Volume ID</label>
                                <select name="volumeid" class="w-full h-[45px] form-control-line">
                                    <?php foreach($volumes as $volume): ?>
                                        <option value ="<?php echo $volume['volumeid'];?>"><?php echo $volume['vol_name'];?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="error"><?php echo form_error('volumeid'); ?></small>
                            </div>
                            <div class="mb-3">
                                <label class="font-medium mb-2">File (PDF)</label>
                                <input type="file" name="filename" class="w-full h-[45px] form-control-line" accept=".pdf">
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="btn-filled w-[159px] h-[44px]">Update Article</button>
                            </div>
                        </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
