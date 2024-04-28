<?php
if (empty($this->session->user_type == "Cashier")) {
    redirect(base_url());
}
?>


<div class="container col-sm-12"> 

    <div class="row  col-sm-12">  

        <div class="col-sm-6  mt-5"  >
            <!---- biling !-------->

            <div class="col-sm-12  align-items-start bg-light">
                <div class="mb-3 "><h3>Takeaway Bill</h3></div>
                <table style="width: 100%">
                    <tr>
                        <td>Price</td>
                        <td>Quntity</td>
                        <td>Total</td>
                        <td></td>
                    </tr>

                    <?php
                    $as = $this->Takeaway_model->takeaway_temp();
                    $total_bill = array();
                    foreach ($as as $ff) {
                        $total_bill[] = $ff->total;
                        ?>

                        <tr>
                            <td><?php echo number_format($this->db->select('*')->get_where('temp_bill', array('temp_id' => $ff->temp_id))->row()->value, 2) ?></td>
                            <td><?php echo $ff->itemname_name ?> &MediumSpace; <?php echo $ff->quantity ?></td>
                            <td><?php echo number_format($ff->total, 2) ?></td>
                            <td><button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#update<?php echo $ff->temp_id ?>">Update</button>
                                <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#delet<?php echo $ff->temp_id ?>">Delete</button></td>
                        </tr>




                        <!-- delet -->
                        <div class="modal" id="delet<?php echo $ff->temp_id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete <?php echo $ff->itemname_name ?> ?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="hidden" value="<?php echo $ff->temp_id ?>" name="temp_id">
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
                        <div class="modal" id="update<?php echo $ff->temp_id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Update <?php echo $ff->itemname_name ?> ?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form action="" method="post">
                                            <input type="number" value="<?php echo $this->db->select('*')->get_where('temp_bill', array('temp_id' => $ff->temp_id))->row()->value; ?>" name="total" class="form-control" autofocus="true"></br>
                                            <input type="hidden" value="<?php echo $ff->temp_id ?>" name="temp_id">
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
<?php } ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td><?php echo number_format(array_sum($total_bill), 2) ?></td>
                        <td></td>
                    </tr>    

                </table>
                <div >       
<?php if (!empty($total_bill)) { ?>
                        <button type="button" class="btn btn-success col-sm-4" data-toggle="modal" data-target="#payment">Print</button>
                        <a href="<?php echo base_url('takeaway/deletBill'); ?>"> <button type="button" class="btn btn-success col-sm-4" >Delete</button></a>
<?php } ?>
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
                                    $all_payment = $this->Shop_model->all_payment();
                                    foreach ($all_payment as $all_payment) {
                                        ?>
                                        <div class="col-sm-6">
                                            <form action="<?php echo base_url('takeaway/prosess?pay=' . $all_payment->payment_method_id . '') ?>" method="post">
                                                <button type="submit" class="btn btn-success col-sm-12 mb-2"><h2><?php echo $all_payment->payment_name ?></h2></button>
                                            </form>
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



            </div>


            <!----- end of biling !--------->


        </div>


        <div class="col-sm-6 mt-4">
            <div class="row mt-3" >
                <div class="col-sm-6  "style="margin-top:-20px" > 
                    <a href="<?php echo base_url('takeaway/other'); ?>" class="col-sm-12">
                        <button type="button" class="btn btn-secondary col-sm-12"> <h3 class="text-light" >Other Items</h3></button>  
                    </a>

                </div>                  

                <div class="col-sm-6  "style="margin-top:-20px" > 
                    <a href="<?php echo base_url('takeaway/grosory'); ?>" class="col-sm-12">
                        <button type="button" class="btn btn-secondary col-sm-12"> <h3 class="text-light" >Grossory</h3></button>  
                    </a>
                </div>

<?php foreach ($all_categories as $cat) { ?>
    <?php if ($cat->categories_name == 'Others' OR $cat->categories_name == 'Grocery Items') {
        
    } else { ?>
                        <div class="col-sm-6 "style="margin-top:-20px" > 
                            <a href="<?php echo base_url('shpitem?cat=' . $cat->categories_id . ''); ?>" class="col-sm-12">
                                <button type="button" class="btn btn-success col-sm-12"> <h4 class="text-light" ><?php echo $cat->categories_name ?></h4></button>  
                            </a>
                        </div>
    <?php }
} ?> 

                <div class="col-sm-6  "style="margin-top:-20px" > 
                    <a href="<?php echo base_url('supplier/suplist'); ?>" class="col-sm-12">
                        <button type="button" class="btn btn-secondary col-sm-12"> <h3 class="text-light" >Supplier's Account</h3></button>  
                    </a>
                </div>

            </div>   
        </div>


        <!--
       
        !---->
    </div>

</div>




