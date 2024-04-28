<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>

<div class="container col-sm-7">
<form action="" method="post">
  <div class="form-group">
    <label for="email">IP Address:</label>
    <input type="text" class="form-control" placeholder="IP Address" id="email" name="print_ip" value="<?php echo $this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_ip?>">
  </div>
  <div class="form-group">
    <label for="pwd">Port:</label>
    <input type="text" class="form-control" placeholder="Port" id="pwd" name="print_port" value="<?php echo $this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_port?>">
  </div>
  <div class="form-group form-check">
    <label class="form-check-label">
        <input class="form-check-input"  value="1" type="checkbox"  <?php if($this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_status==1) {echo 'checked';}?> name="print_status"> Print on/off
    </label>
  </div>
    <input type="submit" class="btn btn-primary" value="Submit" name="kot">
</form>
    
    </div>