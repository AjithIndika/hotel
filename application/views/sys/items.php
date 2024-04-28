<?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>

<div class="container " style="margin-top: 150px">
    


    <a href="<?php echo base_url('item/newitem')?>"> <button type="button" class="btn btn-success mb-2" ><i class="fa fa-user-circle col-sm-2"></i> New Item</button></a>
    <?php if(!empty($error)){echo $error;}?>
    
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th></th>
                <th>Item Name</th>
                <th>Status</th>
                <th></th>
                <th></th>               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($all_categories as $cate) { ?>
                <tr>
                    <td>
                        <!--
                        <?php if(!empty($cate->image)){?>
                        <img src="<?php echo base_url('itemimage/'.$cate->image)?>" class="img-thumbnail"  width="100px"  data-toggle="modal" data-target="#image<?php echo $cate->itemname_id ?>">  <i class="fas fa-times" data-toggle="modal" data-target="#imageDelet<?php echo $cate->itemname_id ?>"></i>
                        <?php }
                        else{?>
                         <img src="<?php echo base_url('images/icon/uplode.png')?>" class="img-thumbnail"  width="60px"  data-toggle="modal" data-target="#upimage<?php echo $cate->itemname_id ?>"> 
                        <?php }?>
                        !---->
                    </td>
                    <td><?php echo $cate->categories_name.'-'.$cate->itemname_name ?></td>
                    <td><?php echo $cate->status ?></td>
                    <td><?php echo $cate->values ?></td>
                    <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#update_cat<?php echo $cate->itemname_id ?>"><li class="fa fa-edit"></li>  Edit</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delet<?php echo $cate->itemname_id ?>">  <li class="fa fa-trash"></li>  Delete</button> 
                    </td>

                </tr>
               <!------- up image -!---------->
                <!-- The Modal -->
<div class="modal" id="upimage<?php echo $cate->itemname_id ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Upload  image for <?php echo $cate->itemname_name ?> </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="<?php echo base_url('item/update')?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="itemname_id" value="<?php echo $cate->itemname_id ?>">
     
         <div class="form-group">
        <label for="email">Item Image</label>
        <input type="file" class="form-control col-sm-5"  accept="image/*"   name="userfile"  id="imgInp"  > 
          <?php echo form_error('userfile', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
       </div>
       <div class="form-group">
        <img id="blah" src="#" alt="your image" width="350px"  style="display: none" class="rounded"/>
       </div>      

        <script type="text/javascript">
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();    
            reader.onload = function(e) {
                document.getElementById("blah").style.display = "block";
              $('#blah').attr('src', e.target.result);      
            }    
            reader.readAsDataURL(input.files[0]);
          }
        }
        $("#imgInp").change(function() {
          readURL(this);
        });
        </script>



        <input type="submit" class="btn btn-danger" value="Uplode Image" name="uplodimage">
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
               
                
                
                <!------- image delet -!---------->
                <!-- The Modal -->
<div class="modal" id="imageDelet<?php echo $cate->itemname_id ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete <?php echo $cate->itemname_name ?> Image</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form action="<?php echo base_url('item/update')?>" method="post">
              <input type="hidden" name="itemname_id" value="<?php echo $cate->itemname_id ?>">
              <input type="submit" class="btn btn-danger" value="Delet Image" name="delet">
          </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
                
                <!---- image -----!-------->
                <!-- The Modal -->
<div class="modal" id="image<?php echo $cate->itemname_id ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?php echo $cate->itemname_name ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <img src="<?php echo base_url('itemimage/'.$cate->image)?>" class="img-thumbnail"  >
      
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
        
        
        
                
                
                
                <!-- Update User -->
<div class="modal" id="update_cat<?php echo $cate->itemname_id ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update  Item <?php echo $cate->categories_name.'-'.$cate->itemname_name ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo base_url('item/update')?>" method="post">
                    <input type="hidden" name="itemname_id" value="<?php echo $cate->itemname_id ?>">
                    
                    
           <div class="form-group">
            <label for="email">Item Name:</label>
            <input type="text" class="form-control" id="email" name="itemname_name"  value="<?php echo $cate->itemname_name ?>">
        
        </div>
                      
          <div class="form-group">
            <label for="pwd">Category</label>
            <select class="form-control col-sm-6" name="category_id" required>
       
                <?php 
                echo '<option value="'.$cate->category_id.'">'.$this->db->select('*')->get_where('categories', array('categories_id' =>$cate->category_id))->row()->categories_name.'</option>';
             
                foreach ($categories as $categ) {
                    echo '<option value="'.$categ->categories_id.'">'.$categ->categories_name.'</option>';
        
                   }?>
                
            </select>
            
         <?php echo form_error('category_id', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
        </div> 
                    
                    <div class="form-group">
                        <label for="pwd">Status:</label>
                        <select class="form-control" name="status" required>                           
                            <option><?php echo $cate->status ?></option>
                            <option>Active</option>
                            <option>Disabled</option>
                        </select>
                    </div>
                    
                  
                   <div class="form-group">
            <label for="pwd">Rs/</label>
            <input type="number" lang="en"  class="form-control col-sm-4" placeholder="Price" id="pwd" name="values" value="<?php echo $cate->values ?>">
           <!--- <input type="number" lang="en"  class="form-control col-sm-4" placeholder="Price" id="pwd" name="values" value="<?php echo $cate->values ?>">
            <input type="number" lang="en"  class="form-control col-sm-4" placeholder="Price" id="pwd" name="values" value="<?php echo $cate->values ?>">
			!---------->
         <?php echo form_error('value', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
        </div>
                    
                    <input type="submit" class="btn btn-primary" value="Update" name="edit"> 
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
        
    
  <!-- Delete Item  -->
<div class="modal" id="delet<?php echo $cate->itemname_id ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Do you need delete this? <?php echo $cate->itemname_name ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo base_url('item/update')?>" method="post">
                    <input type="hidden" name="itemname_id" value="<?php echo $cate->itemname_id ?>">
                    <input type="submit" class="btn btn-primary" value="Delete Item" name="deletItem"> 
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
        <!---- Delete item ---!---->
        
        
        
        
        



        
        
        
            <?php } ?>
        </tbody>
     
    </table>
</div>

<!-- New User -->
<div class="modal" id="new_Items">
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
                        <label for="email">Category Name:</label>
                        <input type="text" class="form-control" placeholder="Category Name" id="email" name="itemname_id" required>
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
