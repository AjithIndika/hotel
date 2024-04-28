<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>
<div class="container " style="margin-top: 150px">

    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#newUser"><i class="fa fa-user-circle col-sm-2"></i> New User</button>
    <?php if(!empty($error)){echo $error;}?>
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th>User Name</th>
                <th>Status</th>
                <th>User Position</th>
                <th></th>               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userlist as $userlist) { ?>
                <tr>
                    <td><?php echo $userlist->uname ?></td>
                    <td><?php echo $userlist->states ?></td>
                    <td><?php echo $userlist->user_type ?></td>
                    <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update_user<?php echo $userlist->user_id ?>"><li class="fa fa-edit"></li>  Edit</button>
                         <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update_password<?php echo $userlist->user_id ?>"><li class="fa fa-key"></li> </button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#userDelet<?php echo $userlist->user_id ?>">  <li class="fa fa-trash"></li>  Delete</button> 
                    </td>

                </tr>
                
                
                
                <!-- Update User -->
<div class="modal" id="update_user<?php echo $userlist->user_id ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update  User <?php echo $userlist->uname ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">User Name:</label>
                        <input type="text" class="form-control" id="email" name="uname" readonly value="<?php echo $userlist->uname ?>">
                        <input type="hidden" class="form-control" id="email" name="user_id"  readonly value="<?php echo $userlist->user_id ?>">
                    </div>                    

                    <div class="form-group">
                        <label for="pwd">User Position:</label>
                        <select class="form-control" name="user_type" required>                           
                            <option><?php echo $userlist->user_type ?></option>
                            <option>Cashier</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    
                      <div class="form-group">
                        <label for="pwd">Status:</label>
                        <select class="form-control" name="states" required>                           
                            <option><?php echo $userlist->states ?></option>
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
        
        
        
        <!-- Update password  -->
            <div class="modal" id="update_password<?php echo $userlist->user_id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Update  User <?php echo $userlist->uname ?> Password</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Password:</label>
                        <input type="text" class="form-control" id="email" name="upassword" required placeholder="Enter New password">
                        <input type="hidden" class="form-control" id="email" name="user_id"  readonly value="<?php echo $userlist->user_id ?>">
                    </div>                    
                    <input type="submit" class="btn btn-primary" value="Update" name="resetpass"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!--- end password reset ----!---->

   <!-- userdelet  -->
            <div class="modal" id="userDelet<?php echo $userlist->user_id ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Do you want to delete this <?php echo $userlist->uname ?> ?</h4>
                            
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="" method="post">
                    <div class="form-group">
                        <label for="email"></label>                       
                        <input type="hidden" class="form-control" id="email" name="user_id"  readonly value="<?php echo $userlist->user_id ?>">
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

                <th>User Name</th>
                <th>Status</th>
                <th>User Position</th>
                <th></th> 

            </tr>
        </tfoot>
    </table>
</div>

<!-- New User -->
<div class="modal" id="newUser">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New User</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">User Name:</label>
                        <input type="text" class="form-control" placeholder="User Name" id="email" name="uname" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="upassword" required>
                    </div>

                    <div class="form-group">
                        <label for="pwd">User Position:</label>
                        <select class="form-control" name="user_type" required>
                            <option>Cashier</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Save" name="newuser"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>