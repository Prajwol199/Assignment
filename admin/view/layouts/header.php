<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/bootstrap-glyphicons.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/lightbox/lightbox.min.css">
    <script type="text/javascript" src="<?=$server_root?>admin/static/js/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">


  <!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->


</head>
<body>
<div class=" navbar navbar-default container-fluid">
    <div class="col-md-12 header">
        <div class="col-md-3">
            <a href="<?=$server_root?>admin"><img class="img-responsive img-circle" src="<?=$server_root?>/admin/static/images/logo.jpg" width="120px" ></a>
        </div>
        <div class="col-md-9 title">
            <h1 align="center" style="margin-left:-250px;"><?= $site_name ?></h1>       
        </div>
    </div>
</div>
<div class="col-md-12">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav" style="padding-left:300px;">
                <li><a href="<?=$server_root?>admin/home/page_manager">Page Manager</a></li>
                <li><a href="<?=$server_root?>admin/home/image_manager">Image Manager</a></li>
                <li><a href="<?=$server_root?>admin/home/admin-manager">Admin Manager</a></li>
                <li><a href="<?=$server_root?>admin/home/site_configuration">Site Configuration</a></li>
                <li><a href="<?=$server_root?>admin/home.php?page=logout">Logout</a></li>
            </ul>
        </div>
    </nav>
</div>