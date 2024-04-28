<?php 
  if (empty($this->session->user_type =="Cashier")) {
            redirect(base_url());
 }?>
 





    
    
    <div class="container h-100 pt-5"  id="myprint">
    <div class="row h-100 justify-content-center align-items-center" id="print_div">
     
        <table border="0" >
            <tr>             
                <td  colspan="3" align="center"><h1 class="he"><?php echo $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_name ?></h1></td>
            </tr>
            <tr >
                <td colspan="3" align="left">
                    <p> 
                      <?php echo $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_addres?> </br>
                        Phone   : <?php echo $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_tp ?></br>
                        Date :<?php echo date('Y-m-d')?> Time <?php echo date('h:i:s a') ?> </br>                      
                        Cashier : <?php echo $this->session->uname?> &MediumSpace;&MediumSpace;
                        Rcp For : <?php
                                if($this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->bill_type==1){ echo 'TAKE AWAY BILL';}
                                if($this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->bill_type==2){ echo 'TABLE BILL';}
                                if($this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->bill_type==3){ echo 'DELIVER BILL';}?></br>
                        Payment Method : <?php 
                        if(!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->payment_method_id)){
                        $payment_method_id= $this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->payment_method_id;
                        echo $this->db->select('*')->get_where('payment_method', array('payment_method_id' =>$payment_method_id))->row()->payment_name;
                        }?></br>
                        <?php 
/*
if(!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->waiter))
                        $waiter_name=$this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->waiter;
                                echo 'Waiter :  '.$this->db->select('*')->get_where('waiter', array('waiter_no' =>$waiter_name))->row()->waiter_name;
     */                     
 ?>
                        
                         <?php if(!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->refernumber))
                                 if(!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->deliver_service)){
                                      $deliver_service =  $this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->deliver_service;
                         echo 'RFN :  '.$this->db->select('*')->get_where('deliver_service', array('deliver_id' =>$deliver_service))->row()->deliver_service_name.'-'.$this->db->select('*')->get_where('sum_bill', array('bill_number' =>$bill_number))->row()->refernumber;
                                 }
                          ?>
                        </br>
                        Rcp No :<h1> <?php echo $bill_number;?></h1></br>
                    </p></td>
            </tr>

            <tr>
                <td  style="width:10%">PRICE</td>
                <td  style="width:70%" align="center">Qty</td>
                <td>Item Total</td>
               
            </tr>
             <tr>
                 <td   colspan="3"><hr></hr></td>
               
               
            </tr>
            

            <?php
            $total = '';
            
            $temp = $this->Takeaway_model->printbill($bill_number);
            foreach ($temp as $temp) {
              
                ?>
                <tr class="border-bottom">
                    <td ></td>
                    <td><?php echo $temp->itemname_name?>  <?php echo $temp->quantity ?> </td>
                    <td></td>
                </tr>
            <?php } ?>
                
                
               
                
                <tr >
                    <td ></td>
                    <td align="right"></td>
                    <td class="boder"></td>
                </tr>
               
                   <tr>
                    <td ></td>
                    <td class="boder">Items :- <?php echo $this->db->where(['bill_number'=>$bill_number])->from("bil_table")->count_all_results();?></td>
                    <td></td>
                </tr>
                
                   
                <tr class="boder">
                      <td colspan="4" align="center">THANK YOU FOR COMING</td>
                    
                </tr>
                <tr class="boder">
                      <td colspan="4" align="center"></td>
                    
                </tr>



        </table>

    </div>

 <!--   <button id="print"  class="btn btn-success col-sm-10 pt-5" onclick="printContent('print_div');"  >Print</button> !---->
</div>





