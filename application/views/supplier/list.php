<?php
if (empty($this->session->user_type == "Cashier")) {
    redirect(base_url());
}
//$_SESSION['reference_number']='';
//$_SESSION['driver']="";
?>
<div class="col  mt-4 text-center mt-5">

    <div class="row center-block">
        <div class="col-sm-6 ">
            <a href="<?php echo base_url('supplier/newbill')?>">  <button type="button" class="btn btn-danger btn-success col-sm-12"><h1>New Bill</h1></button></a>
        </div>
        <div class="col-sm-6">
            <a href="<?php echo base_url('supplier/suppliervice')?>">      <button type="button" class="btn btn-danger btn-success col-sm-12"><h1>Bill Pay</h1></button></a>
        </div>
    </div>
</div>