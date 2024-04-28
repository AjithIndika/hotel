<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>


<style>
    h3{
         text-shadow: black 0.1em 0.1em 0.1em;
    }
</style>

<div class="container col-sm-11">
<div class="row">
  <div class="col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Today Selling</h2>
        <h3 class="text-success"><?php $this->Report_model->today_selling()?></h3>
      </div>
    </div>
  </div>
    
    
    <div class="ml-1 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Today Delete</h2>
        <h3 class="text-success"><?php $this->Report_model->today_delet_selling()?></h3>
      </div>
    </div>
  </div>
    
    
      <div class="ml-1 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Today Income</h2>
        <h3 class="text-success"><?php $this->Report_model->in_cashier()?></h3>
      </div>
    </div>
  </div>

</div>
</div>



<div class="container col-sm-11">
<div class="row">
    <?php 
  $all_payment=  $this->Shop_model->all_payment();
  foreach ( $all_payment as  $all_payment) { ?>
  <div class="col mb-2 shadow-lg p-3 mb-5 bg-white rounded ml-2">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php echo $all_payment->payment_name?></h2>
        <h3 class="text-success"><?php $payment_method_id=$all_payment->payment_method_id;$this->Report_model->today_cash($payment_method_id)?></h3>
      </div>
    </div>
  </div>
    <?php }?>
</div>
</div>


<div class="container">
<div class="row">
 <div class="ml-2 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Today Top 5</h2>
        <h4 class="text-success"><?php $this->Report_model->topfive()?></h4>
      </div>
    </div>
  </div>
</div>
</div>


<div class="container col-sm-12  mb-2 shadow-lg  mb-5 bg-white rounded">
  <h2>Cashier's Selling</h2>
           
  <table class="table ml-2 col-sm-12 mb-2 shadow-lg p-3 mb-5 bg-white rounded">

    <tbody>
         <?php 
    $cash='';
   $today_cashi= $this->Report_model->totay_Cashier();
    foreach ($today_cashi as $today_cashi) {        
        ?>   
      <tr>
          <td><a href="<?php echo base_url('pos/workprint/'.$today_cashi->user_id.'');?>">Cashier <?php echo  $today_cashi->uname;?></a></td>
         <?php 
  $all_payment=  $this->Shop_model->all_payment();
  foreach ( $all_payment as  $all_payment) { ?>
        <td>
  <?php echo $all_payment->payment_name?> /
 <?php $cashier=$today_cashi->cashier;
       $payment_method_id=$all_payment->payment_method_id;
       $this->Report_model->today_cash_cashier($payment_method_id,$cashier)?></td>
  <?php } ?>
        
        <td>
       <a href="" data-toggle="modal" data-target="#myModal<?php echo $today_cashi->cashier?>">Bill 
        <?php 
        $cashier=$today_cashi->cashier;
        $da=date('Y-m-d');
        $this->Report_model->cashi_wice_bill_pay($cashier,$da);
        ?>
       </a>
        </td>
      </tr>
      
      
      
      
      <!-- The Modal -->
<div class="modal" id="myModal<?php echo $today_cashi->cashier?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Payment View</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          
          <div class="container col-sm-11">  
              
              <div class="row">
                <div class="col">Bill No</div>
                <div class="col">Supplier</div>
                <div class="col">Rs</div>
              </div>
          
                      <?php 
        $cashier=$today_cashi->cashier;
        $da=date('Y-m-d');
        $total='';
      $rep=  $this->Report_model->report_bill_pay($cashier,$da);
      foreach ($rep as $rep) {
         // $total +=$rep->pay;
          ?>
              <div class="row">
                <div class="col"><?php echo $rep->supplier_bill_no?></div>
                <div class="col"><?php echo $rep->supplier_name?></div>
                <div class="col"><?php echo number_format($rep->pay,2)?></div>
              </div>
      <?php }?>
          
       
         
              
     
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
    </tbody>
  </table>
</div>



  
       <!-------  !--------------->
       
       
       
<div class="container col-sm-11">
<div class="row">
  <div class="col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Last Day Selling</h2>
        <h3 class="text-success"><?php $this->Report_model->lastday_selling()?></h3>
      </div>
    </div>
  </div>
    
    
    <div class="ml-1 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Last Day Delete</h2>
        <h3 class="text-success"><?php $this->Report_model->lastday_delet_selling()?></h3>
      </div>
    </div>
  </div>
    
    
      <div class="ml-1 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Last Day Income</h2>
        <h3 class="text-success"><?php $this->Report_model->lastday_in_cashier()?></h3>
      </div>
    </div>
  </div>

</div>
</div>


<div class="container col-sm-11">
<div class="row">
    <?php 
  $all_payment=  $this->Shop_model->all_payment();
  foreach ( $all_payment as  $all_payment) { ?>
  <div class="col mb-2 shadow-lg p-3 mb-5 bg-white rounded ml-2">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php echo $all_payment->payment_name?></h2>
        <h3 class="text-success"><?php $payment_method_id=$all_payment->payment_method_id;$this->Report_model->lastday_cash($payment_method_id)?></h3>
      </div>
    </div>
  </div>
    <?php }?>
</div>
</div>





<div class="container  mb-2 shadow-lg p-3 mb-5 bg-white rounded">
  <h2>Last Day Cashier's Selling</h2>
           
  <table class="table ml-2 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">

    <tbody>
         <?php 
    $cash='';
   $lastday_cashi= $this->Report_model->lastday_Cashier();
    foreach ($lastday_cashi as $lastday_cashi) {        
        ?>   
      <tr>
        <td>Cashier <?php echo  $lastday_cashi->uname//$this->db->select('*')->get_where('users', array('user_id' =>$lastday_cashi->cashier))->row()->uname//$today_cashi->cashier;?> /<?php $cashier= $today_cashi->cashier;$this->Report_model->lastday_cashier_wice($cashier)?></td>
         <?php 
  $all_payment=  $this->Shop_model->all_payment();
  foreach ( $all_payment as  $all_payment) { ?>
        <td><?php echo $all_payment->payment_name?> / <?php $cashierls=$lastday_cashi->cashier;$payment_method_idls=$all_payment->payment_method_id;$this->Report_model->cashiar_lastday_cash($payment_method_idls,$cashierls)?></td>
  <?php } ?>
      </tr>
    <?php }?>
    </tbody>
  </table>
</div>

       
<div class="container  mb-2 shadow-lg p-3 mb-5 bg-white rounded">
  <h2>Last Day Waiters</h2>
           
  <table class="table ml-2 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">

    <tbody>
         <?php 
    $cash='';
   $lastDay_waiter= $this->Report_model->lastday_waiter();
    foreach ($lastDay_waiter as $tastday) { 
if(!empty($tastday->waiter)){       
        ?>   
      <tr>
        <td> <?php echo  $tastday->waiter?> / <?php $waiter= $tastday->waiter;$this->Report_model->lastday_waiter_wice($waiter)?></td>
         <?php 
  $all_payment=  $this->Shop_model->all_payment();
  foreach ( $all_payment as  $all_payment) { ?>
        <td><?php echo $all_payment->payment_name?> / <?php $waiter=$tastday->waiter;$payment_method_id=$all_payment->payment_method_id;$this->Report_model->waiter_lastday_cash($payment_method_id,$waiter)?></td>
  <?php } ?>
      </tr>
    <?php }}?>
    </tbody>
  </table>
</div>

<!----
<div class="container">
    <hr></hr>
    <div><h2>Cashier's Selling</h2><hr></hr></div>
<div class="row">
    <?php 
    $cash='';
   $today_cashi= $this->Report_model->totay_Cashier();
    foreach ($today_cashi as $today_cashi) {    

        ?>      
  <div class="ml-3 col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Cashier <?php echo  $this->db->select('*')->get_where('users', array('user_id' =>$today_cashi->cashier))->row()->uname//$today_cashi->cashier;?></h2>
        <h3 class="text-success"><?php $cashier= $today_cashi->cashier;$this->Report_model->cashier_wice($cashier)?></h3>
      </div>
    </div>
  </div>
    
  </br>
    <?php 
  $all_payment=  $this->Shop_model->all_payment();
  foreach ( $all_payment as  $all_payment) { 
?>
  <div class="col mb-2 shadow-lg p-3 mb-5 bg-white rounded ml-2">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title"><?php echo $all_payment->payment_name?></h2>
        <h3 class="text-success"><?php $cashier=$today_cashi->cashier;$payment_method_id=$all_payment->payment_method_id;$this->Report_model->today_cash($payment_method_id,$cashier)?></h3>
      </div>
    </div>
  </div>
    <?php }?>

    </br>
    
 <?php  } ?>
</div>
</div>
  
       
     <!---- delivery !------------------>  
        
            <!-------  !--------------->
       
       
       
<div class="container col-sm-11">
<div class="row">
    <?php 
    $diliv =$this->Report_model->lastday_diliver();
    foreach ($diliv as $diliv) { 
        if(!empty($diliv->deliver_service_name)){?>
        
  
  <div class="col mb-2 shadow-lg p-3 mb-5 bg-white rounded">
    <div class="card">
      <div class="card-body">
        <h2 class="card-title">Last Day <?php echo   $diliv->deliver_service_name; ?></h2>
        <h3 class="text-success"><?php $servi=$diliv->deliver_service;$this->Report_model->lastday_deliver_wis($servi)?></h3>
      </div>
    </div>
  </div>
        <?php  }}?>

</div>
</div>



            