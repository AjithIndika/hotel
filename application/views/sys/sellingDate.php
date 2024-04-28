<div class="container">

    <div >
        <form class="form-inline" action="" method="post">
            <label for="email">Email address:  &MediumSpace;</label>
            <input type="date" class="form-control" placeholder="First Date" id="email" name="first_date" value="<?php if(!empty($this->input->post('first_date'))){echo $this->input->post('first_date');}?>">
            <label for="pwd"> &MediumSpace; Password: &MediumSpace;</label>
            <input type="date" class="form-control" placeholder="Second Date" id="pwd" name="second_date"  value="<?php if(!empty($this->input->post('second_date'))){echo $this->input->post('second_date');}?>">
            &MediumSpace;
            <input type="submit" class="btn btn-primary" value="Submit" name="report"> 
        </form>
    </div>




    <!------------ data ------------!------>

    <div class="container mt-5">
        <h2><?php echo $page_title?> Report</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Bill Number</th>
                    <th>Date</th>
                    <th>Bill Type</th>
                    <th>Payment</th>
                    <th>Total</th>
                    
                </tr>
            </thead>
            <tbody>

                <?php
                $totals[]='';
                if (!empty($summery)) {
                    foreach ($summery as $summery) {
                        $totals[]=$summery->total_bill;
                        ?>

                       

                        <tr>

                            <td><?php  echo $summery->bill_number ?></td>
                            <td><?php  echo $summery->bill_date ?></td>
                            <td><?php  
                            if($summery->bill_type==1){ echo 'TAKE AWAY';}
                            if($summery->bill_type==2){ echo 'TABLE';}
                            if($summery->bill_type==3){ echo 'DELIVER';}
                            ?></td>
                            <td><?php  echo $this->db->select('*')->get_where('payment_method', array('payment_method_id' =>$summery->payment_method_id))->row()->payment_name //$summery->payment_method_id ?></td>
                            <td><?php  echo $summery->total_bill ?></td>
                            
                        </tr>
                    <?php
                    }
                }
                ?>
                        
                        <tr>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td><?php  echo array_sum($totals) ?> <hr></hr></td>
                            
                        </tr>
                        
            </tbody>
        </table>
    </div>
</div>