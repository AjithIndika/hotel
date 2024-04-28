    <?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>
<div class="container">  
<div class="container" style="margin-top:8px ">
  
    
    
  <h2>Deliver List</h2>
  <table class="table">
    <thead>
      <tr>
        <th></th>
        <th>Deliver Service Name</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
        
        <?php 
      $all_dilivr=  $this->Shop_model->all_dilivr();
      foreach ($all_dilivr as $de) { ?>
        
          
     
      <tr>
          <td><img src="<?php echo base_url('service/'.$de->deliver_image.'')?>" class="img-thumbnail" alt="<?php echo $de->deliver_service_name; ?>" width="200px"></td>
           <td><?php echo $de->deliver_service_name; ?></td> 
           <td>
               <?php if(!empty(	$de->status)){ ?>  
               <form action="" method="post">
                <input type="hidden" name="deliver_id" value="<?php echo $de->deliver_id; ?>">
                <input type="hidden" name="status" value="0">
                <input type="submit" class="btn btn-danger" value="No Service" name="update">
             </form>
                <?php }?>
               
               <?php if(empty(	$de->status)){ ?>  
               <form action="" method="post">
                <input type="hidden" name="deliver_id" value="<?php echo $de->deliver_id; ?>">
                <input type="hidden" name="status" value="1">
                <input type="submit" class="btn btn-success" value="Active Service" name="update">
             </form>
                <?php }?>
               
           </td> 
      </tr>
     <?php  }?>
      
    </tbody>
  </table>
</div>