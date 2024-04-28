<?php
if (empty($this->session->user_type == "Cashier")) {
    redirect(base_url());
}
//$_SESSION['reference_number']='';
//$_SESSION['driver']="";
?>
<div class="col  mt-4 text-center mt-5">

    <div class="row center-block">
        <?php
        $supplier = $this->Supplier_model->all_supplier();
        foreach ($supplier as $supplier) {
            ?>
            <div class="col-sm-6 ">
               <button type="button" class="btn btn-danger btn-success col-sm-12" data-toggle="modal" data-target="#myModal<?php  echo $supplier->supplier_id  ?>"><h3><?php  echo $supplier->supplier_name ?>  /  <?php  if(!empty($supplier->balance)){echo number_format($supplier->balance,2);} ?></h3></button></a>
            </div>
        
        
        <!-- The Modal -->
<div class="modal" id="myModal<?php  echo $supplier->supplier_id  ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Bill</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="" method="post" >
              <div class="contener">
              <div class="form-group">
                        <input type="text" class="form-control" placeholder="Item Quntity" id="email" name="item_quntity" required>
                    </div>
              
               <div class="form-group">
                        <input type="text" class="form-control" placeholder="Item Price" id="email" name="item_price" required>
                          <input type="hidden" class="form-control" value='<?php  echo $supplier->supplier_id  ?>' id="email" name="supplier_id" required>
                    </div>
                  <input type="submit" value="Print" name="new_bill" class="btn btn-success">
          </form>
</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
        
        
            <?php } ?>
    </div>
</div>

