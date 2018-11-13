<?php
$country = new UserEndController();
$quote = new RequestQuoteController();

$country_select = $country->select_country();

if(isset($_POST['quote'])){
    $quote->quoteMail();
}
?>
<div class=" col-md-12 col-md-offset-3">
  <div class="col-md-6"><br>
    <div class="error" id="error" style="color:red;"></div><br>
    <form method="post" name="pageForm" onsubmit="return quoteValidate()">
       <div class="form-group">
          <label for="fname" id="contact_name"> First Name</label>
          <input type="text" name="fname" id="fname" class="form-control">
       </div>
        <div class="form-group">
          <label for="lname"> Last Name</label>
          <input type="text" name="lname" id="lname" class="form-control">
       </div>
        <div class="form-group">
          <label for="gender"> Gender</label><br>
          <input type="radio" name="sex" value="male"> Male<br>
          <input type="radio" name="sex" value="female"> Female<br>
       </div>
        <div class="form-group">
          <label for="phone"> Phone Number</label><br>
          Format:+1-222-333-4444<br>
          <input type="text" name="phone" id="phone" class="form-control">
       </div>
        <div class="form-group">
          <label for="email"> Email</label>
          <input type="text" name="email" id="email" class="form-control">
       </div>
        <div class="form-group">
          <label for="add1"> Permanent Address</label>
          <input type="text" name="add1" id="add1" class="form-control">
       </div>
        <div class="form-group">
          <label for="add2"> Temporary Address</label>
          <input type="text" name="add2" id="add2" class="form-control">
       </div>
       <div class="form-group">
          <label for="page">Country</label>
          <select name="country" id="country" class="form-control">
            <option>Select Country</option>
            <?php foreach ($country_select as $key => $value) {?>
            <option value="<?=$value['country_id']?>"><?= $value['country_name'] ?></option>
            <?php } ?>
          </select>
        </div>
         <div class="form-group">
          <label for="page">State/Province</label>
          <select name="state" id="state" class="form-control">
            <option value="">Select country first</option>
          </select>
        </div>
        <div class="form-group">
          <label for="city"> City</label>
          <input type="text" name="city" id="city" class="form-control">
       </div>
        <div class="form-group">
          <label for="postal"> Postal Code</label>
          <input type="text" name="postal" id="postal" class="form-control">
       </div>
        <div class="form-group">
          <label for="date"> Date</label>
          <input type="date" name="date" id="date" class="form-control">
       </div>
       <div class="form-group">
        <label for="contact"> Contact me via</label><br>
          <input type="checkbox" name="contact[]" value="email"> Email<br>
          <input type="checkbox" name="contact[]" value="phone"> Phone<br>
          <input type="checkbox" name="contact[]" value="post"> Post<br><br>
       </div>
       <div class="form-group">
         <label for="service"> Services Interested</label>
         <select name="service[]" id="service" class="form-control" multiple>
            <option value="web">Web Development</option>
            <option value="ccna">CCNA</option>
            <option value="android">Android App</option>
            <option value="system">System Administrator</option>
          </select>
       </div>
       <div class="form-group">
          <label> Other Notes</label><br>
          <textarea name="note" rows="6" cols="50" class="form-control ckeditor"></textarea>
       </div>
       <p class="robotic"  id="pot">
            <label>If you're human leave this blank:</label>
            <input name="robotest" type="text" id="robotest" class="robotest" />
        </p>
       <div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg" name="quote">Submit</button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'http://localhost/cms/admin/controller/ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'http://localhost/cms/admin/controller/ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
