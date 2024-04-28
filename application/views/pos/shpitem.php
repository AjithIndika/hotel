<?php 
  if (empty($this->session->user_type =="Cashier")) {
            redirect(base_url());
 }?>

<style>
    a{
        text-decoration: none;
    }
     a:hover{
        text-decoration: none;
    }
</style>
<div class="container mb-3">
    <div class="col-sm-6 mt-2">

        <a href="<?php echo base_url('takeaway')?>"> 
            <button type="button" class="btn btn-success "> <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i> <h3 class="text-light" style="font-size:70px"></h3></button>  
        </a>
    </div>
    
     <div >       
        
</div>

<?php if(!empty($eroor)){ echo $eroor;}?>
<div class="container col-sm-12 mt-3">

    <div class="row justify-content-center align-items-center col-sm-12">
        
        <?php foreach ($itemlist as $it) { ?>
            
        

        <div class="col-sm-6 mb-2">
            <a href="<?php echo base_url('takeaway/aditems?name='.$it->itemname_id.'')?>"  >
                <div class="media border p-1 border-success bg-light col-sm-12">
                 <?php echo $it->itemname_name ?>   / <?php echo $it->values ?>
                </div>
             </a>
             </div>
              <!--  </div> ----!---->
              
              <!-- The Modal -->
  <div class="modal fade" id="myModal<?php echo $it->itemname_id?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><?php echo $it->itemname_name ?></h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
           
            <form action="<?php echo base_url('takeaway/add')?>" method="post" class="form-inline">
                <input type="hidden" value="<?php echo $it->itemname_id ?>" name="itemname_id" >
                <input type="text" id="qunt" name="itemqun" class="form-control col-sm-5" placeholder="Enter Quntity" readonly required>
                &MediumSpace; &MediumSpace; <input type="submit" value="OK" name="" class="btn btn-primary btn-lg">
                
                </form>
                </br>
                <button type="button"   onclick="one()" class="btn btn-primary btn-lg mb-2"><h2>1</h2></button>
                 <button type="button"   onclick="two()" class="btn btn-primary btn-lg mb-2"><h2>2</h2></button>
                 <button type="button"   onclick="tre()" class="btn btn-primary btn-lg mb-2"><h2>3</h2></button>
                 </br>
                 <button type="button"   onclick="fors()" class="btn btn-primary btn-lg mb-2"><h2>4</h2></button>
                 <button type="button"   onclick="five()" class="btn btn-primary btn-lg mb-2"><h2>5</h2></button>
                 <button type="button"   onclick="six()" class="btn btn-primary btn-lg mb-2"><h2>6</h2></button>
                 </br>
                  <button type="button"   onclick="sevan()" class="btn btn-primary btn-lg mb-2"><h2>7</h2></button>
                 <button type="button"   onclick="eigt()" class="btn btn-primary btn-lg mb-2"><h2>8</h2></button>
                  <button type="button"   onclick="nin()" class="btn btn-primary btn-lg mb-2"><h2>9</h2></button>
                 </br>
                  <button type="button"   onclick="sero()" class="btn btn-primary btn-lg mb-2"><h2>0</h2></button>
                   <button type="button"   onclick="clearq()" class="btn btn-primary btn-lg mb-2"><h2>Clear</h2></button>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  

            
           
<!---</a> !---->
       
        
        
        
        <?php   }?>
        


    </div>

    <!--   
   <div class="container mt-3">
     
     <div class="media border p-3 border-success bg-light">
    <a href="../../../../../../../Users/RIKAS/Downloads/jQuery.NumPad-master/jQuery.NumPad-master/demos/bootstrap/index.html"></a>
         <img src="<?php echo base_url('itemimage/20200524015738.jpg') ?>" alt="John Doe" class="mr-3 mt-1 img-thumbnail" style="width:250px;">
       <div class="media-body">
         <h4>John Doe <small><i>Posted on February 19, 2016</i></small></h4>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>      
       </div>
     </div>
   </div>
   
    !----->   

</div>

   
   <script>
       
        document.getElementById("qunt").value ="";
        function one() {
            var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+1;
            }
         
       function two() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+2;
         }
         
          function tre() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+3;
         }
         
         function fors() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+4;
         }
         
          function five() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+5;
         }
         
          function six() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+6;
         }
         
          function sevan() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+7;
         }
         
          function eigt() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+8;
         }
         
         function nin() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+9;
         }
         
          function sero() {
             var x = document.getElementById("qunt").value;
             document.getElementById("qunt").value =x+0;
         }
         
         function clearq() {
             
             document.getElementById("qunt").value ="";
         }
         
         
   </script>
   
   
  