<?php
$subscriber = new SiteController();
$all_subscriber = $subscriber->select_subscriber();

if(isset($_POST['delete-subscriber'])){
	$subscriber->delete_subscriber();
}
if(isset($_POST['export'])){
	$subscriber->export_subscriber();
}

?>
<div class=" col-md-12 col-md-offset-3">
  <div class="col-md-6">
  		<form method="post">
  			<button type="submit" class="btn btn-primary" name="export">Export to Excel</button><br><br>
  		</form>
  	<table class="table">
  		<tr>
		    <th>S.N</th>
		    <th>Email</th>
		    <th>Date/Time</th>
		    <th>Action</th>
  		</tr>
  		<?php 
        foreach ($all_subscriber as $key => $value) { ?>
          <tr>
          <td><?=$key+1?></td>
          <td><?= $value['email']; ?></td>
          <td><?=$value['date']?></td>
          <td>
          	<form method="post">
            <button type="submit" name='delete-subscriber' value="<?=$value['id']?>" class="btn btn-danger" onclick="return confirm('are you sure delete')"><i class="glyphicon glyphicon-trash"></i> Delete</button> </form>
          </td>
        <?php } ?>
  	</table>
  </div>
</div>