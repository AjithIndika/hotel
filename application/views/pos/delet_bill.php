    <?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>

    

<div class="container " style="margin-top: 150px">
    
    
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th>No</th>
                <th>Bill Number</th>
                <th>Date Time</th>
                <th>Total</th>
                <th></th>               
            </tr>
        </thead>
        <tbody>
           <?php 
           $coun=1;
      $all_dilivr=  $this->Shop_model->all_bill();
      foreach ($all_dilivr as $de) { ?>
                <tr>
                    <td><?php echo $coun++?></td>
                    <td><?php echo $de->bill_date; ?></td>
                    <td><?php echo $de->bill_number; ?></td>
                    <td><?php echo number_format($de->total_bill,2); ?></td>
                    <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delet_bill<?php echo $de->id; ?>"> Delete</button></td>

                </tr>
                
                <!-- The Modal -->
<div class="modal" id="delet_bill<?php echo $de->id; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Conformation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <h3>  Do you need delete this?</h3>
        
        <form action="" method="post">
            <input type="hidden" value="<?php echo $de->bill_number; ?>" name="bill_number">
            <input type="submit" class="btn btn-primary mt-3" value="Yes Delet" name="delet">
            
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

            <?php } ?>
        </tbody>
     
    </table>
</div>
