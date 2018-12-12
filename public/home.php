
<!-- $selectImg = new ImageController();

$image = $selectImg->selectimage(); -->
<?php
	$recent_post = new UserEndController();
	$recent_post_db = $recent_post->recent_post();
	$slider = $recent_post->select_slider();
?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php foreach ($slider as $key => $value) { if ($key == 0){ ?>
	    <li data-target="#myCarousel" data-slide-to="<?php echo$key?>" class="active"></li>
		<?php } else{?>
	    <li data-target="#myCarousel" data-slide-to="<?php echo$key?>"></li>
		<?php } }?>
	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
	   	<?php foreach ($slider as $key => $value) { if ($key == 0) { ?>
	    <div class="item active">
	      <img src="<?php echo$server_root?>admin/static/images/sliderImage/<?php echo$value['image']?>" alt="Chicago" style="width:100%;height: 600px;">
	    <div class="carousel-caption">
	      <h3><?php echo$value['title']?></h3>
	      <p><?php echo$value['description']?></p>
	    </div>
	    </div>
			<?php }else{ ?>
	    <div class="item">
	      <img src="<?php echo$server_root?>admin/static/images/sliderImage/<?php echo$value['image']?>" alt="Chicago" style="width:100%;height: 600px;" >
	    <div class="carousel-caption">
	      <h3><?php echo$value['title']?></h3>
	      <p><?php echo$value['description']?></p>
	    </div>
	    </div>
		<?php } }?>
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

<div class="col-md-12">
	<h1 align="center"><b>Recent Posts</b></h1>
	<?php foreach ($recent_post_db as $key => $value) {?>
		<div class="col-md-6 tesst">
			<h2><?php echo ucfirst($value['title'])?></h2>
			<p>
				<?php
					$length = strlen($value['content']);
					if($length < 300){
						echo $value['content'];
					}else{
						echo substr($value['content'],0,300).'...';
					}
				?>						
			</p>
			<?php
				$id = $value['id'];
				$image = $recent_post->select_image_recent($id);
				foreach ($image as $key => $image) { ?>
					<a class="example-image-link" href="<?php echo $server_root?>admin/static/images/pageImage/<?php echo $image['image'] ?>" data-lightbox="a"><img src="<?php echo $server_root?>admin/static/images/cropImage/<?php echo $image['crop'] ?>" class="img-responsive img-rounded " style=" padding: 20px; margin-left: 25%"></a>
			<?php } ?>
			<span class="read"><a href="<?php echo $server_root?>user/read-more/<?php echo $value['id']?>" style="font-size: 20px;"><button class="btn btn-success">Read More</button></a></span>
		</div>
	<?php } ?>
	<span class="viewall"><a href="<?php echo $server_root?>user/view-all-post" align="center"><button class="btn btn-primary btn-lg">View All Posts</button></a></span>
</div>