<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/lightbox/lightbox.min.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/lightbox/lightbox.css">


</head>
<body>
<div class=" navbar navbar-default container-fluid">
    <div class="col-md-12 header">
        <div class="col-md-3">
            <a href=""><img class="img-responsive img-circle" src="../admin/static/images/logo.jpg" width="120px" ></a>
        </div>
        <div class="col-md-9 title">
            <h1 align="center" style="margin-left:-250px;"><?= $site_name ?></h1>       
        </div>
    </div>
</div>
<div class="col-md-12">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav" style="padding-left:500px;">
                <li><a href="<?=$server_root?>public/user.php?page=home">Home</a></li>
                <li><a href="<?=$server_root?>public/user.php?page=about">About</a></li>
                <li><a href="<?=$server_root?>public/user.php?page=contact_us">Contact Us</a></li>
            </ul>
        </div>
    </nav>
</div>