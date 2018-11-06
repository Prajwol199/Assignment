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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">

</head>
<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<div class=" navbar header">
    <div class="col-md-12 ">
        <div class="col-md-3">
            <a href="<?=$server_root?>"><img class="img-responsive img-circle" src="<?= $server_root?>admin/static/images/logo.jpg" width="150" ></a>
        </div>
        <div class="col-md-7 title">
            <h1 align="center"><?= $site_name ?></h1>       
        </div>
        <div class="col-md-2 date">
            <h4 align="center"><?= date("l").' '.date("Y-m-d") ?></h4>
        </div>
    </div>
</div>

<div class="col-md-12">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav " style="padding-left:300px;">
                <?php foreach ($pages as $key => $value) { ?>
                    <?php $sub_page = $select_page->dropdown_child($value['id']);?>
                    <?php 
                    if(count($sub_page) == 0){ ?>
                        <li><a href="<?=$server_root?>user/display-page/<?=$value['slug']?>/<?=$value['id']?>"><?=$value['name'] ?></a>
                            <?php } else { ?>
                            <li class="dropdown"><a href="<?=$server_root?>user/display-page/<?=$value['slug']?>/<?=$value['id']?>" class="dropbtn"><?= $value['name'] ?></a>
                                <div class="dropdown-content">
                                    <ul class="nav navbar-nav ">
                                       <?php foreach ($sub_page as $key => $sub) {?>
                                            <li><a href="<?=$server_root?>user/display-page/<?=$sub['slug']?>/<?=$sub['id']?>"><?= $sub['name']?></a>
<!--                                                 <?php
                                                    var_dump( headers_sent() );
                                                ?> -->
                                            </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </li>
                        </li>                        
                    <?php } ?> 
                <?php } ?>
                <li><a href="<?=$server_root?>user/request-quote">Request a quote</a></li>
                <li><a href="<?=$server_root?>user/subscribe">Subscribe</a></li>
                <li><a href="<?=$server_root?>user/contact-us">Contact us</a></li>
            </ul>
        </div>
    </nav>
</div>
