<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>

<div class="container " style="margin-top: 150px">
    


    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#new_category"><i class="fa fa-credit-card col-sm-2"></i> &MediumSpace;Payment Method</button>
    <?php if(!empty($eroor)){echo $eroor;}?>
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th>Payment Method</th>
                <th></th>
                <th></th>
                <th></th>               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_payment as $cate) { ?>
                <tr>
                    <td><?php echo $cate->payment_name ?></td>
                    <td><?php echo $cate->states ?></td>
                    <td><?php //echo $cate->user_type ?></td>
                    <td>                       
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#catDelet<?php echo $cate->payment_method_id ?>">  <li class="fa fa-trash"></li>  Delete</button> 
                    </td>

                </tr>
                
                

   <!-- userdelet  -->
            <div class="modal" id="catDelet<?php echo $cate->payment_method_id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Do you want to delete this <?php echo $cate->payment_name ?> ?</h4>
                            
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="" method="post">
                    <div class="form-group">
                        <label for="email"></label>                         
                        <input type="hidden" class="form-control" id="email" name="payment_method_id"  readonly value="<?php echo $cate->payment_method_id ?>">
                       </div>                    
                    <input type="submit" class="btn btn-primary" value="Yes Delete" name="delet"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
         <!--- user delet ----!---->
        
        
        
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>

                <th>Payment Method</th>
                <th></th>
                <th></th>
                <th></th>   

            </tr>
        </tfoot>
    </table>
</div>

<!-- New User -->
<div class="modal" id="new_category">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Payment Method</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo base_url('shop/payment')?>" method="post">
                    <div class="form-group">
                        <label for="email">Payment Method:</label>
                        <input type="text" class="form-control" placeholder="Payment Method" id="email" name="payment_name" required>
                    </div>
                 
                    <input type="submit" class="btn btn-primary" value="Save" name="newpayment"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
