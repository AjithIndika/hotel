
<?php
if (empty($this->session->user_type == "Admin")) {
    redirect(base_url());
}
?>

<div class="container " style="margin-top:0px">   
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#my"><i class="fa fa-table"></i> Ad Waiter</button>
    <?php
    if (!empty($error)) {
        echo $error;
    }
    ?>
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th>Table Name</th>
                <th>Waiter</th>
                <th></th>              
            </tr>
        </thead>
        <tbody>
            <?php
            $all_table = $this->Shop_model->waiters_all();
            foreach ($all_table as $altb) {
                ?>
                <tr>
                    <td><?php echo $altb->waiter_no ?></td>
                    <td><?php echo $altb->waiter_name ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $altb->waiter_id ?>" name="waiter_id">
                            <input type="submit" class="btn btn-success" value="Delet" name="delet">
                        </form>
                    </td> 
                </tr>





<?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Table Name</th>
                <th>Waiter</th>
                <th></th>    
            </tr>
        </tfoot>
    </table>
</div>

<!-- New User -->
<div  class="modal" id="my">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ad Waiter</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">

                    <div class="form-group">
                        <div class="form-group">
                            <label for="email">New Waiter No:</label>
                            <input type="text" class="form-control" placeholder="New Waiter No" id="email" name="waiter_no" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="email">New Waiter:</label>
                        <input type="text" class="form-control" placeholder="New Waiter" id="email" name="waiter_name" required>
                    </div>



                    <input type="submit" class="btn btn-primary" value="Save" name="waiter"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

