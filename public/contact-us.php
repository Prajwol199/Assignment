<?php
$contact = new ContactUsController();
  if(isset($_POST['contact'])){
    $contact->contact_us();
  }
?>
<div class=" col-md-12 col-md-offset-3">
  <div class="col-md-6"><br>
    <div class="error" id="error" style="color:red;"></div><br>
    <form method="post" name="pageForm">
       <div class="form-group">
          <label for="name" id="contact_name"> Name</label>
          <input type="text" name="name" id="name" class="form-control">
       </div>
        <div class="form-group">
          <label for="email"> Email</label>
          <input type="email" name="email" id="email" class="form-control">
       </div>
      <div class="form-group">
          <label for="phone"> Phone Number</label>
          <input type="text" name="phone" id="phone" class="form-control">
       </div>
       <div class="form-group">
          <label> Message</label><br>
          <textarea name="message" rows="6" cols="50" class="form-control ckeditor"></textarea>
       </div>
       <p class="robotic"  id="pot">
            <label>If you're human leave this blank:</label>
            <input name="robotest" type="text" id="robotest" class="robotest" />
        </p>
       <div class="form-group">
          <button class="btn btn-success btn pull-right btn-lg" name="contact">Submit</button>
      </div>
    </form>
  </div>
</div>