<div class="col-md-12 footer">
	<p align="center" class="copy"><b><?= $footer ?><b></p>
</div>
<script type="text/javascript" src="<?=$server_root?>admin/static/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=$server_root?>admin/static/js/script.js"></script>
<script type="text/javascript" src="<?=$server_root?>admin/static/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$server_root?>admin/static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$server_root?>admin/static/lightbox/lightbox-plus-jquery.min.js"></script>

 <script type="text/javascript">
  var slug = function(str) {
  var $slug = '';
  var trimmed = $.trim(str);
  $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
  replace(/-+/g, '-').
  replace(/^-|-$/g, '');
  return $slug.toLowerCase();
}

$('.slug-input,.yourdomain').keyup(function() {
  var takedata = $('.slug-input').val()
  $('.slug-output').val(slug(takedata));
});
</script>
</body>
</html>