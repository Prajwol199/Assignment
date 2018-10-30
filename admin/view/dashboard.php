<?php
$selectImg = new ImageController();

$image = $selectImg->selectimage();

?>

<div class="container">
  <h2 align="center" style="color: purple;">Welcome to Dashboard</h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?=$server_root?>admin/static/images/logo.jpg" alt="Los Angeles" style="width:100%; height: 600px;">
      </div>

      <div class="item">
        <img src="<?=$server_root?>admin/static/images/pageImage/5894f1f3f37d32429e02d76fe79a433b.jpg" alt="Chicago" style="width:100%;height: 600px;">
      </div>
    
      <div class="item">
        <img src="<?=$server_root?>admin/static/images/pageImage/151c72ebe3fabc61e276ae3277aaf6c2.jpg" alt="Chicago" style="width:100%;height: 600px;">
      </div>
<!--      <?php foreach ($image as $key => $value) {?>
      <div class="item">
        <img src="../admin/static/images/pageImage/<?= $value['image'] ?>" alt="New york" style="width:100%;">
      </div>
    </div>
    <?php }?> -->

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>