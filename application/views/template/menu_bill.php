<?php
if (empty($this->session->user_type == "Cashier")) {
    redirect(base_url());
}
?>

<div class="page-wrapper" style="margin-top: -8px">
    <div class="justify-content-center align-items-center col-12 bg-success">
        <div class="row h-100 justify-content-center align-items-center mt-2">   
            <div class="col-sm-7"> <a href="<?php echo base_url('pos/testbill')?>"><h1 class="text-light"><?php echo $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_name ?></h1></a></div>
            <div class="col text-right"><a href="<?php echo base_url('logout') ?>"><i class="fas fa-sign-out-alt fa-2x text-light"> Hi  <?php echo $this->session->uname ?> &MediumSpace; Logout </i> </a></div>
        </div>
    </div>  
    <div class="container h-100 col-12">

        <div class="row h-100 justify-content-center align-items-center mt-2">    
            <div class="col "> <!---<a href="<?php echo base_url('pos/rebill') ?>"><i class="fa fa-print fa-2x" aria-hidden="true"> RE PRINT</i> </a> !--------></div>
            <div class="col "></div>
            <div class="col "></div>
            <div class="col "> <!---<a href="<?php echo base_url('logout') ?>"><i class="fas fa-sign-out-alt fa-2x "> Hi  <?php echo $this->session->uname ?> &MediumSpace; Logout </i> </a>!--------></div>
        </div>



        <div class="row h-100 justify-content-center align-items-center mt-1"> 
            <div class="col ">
                <a href="<?php echo base_url('takeaway') ?>">
                    <button type="button" class="btn <?php
                    if ($_SESSION['colour'] == 'takeaway') {
                        echo 'btn-danger';
                    } else {
                        echo 'btn-success';
                    }
                    ?>  col-sm-12"> <i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i><h3 class="text-light">  TAKE AWAY BILL</h3></button> 
                </a> 
            </div>

            <div class="col "><button type="button" class="btn <?php
                if ($_SESSION['colour'] == 'tabal_bill') {
                    echo 'btn-danger';
                } else {
                    echo 'btn-success';
                }
                ?> col-sm-12"  data-toggle="modal" data-target="#waiter"><i class="fas fa-users fa-2x " aria-hidden="true" ></i> <h3 class="text-light ">TABLE BILL</h3> </button></div>
            <div class="col "><button type="button" class="btn <?php
                if ($_SESSION['colour'] == 'deliver') {
                    echo 'btn-danger';
                } else {
                    echo 'btn-success';
                }
                ?> col-sm-12"  data-toggle="modal" data-target="#diliver"><i class="fa fa-bicycle fa-2x " aria-hidden="true" ></i> <h3 class="text-light ">DELIVERY</h3> </button></div>
            <div class="col ">
                <a href="<?php echo base_url('table/pending') ?>"> <button type="button" class="btn <?php
                    if ($_SESSION['colour'] == 'pending') {
                        echo 'btn-danger';
                    } else {
                        echo 'btn-success';
                    }
                    ?> col-sm-12"  ><i class="fa fa-hourglass-half fa-2x " aria-hidden="true" ></i> <h3 class="text-light ">PENDING BILL</h3> </button></a>
            </div>
            <!---
            <?php if (!empty($bill_number)) { ?>
                        <div class="col ">        
                            <button id="print" type="button" class="btn btn-danger col-sm-12" onclick="printContent('print_div');" > <i class="fa fa-print fa-2x" aria-hidden="true"></i><h3 class="text-light">  Print Bill</h3></button> 
                           
                        </div>
            <?php } ?>
            !------>
        </div>



    </div>
</div>

<!-- The Modal -->
<div class="modal" id="tabal_number">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Select Table</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">          
                <div class="row">

                    <?php foreach ($all_table as $table) { ?>           
                        <div class="col-sm-4 mt-2">
                            <a href="<?php echo base_url('table/tabal_bill?table=' . base64_encode(base64_encode($table->table_id)) . ''); ?>" >
                                <button type="button" class="btn btn-success col-sm-12"><h1><?php echo $table->table_no; ?>  </h1></button>
                            </a>
                        </div>              
                    <?php } ?>




                </div>         
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>




<!-- The Modal -->
<div class="modal" id="diliver">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Select Deliver Type</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">          
                <div class="row">

                    <?php
//$_SESSION['reference_number']='';
                    $activ_di = $this->Shop_model->active_dilivr();
                    foreach ($activ_di as $ad) {
                        ?>           
                        <div class="col-sm-4 mt-2">
                            <a href="<?php echo base_url('deliver/refernumber?deliver=' . base64_encode(base64_encode($ad->deliver_id)) . ''); //echo base_url('deliver/deliver?deliver='.base64_encode(base64_encode($ad->deliver_id)).'');   ?>" >                 
                                <img src="<?php echo base_url('service/' . $ad->deliver_image . '') ?>" class="img-thumbnail" alt="Cinque Terre">
                            </a>
                        </div>              
                    <?php } ?>




                </div>         
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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










