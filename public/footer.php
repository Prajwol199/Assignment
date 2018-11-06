<?php
	$footer_page = new UserEndController();
	$select_page = $footer_page->select_footer_page();
?>
<div class="col-md-12 footer">
	<u><h2 align="center">Pages</h2></u>
	<?php foreach ($select_page as $key => $value) { ?>
		<div align="center">
			<a href="<?=$server_root?>user/display-page/<?=$value['slug']?>/<?=$value['id']?>" style="color: white;"><?= $value['name'] ?></a><br>
		</div>
	<?php } ?>
	<br>
	<p align="center"><a href=""><i class="fa fa-facebook-square" style="font-size:36px;"></i></a>
					<a href=""><i class="fa fa-twitter" style="font-size:36px;"></i></a>
					<a href=""><i class="fa fa-youtube-play" style="font-size:36px;"></i></a>
					<a href=""><i class="fa fa-linkedin-square" style="font-size:36px;"></i></a>
	</p>
	<p align="center" class="copy"><b><?= $footer ?><b></p>
</div>

<!-------------------- top button ---------------------->
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
<!-------------------- top button ---------------------->

<script type="text/javascript" src="<?=$server_root?>admin/static/ckeditor/ckeditor.js"></script>
<!-- <script type="text/javascript" src="<?=$server_root?>admin/static/js/script.js"></script> -->
<script type="text/javascript" src="<?=$server_root?>admin/static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$server_root?>admin/static/owl-slider/jquery.min.js"></script>
<script type="text/javascript" src="<?=$server_root?>admin/static/owl-slider/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?=$server_root?>admin/static/lightbox/lightbox-plus-jquery.min.js"></script>
</body>
</html>