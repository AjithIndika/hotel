<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>
<div class="container" style="margin-top: 150px">
    <?php if(!empty($eroor)){echo $eroor;}?>
    <form action="" method="post">
  <div class="form-group">
    <label for="email">Shop Name:</label>
    <input type="text" class="form-control" placeholder="Shop Name" id="email" name="shop_name" required value="<?php echo $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_name?>">
  </div>
  <div class="form-group">
    <label for="pwd">Address:</label>
    <input type="text" class="form-control" placeholder="Shop Address" id="pwd" name="shop_addres" required value="<?php echo $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_addres?>">
  </div>
    
  <div class="form-group">
    <label for="pwd">Number:</label>
    <input type="tel" class="form-control" placeholder="Shop Number" id="pwd" name="shop_tp" required value="<?php echo $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_tp?>">
  </div>
 
        <input type="submit" class="btn btn-primary" value="Save" name="save">
</form>
    
    </div>