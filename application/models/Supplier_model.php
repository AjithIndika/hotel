<?php

class Supplier_model extends CI_Model {

        function __construct() {
        parent::__construct();
  }
  


  public function new_supplier($suppier) {
          $this->db->insert('supplier',$suppier);
          }
     
          public function all_supplier() {
         $this->db->from('supplier');           
         $query = $this->db->get();
         return $query->result(); 
              
          }  
          
          
        public function  newbill($supplier){
             $this->db->insert('supplier_acc',$supplier);
        }
             
        
         public function all_bill() {
         $this->db->from('supplier_acc as su');         
         $this->db->join('supplier de', 'de.supplier_id = su.supplier_id', 'LEFT');
         $this->db->where('su.bill_balance >',0);
         $query = $this->db->get();
         return $query->result(); 
         }
         
         
         
         
         public function one_bill($bill_no) {
         $this->db->where('supplier_bill_no',$bill_no);
         $this->db->from('supplier_acc');           
         $query = $this->db->get();
         return $query->result(); 
         }
      
         
          public function pay_bill($bill_no) {
         $this->db->from('supplier_payment  as suppli');
         $this->db->where('suppli.supplier_bill_no',$bill_no);               
         $this->db->join('supplier_acc acc', 'acc.supplier_bill_no = suppli.supplier_bill_no', 'LEFT');
         $query = $this->db->get();
         return $query->result(); 
         }
         
         
          public function  newpay($bill){
             $this->db->insert('supplier_payment',$bill);
        }
}
