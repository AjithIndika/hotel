<div class="container ">
 
    
    <?php if(!empty($eroor)){echo $eroor;}?>
    <div class="col-sm-6">
        <form action="" method="post">
  <div class="form-group">
    <label for="email">Drive Name:</label>
    <input type="text" class="form-control" placeholder="Drive Name:" id="email" name="drive_name" required>
   <?php echo form_error('drive_name', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
  </div>
  
 
            <input type="submit" class="btn btn-primary" value="Submit" name="dive_dtails"></button>
</form>
    </div>
    </div> 