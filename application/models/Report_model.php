<?php

class Report_model extends CI_Model {

        function __construct() {
        parent::__construct();
      
  }
  
  
  // tatal sellin
  
       public function today_selling() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d')); 
         $this->db->where('print_bill',0);
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        
        //delet bill
        
         public function today_delet_selling() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',1);             
         $this->db->like('bill_date',date('Y-m-d'));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        
        //incme
        
           public function in_cashier() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d'));
         $this->db->where('print_bill',0);
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        // tday cash
          
         public function today_cash($payment_method_id) {
        $this->db->where('payment_method_id',$payment_method_id);
         $this->db->where('bill_delete',0); 
         $this->db->where('print_bill',0);
         $this->db->like('bill_date',date('Y-m-d'));
        // $this->db->where('cashier',$cashier);
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        
        
             // tday cash cashier
          
         public function today_cash_cashier($payment_method_id,$cashier) {
        $this->db->where('payment_method_id',$payment_method_id);
         $this->db->where('bill_delete',0);   
         $this->db->where('print_bill',0);
         $this->db->like('bill_date',date('Y-m-d'));
        $this->db->where('cashier',$cashier);
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
       
        
        // t0p 5i
           public function topfive() {     
          $day=date('Y-m-d');
          $this->db->like('temp_date',$day);
          $this->db->select('itemname_id','total');
          $this->db->select_sum('bil_table.quantity');
          $this->db->group_by("bil_table.itemname_id");
          $this->db->from('bil_table');
          $this->db->order_by("SUM(bil_table.quantity) DESC");
         // $this->db->join('items', 'bil_table.itemname_id = items.itemname_id','LEFT');
          $this->db->limit('5');
          $query = $this->db->get();
          $dates= $query->result();
          foreach ($dates as $dates) {
              echo $this->db->select('*')->get_where('items', array('itemname_id' => $dates->itemname_id))->row()->itemname_name.'- '.$dates->quantity.'</br><hr></hr>';//$dates->itemname_id.'</br>';
          }
                   } 
  
  public function selling_report($first_date,$second_date) {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',0);             
         $this->db->where('bill_date >=', $first_date);
         $this->db->where('bill_date <=', $second_date);
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
        
        public function delet_report($first_date,$second_date) {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',1);             
         $this->db->where('bill_date >=', $first_date);
         $this->db->where('bill_date <=', $second_date);
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
        
    
         
        
         public function cashiar_today_cash($payment_method_id,$cashier) {
         $this->db->where('payment_method_id',$payment_method_id);
         $this->db->where('cashier',$cashier);
         $this->db->where('bill_delete',0);   
         $this->db->where('print_bill',0);
         $this->db->like('bill_date',date('Y-m-d'));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
       
        
        
         public function totay_Cashier() {
         $this->db->from('sum_bill as sum');
         $this->db->like('bill_date',date('Y-m-d'));
         $this->db->where('print_bill',0);
         $this->db->group_by('cashier');
         $this->db->join('users as use', 'use.user_id = sum.cashier', 'LEFT');          
         $query = $this->db->get();
         return $query->result(); 
        }
        
        
        
          public function cashier_wice( $cashier) {
         $this->db->like('bill_date',date('Y-m-d'));
         $this->db->select_sum('total_bill');
         $this->db->where('bill_delete',0);
         $this->db->where('print_bill',0);
          $this->db->where('cashier',$cashier);
        // $this->db->group_by('cashier');
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $cas= $query->result(); 
         foreach ($cas as $cas) {
             echo number_format($cas->total_bill,2);
             }
           }
           
           
       
         
      
        
       
        
       
     
/* last day */
        
        
         public function lastday_selling() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',0);  
         
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }

        
        
  public function lastday_delet_selling() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',1);             
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        
        
         public function lastday_Cashier() {
        
        // $this->db->select_sum('total_bill');
        
         $this->db->from('sum_bill as sum');
          $this->db->group_by('cashier');
           $this->db->like('sum.bill_date',date('Y-m-d',strtotime("-1 days")));
          $this->db->join('users as use', 'use.user_id = sum.cashier', 'LEFT');
         $query = $this->db->get();
         return $query->result(); 
        }
        
        
        
          public function lastday_cashier_wice( $cashier) {
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));
         $this->db->select_sum('total_bill');
         $this->db->where('bill_delete',0);
          $this->db->where('cashier',$cashier);
        // $this->db->group_by('cashier');
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $cas= $query->result(); 
         foreach ($cas as $cas) {
             echo number_format($cas->total_bill,2);
             }
           }
           
         
       
         public function lastday_in_cashier() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        public function lastday_in_cashie() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        
         public function lastday_cash($payment_method_id) {
        $this->db->where('payment_method_id',$payment_method_id);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        
        
         public function cashiar_lastday_cash($payment_method_idls,$cashierls) {
         $this->db->where('payment_method_id',$payment_method_idls);
         $this->db->where('cashier',$cashierls);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
     

        ///waiter 
        
          public function lastday_waiter() {
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));
        // $this->db->select_sum('total_bill');
         $this->db->group_by('waiter');
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
        
          public function lastday_waiter_wice( $waiter) {
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));
         $this->db->select_sum('total_bill');
         $this->db->where('bill_delete',0);
          $this->db->where('waiter',$waiter);
        // $this->db->group_by('cashier');
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $cas= $query->result(); 
         foreach ($cas as $cas) {
             echo number_format($cas->total_bill,2);
             }
           }
        
           
           public function waiter_lastday_cash($payment_method_id,$waiter) {
         $this->db->where('payment_method_id',$payment_method_id);
         $this->db->where('waiter',$waiter);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
     
        
        
        
        // last day deliver
        
         
         public function lastday_diliver() {
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));
        // $this->db->select_sum('total_bill');
         $this->db->group_by('deliver_service');
         $this->db->from('sum_bill su');
         $this->db->join('deliver_service de', 'de.deliver_id = su.deliver_service', 'LEFT');
         $query = $this->db->get();
         return $query->result(); 
        }
        
        
         public function lastday_deliver_wis($servi) {
         $this->db->where('deliver_service',$servi);
        // $this->db->where('waiter',$waiter);
         $this->db->where('bill_delete',0);             
         $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->total_bill;             
         }
         echo number_format(array_sum($total),2);
        }
        
        
        
        public function cra() {
            
        $this->db->like('bill_date',date('Y-m-d',strtotime("-1 days")));        
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         $bill= $query->result(); 
         
         foreach ($bill as $bill) {
             $bill_number=$bill->bill_number;  
             
             $this->Report_model->duc($bill_number);
         }
        
         redirect(base_url('dash'));
        }
       
        
         public function duc($bill_number) {          
       $this->db->where('bill_number',$bill_number);
       $this->db->delete('sum_bill');
       
        $this->db->where('bill_number',$bill_number);
       $this->db->delete('bil_table');
       
       
             
         }
            
      
     
    //cashia wice bill pay
         
    public function cashi_wice_bill_pay($cashier,$da) { 
         $this->db->where('bill_by',$cashier);             
         $this->db->like('bill_date',$da);        
         $this->db->from('supplier_payment');           
         $query = $this->db->get();
         $bill= $query->result(); 
         $total[]='';
         foreach ($bill as $bill) {
             $total[]=$bill->pay;             
         }
         echo number_format(array_sum($total),2);
    }
   
         
    public function report_bill_pay($cashier,$da) { 
        $this->db->from('supplier_payment sp');        
        $this->db->join('supplier de', 'de.supplier_id = sp.	supplier_id', 'LEFT');
        $this->db->where('sp.bill_by',$cashier);             
        $this->db->like('sp.bill_date',$da);     
        $query = $this->db->get();
        return $query->result(); 
        
    }    
}
