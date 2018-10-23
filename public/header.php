<?php
$select_page = new UserEndController();
$pages = $select_page->select_page();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=$server_root?>admin/static/lightbox/lightbox.css">


</head>
<body>
<div class=" navbar navbar-default container-fluid">
    <div class="col-md-12 header">
        <div class="col-md-3">
            <a href="<?=$server_root?>public/user.php?page=home"><img class="img-responsive img-circle" src="../admin/static/images/logo.jpg" width="120px" ></a>
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
                <?php foreach ($pages as $key => $value) { ?>
                <li><a href="<?=$server_root?>public/user.php?page=display-page&id=<?=$value['id']?>"><?=$value['name'] ?></a></li>
                <?php }?>
            </ul>
        </div>
    </nav>
</div>
<!-- <div class="vertical-menu">
  <a href="#" class="active">Home</a>
  <a href="#">Link 1</a>
  <a href="#">Link 2</a>
  <a href="#">Link 3</a>
  <a href="#">Link 4</a>
</div> -->