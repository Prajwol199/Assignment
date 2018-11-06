<?php
$selectImg = new ImageController();

$image = $selectImg->selectimage();

?>

<div class="container">
  <?php
     if (isset($_SESSION['welcome'])):?>
        <div class="alert alert-success">
            <h1 align="center"><i class="glyphicon glyphicon-info-sign"></i> <?= $_SESSION['welcome']; ?></h1>
        </div>
        <?php unset($_SESSION['welcome']) ?>
    <?php endif; ?> 

  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 30px;">
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
        <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>LA is always so much fun!</p>
      </div>
        </div>

        <div class="item">
          <img src="<?=$server_root?>admin/static/images/pageImage/5894f1f3f37d32429e02d76fe79a433b.jpg" alt="Chicago" style="width:100%;height: 600px;">
        <div class="carousel-caption">
          <h3>Chicago</h3>
          <p>Thank you, Chicago!</p>
        </div>
        </div>
      
        <div class="item">
          <img src="<?=$server_root?>admin/static/images/pageImage/151c72ebe3fabc61e276ae3277aaf6c2.jpg" alt="Chicago" style="width:100%;height: 600px;">
        </div>
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
</div>