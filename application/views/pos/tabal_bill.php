<?php 
 if (empty($this->session->user_type =="Cashier")) {
     redirect(base_url());
}
 ?>


<div class="col-sm-12  mt-4">    
  <!--   <button type="button" class="btn btn-success">
        
       <h2 >Table Number <?php if(!empty($_SESSION['table_no'])){echo  $this->db->select('*')->get_where('table_no', array('table_id' => $_SESSION['table_no']))->row()->table_no;} ;?> </h2>

    </button>   !------->  
    <!--
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#waiter">
        <h2 >Waiter Number <?php if(!empty($_SESSION['waiter'])){ echo $_SESSION['waiter'];}?></h2>
    </button> 
    !--->
</div>

<div class="container col-12">
   
<div class="row ">  
   <div class="col-sm-6 mt-4">
        
        <!---- biling !----->
            <div class="col-sm-12 ">
                <div class="mb-3 mt-2 text-success"><h3>Table Bill  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#waiter"><h4>Waiter Number <?php if(!empty($_SESSION['waiter'])){ echo $this->db->select('*')->get_where('waiter', array('waiter_no' =>$_SESSION['waiter']))->row()->waiter_name;}?></h4></button></h3></div>
        <table style="width: 100%">
            <tr>
                <td>Price</td>
                <td>Quntity</td>
                <td>Total</td>
                <td></td>
            </tr>
            
            <?php 
            $as = $this->table_model->table_bill_temp();
            $total_bill=array();
            foreach ($as as $ff){ 
                $total_bill[]=$ff->total;
                ?>
            
             <tr>
                 <td><?php echo number_format($this->db->select('*')->get_where('temp_bill', array('temp_id' =>$ff->temp_id))->row()->value,2)?></td>
                <td><?php echo $ff->itemname_name?> &MediumSpace; <?php echo $ff->quantity?></td>
                <td><?php echo  number_format($ff->total,2)?></td>
                 <td><button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#update<?php echo $ff->temp_id?>">Update</button>
                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#delet<?php echo $ff->temp_id?>">Delete</button></td>
            </tr>
            
           
            
            
            <!-- delet -->
<div class="modal" id="delet<?php echo $ff->temp_id?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete <?php echo $ff->itemname_name?> ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="" method="post">
              <input type="hidden" value="<?php echo $ff->temp_id?>" name="temp_id">
              <input type="submit" class="btn btn-danger mb-2"  value="Yes Delet" name="delet">
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

            
                
            <!-- update -->
<div class="modal" id="update<?php echo $ff->temp_id?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update <?php echo $ff->itemname_name?> ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="" method="post">
              <input type="number" value="<?php echo number_format($this->db->select('*')->get_where('temp_bill', array('temp_id' =>$ff->temp_id))->row()->value,2)?>" name="total"   class="form-control"></br>
              <input type="hidden" value="<?php echo $ff->temp_id?>" name="temp_id">
              <input type="submit" class="btn btn-success mb-2"  value="Update Value" name="upvalue">
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
           <?php  }   ?>
            
            <tr>
                <td></td>
                <td></td>
                <td><?php echo  number_format(array_sum($total_bill),2)?></td>
                <td></td>
            </tr>    
          
        </table>
        <div > 
            
                </form>
                <?php if(!empty($total_bill) AND !empty($_SESSION['waiter'])){ ?>
                 <form action="<?php echo base_url('table/prosess')?>" method="post">
                     
                     <button type="button" class="btn btn-success col-sm-4"  data-toggle="modal" data-target="#payment">Print</button>
                     <a href="<?php echo base_url('table/deletBill')?>"> <button type="button" class="btn btn-success col-sm-4" >Delete Bill</button></a>
          </form>
            
                <?php }?>
        </div>
        
        
        <!-- The Modal -->
<div class="modal" id="payment">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Select  Payment Method</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div class="row">
        <?php 
       $all_payment=$this->Shop_model->all_payment();
        foreach ($all_payment as $all_payment) { ?>
              <div class="col-sm-6">
          <form action="<?php echo base_url('table/prosess?pay='.$all_payment->payment_method_id.'')?>" method="post">
              <button type="submit" class="btn btn-success col-sm-12 mb-2"><h2><?php echo $all_payment->payment_name?></h2></button>
          </form>
              </div>
 <?php   } ?>
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
        
        
        
    </div>
        
        
     
        <!---- biling end !------->
    </div> 
    
    
    
    
    
    <div class="col-sm-5 mt-4 sticky-top" style="">
        <div class="row mt-3"  >
              <div class="col-sm-6  "style="margin-top:-20px" > 
        <a href="<?php echo base_url('table/other');?>" class="col-sm-12">
        <button type="button" class="btn btn-secondary col-sm-12"> <h3 class="text-light" >Other Items</h3></button>  
    </a>
    </div>
       <?php foreach ($all_categories as $cat) {?>
            <?php if($cat->categories_name=='Others'){}else{?>
     <div class="col-sm-6" style="margin-top:-20px"> 
        <a href="<?php echo base_url('table/tablelist?cat='.$cat->categories_id.'');?>" class="col-sm-12">
        <button type="button" class="btn btn-success col-sm-12"> <h3 class="text-light" ><?php echo $cat->categories_name?></h3></button>  
    </a>
    </div>
       <?php }}?> 
    
        </div>   
    </div>

    

   
 
</div>

 </div>



<!-- The Modal -->
<div class="modal" id="waiter">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Select Waiter</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <div class="row col-sm-12">
        
          
<?php
$all_waitr = $this->Shop_model->waiters_all();
foreach ($all_waitr as $all_waitr) {
    ?>
                        <div class="col-sm-6 mb-4">
                            <form action="<?php echo base_url('table/tabal_bill') ?>" method="post">
                                <input type="hidden" value="<?php echo $all_waitr->waiter_no ?>" name="waiter_name">
                                <input type="submit" class="btn btn-success col-sm-12 "  value="<?php echo $all_waitr->waiter_no ?>-<?php echo $all_waitr->waiter_name ?>" name="waiter" style="height: 60px; font-size: 30px ;font-weight: bold">  
                            </form>
                        </div>
<?php } ?>
           <div class="col-sm-6  "style="margin-top:-20px" > 
                    <a href="<?php echo base_url('supplier/suplist'); ?>" class="col-sm-12">
                        <button type="button" class="btn btn-secondary col-sm-12"> <h3 class="text-light" >Supplier's Account</h3></button>  
                    </a>
                </div>
              
              
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


    
        
   
    



    
    