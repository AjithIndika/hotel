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

        <a href="<?php echo base_url('deliver/deliver?deliver='.base64_encode(base64_encode($_SESSION['deliver'])).'')?>"> 
            <button type="button" class="btn btn-success "> <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i> <h3 class="text-light" style="font-size:70px"></h3></button>  
        </a>
    </div>
</div>

<?php if(!empty($eroor)){ echo $eroor;}?>
<div class="container col-sm-12 mt-3">

    <div class="row justify-content-center align-items-center col-sm-12">
        
        <?php foreach ($itemlist as $it) { ?>
            
        

        <div class="col-sm-6 mb-2">
       <a href="<?php echo base_url('deliver/aditems?name='.$it->itemname_id.'')?>"  > 
            <div class="media border p-2 border-success bg-light col-sm-12">
        <div class="media-body">
                       <?php echo $it->itemname_name ?>   / <?php echo $it->values ?>
          </div>
 </div>
  </a>
        </div>
        
        <?php   }?>
        


    </div>

    <!--   
   <div class="container mt-3">
     
     <div class="media border p-3 border-success bg-light">
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
   
   
  
