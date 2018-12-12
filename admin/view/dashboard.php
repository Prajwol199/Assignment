<?php
$dashboard = new SiteController();
$view = $dashboard->view_content();
foreach ($view as $key => $value) {
    $page = $view['page'];
    $post = $view['post'];
    $user = $view['user'];
    $slider = $view['slider'];
}
?>
    <?php
 if (isset($_SESSION['welcome'])):?>
    <div class="alert alert-success">
        <h1 align="center"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $_SESSION['welcome']; ?></h1>
    </div>
    <?php unset($_SESSION['welcome']) ?>
<?php endif; ?> 
<div class="content">
    <div class="container-fluid " style="background-color: #ccc">
        <div class="col-md-4">
            <div class="info users-info">
                <h5><i class="fa fa-users"></i> Admin</h5>
                <section>
                    <h3>Total Number of Admin in site: <?php echo$user?><br></h3>
                    <a href="<?php echo$server_root?>admin/home/admin-manager"><button class="btn btn-success btn-lg">View</button></a>
                </section>
                <footer>Admin of site</footer>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info page-info">
                <h5><i class="fa fa-newspaper-o"></i> Pages</h5>
                <section>
                    <h3>Total Number of Pages in site: <?php echo$page?><br></h3>
                   <a href="<?php echo$server_root?>admin/home/page-manager"><button class="btn btn-danger btn-lg">View</button></a>
                </section>
                <footer>Pages in site</footer>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info post-info">
                <h5><i class="fa fa-wpforms"></i> Posts</h5>
                <section>
                    <h3>Total Number of Post in site: <?php echo$post?><br></h3>
                    <a href="<?php echo$server_root?>admin/home/post-manager"><button class="btn btn-primary btn-lg">View</button></a>
                </section>
                <footer>Post in site</footer>
            </div>
        </div>

        <div class="col-md-4">
            <div class="info slider-info">
                <h5><i class="fa fa-image"></i> Slider</h5>
                <section>
                    <h3>Total Number of Slider in site: <?php echo$slider?><br></h3>
                    <a href="<?php echo$server_root?>admin/home/slider-manager"><button class="btn btn-warning btn-lg">View</button></a>
                </section>
                <footer>Slider in site</footer>
            </div>
        </div>
    </div>
</div>