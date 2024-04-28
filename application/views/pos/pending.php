<?php
if (empty($this->session->user_type == "Cashier")) {
    redirect(base_url());
}
?>
<div class="container" style="margin-top: 90px">

<?php if (!empty($eroor)) {
    echo $eroor;
} ?>
    <table class="table">
        <thead>
            <tr>
                <th>Bill Number</th>
                <th>Bill Type</th>
                <th>Bill By</th>
                <th>Date</th>
                <th>Waiter</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pending = $this->table_model->pending_bill();

            foreach ($pending as $pen) {
                ?>
                <tr>
                    <td><?php echo $pen->bill_number ?></td>
                     <td>
                              <?php
                                if($pen->bill_type==1){ echo 'TAKE AWAY BILL';}
                                if($pen->bill_type==2){ echo 'TABLE BILL';}
                                if($pen->bill_type==3){ echo 'DELIVER BILL';}
                                ?>
                         
                         
                      <td><?php echo $pen->uname ?></td>
                       <td><?php echo $pen->bill_date ?></td>
                    <td><?php echo $pen->waiter_name ?></td>
                    <td><?php echo number_format($pen->total_bill, 2) ?></td>

                    <td><button type="button" class="btn btn-secondary"  data-toggle="modal" data-target="#payment<?php echo $pen->id ?>">Pay</button></td>
                </tr>


                <!-- The Modal -->
            <div class="modal" id="payment<?php echo $pen->id ?>">
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
    $pymethord = $this->Shop_model->all_payment();
    foreach ($pymethord as $payment) {
        ?>
                                    <div class="col-sm-6">
                                        <form action="<?php echo base_url('table/pay') ?>" method="post">
                                            <input type="hidden" value="<?php echo $pen->bill_number ?>" name="bill_number">
                                            <input type="hidden" value="<?php echo $payment->payment_method_id ?>" name="pay">
                                            <button type="submit" class="btn btn-success col-sm-12 mb-2"><h2><?php echo $payment->payment_name ?></h2></button>
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





<?php } ?>
        </tbody>
    </table>


</div>
