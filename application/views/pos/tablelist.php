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

        <a href="<?php echo base_url('table/tabal_bill')?>"> 
            <button type="button" class="btn btn-success "> <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i> <h3 class="text-light" style="font-size:70px"></h3></button>  
        </a>
    </div>
</div>

<?php if(!empty($eroor)){ echo $eroor;}?>
<div class="container col-sm-12 mt-3">

    <div class="row justify-content-center align-items-center col-sm-12">
        
        <?php foreach ($itemlist as $it) { ?>
 <div class="col-sm-6 mb-2">
          
       <a href="<?php echo base_url('table/aditems?name='.$it->itemname_id.'');?>"  >    
     <div class="media border p-2 border-success bg-light col-sm-12">
          
       <div class="media-body">
                  <?php echo $it->itemname_name ?>   / <?php echo $it->values ?>
         </div>
      
        </div>
             </a>
       </div> 
        <?php   }?>
  
  
    </div>
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
   
   
  
