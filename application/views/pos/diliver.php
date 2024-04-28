<?php
if (empty($this->session->user_type == "Cashier")) {
    redirect(base_url());
}
//$_SESSION['reference_number']='';
//$_SESSION['driver']="";
?>




<div class="col  mt-4"> 
    <?php if (!empty($_SESSION['deliver'])) { ?>
        <button type="button" class="btn btn-success">
            <h2 >Deliver Service <em class="text-danger"><?php echo $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $_SESSION['deliver']))->row()->deliver_service_name; //echo  base64_decode(base64_decode($this->input->get('table')));}  ?></em> </h2>
        </button>  

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Reference_Number">
            <h2 >   <?php if (empty($_SESSION['reference_number'])) {
        echo 'Ad ';
    } ?> Reference Number</h2>
        </button> 
<?php } ?>
<?php if (!empty($_SESSION['reference_number'])) { ?>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Reference_Number">
            <h2 ><?php echo $_SESSION['reference_number'] ?></h2>
        </button>
<!--------
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#diliver_by">
            <h2 >Deliver BY <?php if (!empty($_SESSION['driver'])) {
        echo $this->db->select('*')->get_where('drive', array('drive_id' => $_SESSION['driver']))->row()->drive_name;
    }//if(!empty($this->db->select('*')->get_where('drive', array('drive_id' => $_SESSION['driver']))->row()->drive_name)){ echo $this->db->select('*')->get_where('drive', array('drive_id' => $_SESSION['driver']))->row()->drive_name;} ?></h2>
        </button>
!---------->
<?php } ?>
</div>



<?php if (!empty(!empty($_SESSION['driver']))) { ?>

    <div class="container col-sm-12 mt-4">

        <div class="row col-sm-12">
            <div class="col-sm-6">
                <div class="mb-3 mt-2"><h3>Delivery Bill <em class="text-danger"><?php echo $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $_SESSION['deliver']))->row()->deliver_service_name; ?> / Driver <?php if (!empty($this->db->select('*')->get_where('drive', array('drive_id' => $_SESSION['driver']))->row()->drive_name)) {
        echo $this->db->select('*')->get_where('drive', array('drive_id' => $_SESSION['driver']))->row()->drive_name; /* $_SESSION['driver'] */
    } else {
        echo '<em data-toggle="modal" data-target="#diliver_by"> ?? </em>';
    } ?></em></h3></div>

                <!--- pos start !--------->

                <table style="width: 100%">
                    <tr>
                        <td>Price</td>
                        <td>Quntity</td>
                        <td>Total</td>
                        <td></td>
                    </tr>

                    <?php
                    $as = $this->Delivery_model->delivery_temp();
                    $total_bill = '';
                    $total_bills = array();
                    $total_bil = array();
                    foreach ($as as $ff) {
                        $refernumber = $ff->refernumber;

                        // echo $this->db->select('*')->get_where('deliver_service', array('deliver_id' =>$_SESSION['deliver']))->row()->diliver_cost;
                        //  $_SESSION['deliver'];
                        $total_bills[] = $ff->total ;//- ($ff->total * $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $_SESSION['deliver']))->row()->diliver_cost / 100);
                      //  $total_bil[] = $ff->total - array_sum($total_bills) / 100 * 30;



                        $total_bill = number_format(array_sum($total_bills),2);
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
                                            <input type="number" value="<?php echo number_format($this->db->select('*')->get_where('temp_bill', array('temp_id' => $ff->temp_id))->row()->value, 2) ?>"   name="total" class="form-control"></br>
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
                        <td><?php echo number_format(array_sum($total_bills)+(array_sum($total_bills)*$this->db->select('*')->get_where('deliver_service', array('deliver_id' => $_SESSION['deliver']))->row()->diliver_cost/100),2)  ?></td>
                        <td></td>
                    </tr>    

                </table>

                <?php if (!empty(array_sum($total_bills))) { ?>         
                    <button type="button" class="btn btn-success col-sm-4" data-toggle="modal" data-target="#payment">Add Payment</button>
                    <a href="<?php echo base_url('deliver/deletBill') ?>"><button type="button" class="btn btn-success col-sm-4" >Delete</button></a>

    <?php } ?>    

                <!--- pos End!--------->
            </div>


            <div class="col-sm-6">
                <div class="row col-sm-12 mt-4">  
                    <?php if (!empty($_SESSION['reference_number'])) { ?>
                    <div class="col-sm-6  "style="margin-top:-20px" > 
                        <a href="<?php echo base_url('deliver/other'); ?>" class="col-sm-12">
                            <button type="button" class="btn btn-secondary col-sm-12"> <h3 class="text-light" >Other Items</h3></button>  
                        </a>
                    </div>
    <?php foreach ($all_categories as $cat) { ?>
                    <?php if($cat->categories_name=='Others'){}else{?>
                        <div class="col-sm-6 " style="margin-top:-20px"> 
                            <a href="<?php echo base_url('deliver/diliveritem?cat=' . $cat->categories_id . ''); ?>" class="col-sm-12">
                                <button type="button" class="btn btn-success col-sm-12"> <h4 class="text-light" ><?php echo $cat->categories_name ?></h4></button>  
                            </a>
                        </div>
    <?php } }}?>  

                    
                </div>
            </div>
        </div>
    </div>



            <?php if (!empty($_SESSION['reference_number'] )) { ?>

        <div class="col-sm-6 ">       
            <table style="width: 100%">
                <?php
                $as = $this->Delivery_model->delivery_temp();
                $total_bill = array();
                foreach ($as as $ff) {
                    $refernumber = $ff->refernumber;
                    $total_bill[] = $ff->total;
                }
                ?>

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
            ?> <div class="col-sm-6">
                            <form action="<?php echo base_url('deliver/prosess?pay=' . $all_payment->payment_method_id . '') ?>" method="post">
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
    <?php } ?>

    </div>

<?php } ?> 

<!-- The Modal -->
<div class="modal" id="Reference_Number">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Reference Number</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">


                <div class="form-group">
                    <form action="" method="post">
                        <label for="email">Reference Number:</label>
                        <input type="text" class="form-control" placeholder="Reference Number" id="email" name="reference_number" required>
                        </div> 
                        <input type="submit" class="btn btn-primary" value="Add Reference Number" name="reference">
                    </form>          

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>




    <!--- diliver by !----------->


    <!-- The Modal -->
    <div class="modal" id="diliver_by">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Driver</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row col-sm-12">
<?php
$activ_di = $this->Shop_model->driver_list();
foreach ($activ_di as $ad) {
    ?>   
                            <div class="col-sm-6 mb-2">
                                <a href="<?php echo base_url('deliver/deliver?drive=' . $ad->drive_id . '') ?>">
                                    <button type="button" class="btn btn-success"><h2><?php echo $ad->drive_name ?></h2></button>
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
</div>
</div>
</div>
</div></div>

