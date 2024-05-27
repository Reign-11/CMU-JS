<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
    <link href="assets/dist/css/style.min.css" rel="stylesheet" />
  
  </head>

  <body>


<!-- New Sections for Announcements, Volumes, News, and Latest Issues -->
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Left Side Container for Announcements, Volume List, and News -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <!-- Announcements Section -->
                    <h3 class="text-center">ANNOUNCEMENTS</h3>
                    <br>
                    <ul>
                        <!-- Add your announcement items here -->
                        <li>Ut consequat, quam a lobortis elementum, mauris felis ultricies ante, sit amet dapibus quam tortor sit amet mi.</li>
                        <br>
                        <li>Pellentesque vel venenatis nisi. Ut scelerisque tortor ut maximus aliquam.</li>
                        <br>
                        <li>Ut consequat, quam a lobortis elementum, mauris felis ultricies ante, sit amet dapibus quam tortor sit amet mi.</li>
                        <br>
                        <li>Pellentesque vel venenatis nisi. Ut scelerisque tortor ut maximus aliquam.</li>
                    </ul>
                    <br>

                    <!-- Volume List Section -->
                    <h3 class="text-center">VOLUMES</h3>
                    <br>
                    <ul class="text-center">
                        <!-- Add your volume list items here -->
                        <?php foreach ($articles as $article): ?>
                        <li><a href=""><?php echo $article['vol_name']; ?></a></li>
                        <br>
                        <?php endforeach; ?>
                    </ul>
                    <br>

                    <!-- News Section -->
                    <h3 class="text-center">NEWS</h3>
                    <br>
                    <ul>
                        <!-- Add your news items here -->
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce placerat, eros a sodales gravida, sem dui rutrum enim, vel vestibulum nunc nisl sed arcu. Proin a rutrum elit, id eleifend mauris. Nam ut urna pharetra eros congue aliquam. Quisque blandit augue eu quam rutrum, sed imperdiet augue euismod. Fusce eu augue eget lectus placerat aliquam vitae at dui. Sed nulla diam, imperdiet eu odio sit amet, auctor mollis massa.</p>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Side Container for Latest Issues -->
        <div class="col-lg-8">
            <h3 class="section-title mb-3" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                Latest Issues
            </h3>

            <!-- Existing content for latest issues -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-20 col-md-20">
                                    <!-- Articles loop -->
                                    <?php foreach ($articles as $article): ?>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="mb-0">Article</h5>
                                                <!-- Keywords -->
                                                <span class="pull-left">
                                                    <a href="#">
                                                        <small type="button" class="label pull-right mb-1 badge text-bg-primary fs-1 zoom-in" data-bs-toggle="modal" data-bs-target="#samedata-modal">
                                                            <?php echo $article['keywords']; ?>
                                                        </small>
                                                    </a>
                                                </span>
                                            </div>
                                            <div class="card-body p-10">
                                                <h5 class="card-title fs-5"><?php echo $article['title']; ?></h5>
                                                <!-- <p class="card-text">
                                                    Authors: <a href=""><?php echo $article['author_name']; ?></a>
                                                </p> -->
                                                <p class="card-text">
                                                    Volume: <a href=""><?php echo $article['vol_name']; ?></a>
                                                </p>
                                                <p class="card-text">
                                                    DOI: <a href=""><?php echo $article['doi']; ?></a>
                                                </p>
                                                <p class="card-text">
                                                    <?php echo $article['abstract']; ?>
                                                </p>
                                            </div>

                                            <div class="card-body button-group d-flex align-items-stretch p-10">
                                                <a href="#" class="btn bg-secondary-subtle text-secondary px-2 d-flex align-items-center">
                                                    <iconify-icon icon="mdi:like-outline" width="24" height="24"></iconify-icon>
                                                    &nbsp; Like
                                                </a>
                                                <a href="#" class="btn bg-secondary-subtle text-secondary px-2 d-flex align-items-center">
                                                    <iconify-icon icon="mage:message-round" width="24" height="24"></iconify-icon>
                                                    &nbsp; Comment
                                                </a>
                                                <div class="ms-auto">
                                                    <a href="#" class="btn bg-secondary-subtle text-secondary px-2 d-flex align-items-center flex-column flex-sm-row">
                                                        <iconify-icon icon="tabler:share" width="24" height="24"></iconify-icon>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
