<?php

class Shop_model extends CI_Model {

        function __construct() {
        parent::__construct();
  }
  


       public function shop($shop) {
        $this->db->where('id',1);
        $this->db->update('shop_setting',$shop); 
       }
       
    
         public function all_payment() {
         $this->db->from('payment_method');
         $this->db->order_by("oder", "asc");
         $query = $this->db->get();
         return $query->result(); 
        }
       
        
          public function new_payment($payment) {
          $this->db->insert('payment_method',$payment);
          }
     
       
             
       public function delet_payment($payment_method_id) {
       $this->db->where('payment_method_id',$payment_method_id);
       $this->db->delete('payment_method');       
           
       }
       
          public function new_deliver($diliver) {
          $this->db->insert('deliver_service',$diliver);
          }
          
        
       public function all_dilivr() {
         $this->db->from('deliver_service');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
         public function active_dilivr() {
        $this->db->where('status',1);
         $this->db->from('deliver_service');           
         $query = $this->db->get();
         return $query->result(); 
        }
     
        
             
       public function update_deliver($deliver_id,$dilive_up) {
       $this->db->where('deliver_id',$deliver_id);
       $this->db->update('deliver_service',$dilive_up);       
           
       }
       
       
        public function new_drive($drive) {
          $this->db->insert('drive',$drive);
          }
        
      public function driver_list() {       
         $this->db->from('drive');           
         $query = $this->db->get();
         return $query->result(); 
        }

          public function all_bill() {
      //  $this->db->where('cashier',$this->session->user_id);
         $this->db->where('bill_delete',0);             
        // $this->db->where('bill_date >=', $first_date);
         //$this->db->where('bill_date <=', $second_date);
         $this->db->from('sum_bill');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
        
        public function todaybill() {
         $this->db->from('sum_bill');
         $this->db->like('bill_date',date('Y-m-d'));
        // $this->db->where('cashier',$this->session->user_id);
         $query = $this->db->get();
         return $query->result(); 
        }
        
         public function kotprint($kotprint) {
        $this->db->where('id',1);
        $this->db->update('kot',$kotprint); 
       }
        
       
       
       
       public function waiters_all() {
         $this->db->from('waiter');
         $this->db->order_by("waiter_id", "asc");
         $query = $this->db->get();
         return $query->result(); 
        }
       
        
        public function new_waiter($new_waier) {
          $this->db->insert('waiter',$new_waier);
          }
          
       public function  delt_waiter($waiter_id){
       $this->db->where('waiter_id',$waiter_id);
       $this->db->delete('waiter'); 
           
       }
}
