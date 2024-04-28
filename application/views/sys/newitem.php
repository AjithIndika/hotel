<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>
<div class="container" style="margin-top:150px ">
    
    <?php if(!empty($eroor)){echo $eroor;}?>
    <form action="<?php echo base_url('item/newitem')?>" method="post" enctype="multipart/form-data" runat="server">
        <div class="form-group">
            <label for="email">Item Name:</label>
            <input type="text" class="form-control" placeholder="Item Name" id="email" name="itemname_name"  value="<?php if(!empty($this->input->post('itemname_name'))){echo $this->input->post('itemname_name');}?>">
         <?php echo form_error('itemname_name', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
        </div>
        <div class="form-group">
            <label for="pwd">For Person:</label>
            <input type="number" class="form-control col-sm-2" placeholder="For Person" name="person" id="pwd"  value="<?php if(!empty($this->input->post('person'))){echo $this->input->post('person');}?>">
         <?php echo form_error('person', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
        </div>
        <div class="form-group">
            <label for="pwd">Rs/</label>
            <input type="number" step="0.01" min="0" lang="en"  class="form-control col-sm-2" placeholder="Price" id="pwd" name="value" value="<?php if(!empty($this->input->post('value'))){echo $this->input->post('value');}?>">
         <?php echo form_error('value', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
        </div>
        
          <div class="form-group">
            <label for="pwd">Category</label>
            <select class="form-control col-sm-6" name="category_id">
                
                <?php 
                if($this->input->post('category_id')){
                   echo '<option value="'.$this->input->post('category_id').'">'.$this->db->select('*')->get_where('categories', array('categories_id' =>$this->input->post('category_id')))->row()->categories_name.'</option>';
                }
               
                foreach ($all_categories as $cate) {
                    echo '<option value="'.$cate->categories_id.'">'.$cate->categories_name.'</option>';
        
                   }?>
                
            </select>
            
         <?php echo form_error('category_id', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
        </div>
        
        
         <div class="form-group">
        <label for="email">Item Image</label>
        <input type="file" class="form-control col-sm-5"  accept="image/*"   name="userfile"  id="imgInp"  > 
          <?php echo form_error('userfile', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
       </div>
       <div class="form-group">
                <img id="blah" src="#" alt="your image" width="350px"  style="display: none" class="rounded"/>
       </div>      

        <input type="submit" class="btn btn-success mt-5" value="Success" name="upload">
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

