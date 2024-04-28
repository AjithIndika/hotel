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
        $bil=$this->Supplier_model-> all_bill();
        foreach ($bil as $bil) {?>
        <div class="col-sm-6 mt-2">
            <button type="button" class="btn btn-danger btn-success col-sm-12" data-toggle="modal" data-target="#myModal<?php  echo $bil->supplier_bill_no?>"><?php echo $bil->supplier_bill_no;?> -  <?php echo $bil->supplier_name;?> - Rs:/ <?php echo number_format($bil->bill_balance,2);?></button>
        </div>
        
        
            <!-- The Modal -->
<div class="modal" id="myModal<?php  echo $bil->supplier_bill_no  ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pay Bill <?php  echo $bil->supplier_bill_no ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="" method="post" >
              <div class="contener">             
              
               <div class="form-group">
                        <input type="text" class="form-control" value='<?php  echo $bil->bill_balance?>' id="email" name="bill_pay" required>
                          <input type="hidden" class="form-control" value='<?php  echo $bil->supplier_bill_no ?>' id="email" name="supplier_bill_no" required>
                    </div>
                  <input type="submit" value="Print" name="bill_balance" class="btn btn-success">
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
            
        <?php }?>
    </div>
</div>
