<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>
<div class="container" style="margin-top:8px ">
    
    
    <?php if(!empty($eroor)){echo $eroor;}?>
    <form action="" method="post" enctype="multipart/form-data" runat="server">
        <div class="form-group">
            <label for="email">Deliver Service Name:</label>
            <input type="text" class="form-control" placeholder="Deliver Service Name" id="email" name="deliver_service_name"  value="<?php if(!empty($this->input->post('deliver_service_name'))){echo $this->input->post('deliver_service_name');}?>">
         <?php echo form_error('deliver_service_name', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
        </div>
     
        
        
         <div class="form-group">
        <label for="email">Service Image</label>
        <input type="file" class="form-control col-sm-5"  accept="image/*"   name="userfile"  id="imgInp"  required> 
          <?php echo form_error('userfile', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
       </div>
       <div class="form-group">
                <img id="blah" src="#" alt="your image" width="350px"  style="display: none" class="rounded"/>
       </div>      

        <input type="submit" class="btn btn-success mt-5" value="Success" name="save">
    </form>
</div>





<script type="text/javascript">
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();    
    reader.onload = function(e) {
        document.getElementById("blah").style.display = "block";
      $('#blah').attr('src', e.target.result);      
    }    
    reader.readAsDataURL(input.files[0]);
  }
}
$("#imgInp").change(function() {
  readURL(this);
});
</script>

