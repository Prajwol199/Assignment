<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/style.css">

</head>
<body>
<div class=" navbar navbar-default container-fluid">
    <div class="col-md-12 header">
        <div class="col-md-3">
            <a href="<?=$server_root?>admin/home.php?page=dashboard"><img class="img-responsive img-circle" src="../admin/static/images/logo.jpg" width="120px" ></a>
        </div>
        <div class="col-md-9 title">
            <h1 align="center" style="margin-left:-250px;"><?= $site_name ?></h1>       
        </div>
    </div>
</div>
<div class="col-md-12">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav" style="padding-left:400px;">
                <li><a href="<?=$server_root?>admin/home.php?page=page_manager">Page Manager</a></li>
                <li><a href="<?=$server_root?>admin/home.php?page=admin-manager">Admin Manager</a></li>
                <li><a href="<?=$server_root?>admin/home.php?page=image_manager">Image Manager</a></li>
                <li><a href="<?=$server_root?>admin/home.php?page=logout">Logout</a></li>
            </ul>
        </div>
    </nav>
</div>