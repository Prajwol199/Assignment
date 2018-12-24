<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo$title?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/css/navigation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/css/bootstrap-glyphicons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo$server_root?>admin/static/lightbox/lightbox.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->


</head>
<body>
<div class="top-time">
    <div class="container-fluid">
               <div class="col-md-12">
            <h1 align="center" class="admin_title"><?php echo $site_name ?></h1>       
        </div>
    </div>
</div>
<div class="nav">
    <div class="nav-top">
        <a href="<?php echo$server_root?>admin"><img class="img-responsive img-circle" src="<?php echo$server_root?>/admin/static/images/logo.jpg" width="150" ></a>
        <h4></h4>
        <p></p>
    </div>

    <div class="navlinks">
        <div class="menu">
            <ul>
                <li><a href="<?php echo$server_root?>admin/home/page-manager"><i class="glyphicon glyphicon-sound-dolby"></i> Page Manager</a></li>
                <li><a href="<?php echo$server_root?>admin/home/post-manager"><i class="glyphicon glyphicon-book"></i> Post Manager</a></li>
                <li><a href="<?php echo$server_root?>admin/home/slider-manager"><i class="glyphicon glyphicon-fast-forward"> </i> Slider Manager</a></li>
                <li><a href="<?php echo$server_root?>admin/home/image-manager"><i class="glyphicon glyphicon-picture"></i> Image Manager</a></li>
                <li><a href="<?php echo$server_root?>admin/home/admin-manager"><i class="glyphicon glyphicon-user"> </i> Admin Manager</a></li>
                <li><a href="<?php echo$server_root?>admin/home/site-configuration"><i class="glyphicon glyphicon-cloud-upload"></i> Site Configuration</a></li>
                <li><a href="<?php echo$server_root?>admin/home/subscribers"><i class="glyphicon glyphicon-download-alt"></i> Subscribers</a></li>
                <li><a href="<?php echo$server_root?>admin/home/logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</div><!--end of navigation-->