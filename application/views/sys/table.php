
<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>

<div class="container " style="margin-top: 150px">
    


    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#new_altbgory"><i class="fa fa-table"></i> New Table</button>
    <?php if(!empty($error)){echo $error;}?>
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th>Table Name</th>
                <th>Status</th>
                <th></th>
                <th></th>               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_table as $altb) { ?>
                <tr>
                    <td><?php echo $altb->table_no ?></td>
                    <td><?php echo $altb->states ?></td>
                    <td><?php //echo $altb->user_type ?></td>
                    <td>
                       <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update_cat<?php echo $altb->table_id ?>"><li class="fa fa-edit"></li>  Edit</button> --!------>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#catDelet<?php echo $altb->table_id ?>">  <li class="fa fa-trash"></li>  Delete</button> 
                    </td>

                </tr>
                
                
                
                <!-- Update User -->
<div class="modal" id="update_cat<?php echo $altb->table_id ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update  Category <?php echo $altb->altbgories_name ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Category Name:</label>
                        
                        <input type="text" class="form-control" placeholder="Category Name" id="email" name="altbgories_name" required value="<?php echo $altb->altbgories_name ?>" readonly>
                        <input type="hidden" class="form-control" id="email" name="table_id"  readonly value="<?php echo $altb->table_id ?>">
                    </div>                    
                     <div class="form-group">
                        <label for="pwd">Status:</label>
                        <select class="form-control" name="states" required>                           
                            <option><?php echo $altb->states ?></option>
                            <option>Active</option>
                            <option>Disabled</option>
                        </select>
                    </div>
                    
                    <input type="submit" class="btn btn-primary" value="Update" name="updatep"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
        <!---- end user update ---!---->
        
        
  

   <!-- userdelet  -->
            <div class="modal" id="catDelet<?php echo $altb->table_id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Do you want to delete this <?php echo $altb->table_no ?> ?</h4>
                            
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="" method="post">
                    <div class="form-group">
                        <label for="email"></label>                       
                        <input type="hidden" class="form-control" id="email" name="table_id"  readonly value="<?php echo $altb->table_id ?>">
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

                <th>Table Name</th>
                <th>Status</th>
                <th></th>
                <th></th>   

            </tr>
        </tfoot>
    </table>
</div>

<!-- New User -->
<div class="modal" id="new_altbgory">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Table</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">New Table Name:</label>
                        <input type="text" class="form-control" placeholder="New Table Name" id="email" name="table_no" required>
                    </div>
                 
                    <input type="submit" class="btn btn-primary" value="Save" name="newcat"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
