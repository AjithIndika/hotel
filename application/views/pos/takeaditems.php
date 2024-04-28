<div class="container mt-2"> 
    
       <a href="<?php echo base_url('shpitem?cat='.$_SESSION['cat'].'')?>"> 
            <button type="button" class="btn btn-success "> <i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> <h3 class="text-light" style="font-size:70px"></h3></button>  
        </a>
    
<form action="<?php echo base_url('takeaway/add')?>" method="post" >
    <input type="hidden" value="<?php echo $this->input->get('name')?>" name="itemname_id" >
                <input type="text" id="qunt" name="itemqun" class="form-control col-sm-5 mt-2" placeholder="Enter Quntity" readonly required style="height: 80px;font-size: 40px">
           
                
                
                </br>
                <button type="button"   onclick="one()" class="btn btn-primary col-sm-3 mb-2"><h2>1</h2></button>
                 <button type="button"   onclick="two()" class="btn btn-primary col-sm-3 mb-2"><h2>2</h2></button>
                 <button type="button"   onclick="tre()" class="btn btn-primary col-sm-3 mb-2"><h2>3</h2></button>
                 </br>
                 <button type="button"   onclick="fors()" class="btn btn-primary col-sm-3 mb-2"><h2>4</h2></button>
                 <button type="button"   onclick="five()" class="btn btn-primary col-sm-3 mb-2"><h2>5</h2></button>
                 <button type="button"   onclick="six()" class="btn btn-primary col-sm-3 mb-2"><h2>6</h2></button>
                 </br>
                  <button type="button"   onclick="sevan()" class="btn btn-primary col-sm-3 mb-2"><h2>7</h2></button>
                 <button type="button"   onclick="eigt()" class="btn btn-primary col-sm-3 mb-2"><h2>8</h2></button>
                  <button type="button"   onclick="nin()" class="btn btn-primary col-sm-3 mb-2"><h2>9</h2></button>
                 </br>
                  <button type="button"   onclick="sero()" class="btn btn-primary col-sm-3 mb-2"><h2>0</h2></button>
                   <button type="button"   onclick="clearq()" class="btn btn-primary col-sm-3 mb-2"><h2>Clear</h2></button>
                  <input type="submit" value="OK" name="" class=" col-sm-3 btn btn-danger font-weight-bold" style="height:80px;font-size:30px">
        </form>
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
   