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
    <script type="text/javascript" src="<?=$server_root?>admin/static/js/jquery.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">

</head>
<body>
<div class=" navbar navbar-default container-fluid">
    <div class="col-md-12 header">
        <div class="col-md-3">
            <a href="<?=$server_root?>"><img class="img-responsive img-circle" src="<?= $server_root?>admin/static/images/logo.jpg" width="120px" ></a>
        </div>
        <div class="col-md-9 title">
            <h1 align="center" style="margin-left:-250px;"><?= $site_name ?></h1>       
        </div>
    </div>
</div>
<div class="col-md-12">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav " style="padding-left:400px;">
                <?php foreach ($pages as $key => $value) { ?>

                    <?php $sub_page = $select_page->dropdown_child($value['id']);?>
                    <?php if(count($sub_page) == 0){ ?>
                        <li><a href="<?=$server_root?>user/display-page/<?=$value['slug']?>/<?=$value['id']?>"><?=$value['name'] ?></a>
                            <?php }else{?>
                            <li class="dropdown"><a href="<?=$server_root?>user/display-page/<?=$value['slug']?>/<?=$value['id']?>" class="dropbtn"><?= $value['name'] ?></a>
                                <div class="dropdown-content">
                                    <ul class="nav navbar-nav ">
                                       <?php foreach ($sub_page as $key => $sub) {?>
                                            <li><a href="<?=$server_root?>user/display-page/<?=$sub['slug']?>/<?=$sub['id']?>"><?= $sub['name'] ?></a>
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </li>
                        </li>
                        <?php }?>
                <?php }?>
                <li><a href="<?=$server_root?>user/request-quote">Request a quote</a></li>
            </ul>
        </div>
    </nav>
</div>
