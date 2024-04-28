<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>

<div class="container " style="margin-top: 150px">
    


     <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#new_supplier"><i class="fa fa-user-circle col-sm-2"></i> New Supplier</button>
    <?php if(!empty($error)){echo $error;}?>
    
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>T/P</th>
                <th></th>
                <th></th>               
            </tr>
        </thead>
        <tbody>
            <?php 
$supplier=$this->Supplier_model->all_supplier();
foreach ($supplier as $supplier) { ?>
                <tr>
                    <td>
                     
                    </td>
                    <td><?php  echo $supplier->supplier_name ?></td>
                    <td><?php  echo $supplier->	supplier_items ?></td>
                    <td><?php  if(!empty($supplier->balance)){echo number_format($supplier->balance,2);} ?></td>
                    <td></td>

                </tr>
   
                
                

        
            <?php } ?>
        </tbody>
     
    </table>
</div>

<!-- New User -->
<div class="modal" id="new_supplier">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Categories</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Supplier Name:</label>
                        <input type="text" class="form-control" placeholder="Supplier Name" id="email" name="supplier_name" required>
                    </div>
                    
                     <div class="form-group">
                        <label for="email">Item:</label>
                        <input type="text" class="form-control" placeholder="Item" id="email" name="supplier_items" required>
                    </div>
                    
                 
                 
                    <input type="submit" class="btn btn-primary" value="Save" name="newsupplier"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
