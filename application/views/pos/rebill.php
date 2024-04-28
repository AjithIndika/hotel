    <?php 
  if (empty($this->session->user_type =="Admin")) {
            redirect(base_url());
 }?>
<div class="container " style="margin-top: 150px">
   
    <?php if(!empty($error)){echo $error;}?>
    
    <table id="example" class="ui celled table bg-light" style="width:100%;" >
        <thead>
            <tr>
                <th></th>
                <th>Bill Number</th>
                <th>Total</th>
                <th></th>
                <th></th>               
            </tr>
        </thead>
        <tbody>
         <?php 
         $todaybils=$this->Shop_model->todaybill();
         foreach ($todaybils as $todaybils) { ?>
                   <tr>
                    <td></td>
                    <td><?php echo $todaybils->	bill_number?></td>
                    <td><?php echo $todaybils->total_bill?></td>
                    <td><?php echo $todaybils->bill_date?></td>
                    <td> <a href="<?php echo base_url('takeaway/bill?bill='. base64_encode(base64_encode($todaybils->bill_number)).'')?>"><i class="fa fa-print" aria-hidden="true"> RE PRINT</i></a></td>
                    
                       </tr>
<?php  }   ?>
  </tbody>
  </table>
</div>

