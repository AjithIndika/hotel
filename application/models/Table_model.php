  <?php

class Table_model extends CI_Model {

        function __construct() {
        parent::__construct();
  }
  
  
  public function new_table($table_no) {
       $this->db->insert('table_no',$table_no);
       }
       

    
    public function all_table() {       
         $this->db->from('table_no');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
        public function active_categories() {
         $this->db->where('states','Active');
         $this->db->from('categories');           
         $query = $this->db->get();
         return $query->result(); 
        }    
        
        
       public function delet($table_id) {
       $this->db->where('table_id',$table_id);
       $this->db->delete('table_no');       
           
       }
        
    
    
       
       public function updatecategory( $category,$categories_id) {
        $this->db->where('categories_id',$categories_id);
        $this->db->update('categories',  $category);  
           
       }
       
       public function deletcategory($categories_id) {
       $this->db->where('categories_id',$categories_id);
       $this->db->delete('categories');       
           
       }
       
       
        public function all_Item_active() {
         $this->db->where('category_id',$_SESSION['cat']);
         $this->db->where('status','Active');
         $this->db->from('items');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
      // temp bill  
        public function temp_bill($temp_bill) {
        $this->db->insert('temp_bill',$temp_bill);
       }
       
       // update bill
       
          
       public function temp_bill_update( $temp_id,$temp_bill) {
        $this->db->where('temp_id',$temp_id);
        $this->db->update('temp_bill',$temp_bill);  
        }
        
          //tackaway temp bill
        public function table_bill_temp() {
           $this->db->where('cashier',$this->session->user_id);
         //  $this->db->where('table_no',$_SESSION['table_no']);
           $this->db->where('temp_date',date('Y-m-d'));
           $this->db->where('bill_type',2);           
           $this->db->from('temp_bill as tb'); 
           $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
           $this->db->join('categories ca', 'ca.categories_id = tb.category_id', 'LEFT');
           $query = $this->db->get();
           return $query->result(); 
        }
        
        
             //takeway temp bill delet
        
       public function temp_delet($temp_id) {
       $this->db->where('temp_id',$temp_id);
       $this->db->delete('temp_bill');    
       }
       
       
        public function bill($tobill) {
            $this->db->insert('bil_table',$tobill);
           
       }
       
        public function sum_bill($sum_bill) {
            $this->db->insert('sum_bill',$sum_bill);           
       }
       
       
       public function pending_bill() {
           $this->db->where('payment_method_id',6);
         //  $this->db->where('payment_method_id','');
          // $this->db->where('cashier',$this->session->user_id);
          // $this->db->like('bill_date',date('Y-m-d'));
           //$this->db->where('bill_type',2);           
           $this->db->from('sum_bill as su');  
           $this->db->join('users use', 'use.user_id = su.cashier', 'LEFT');
            $this->db->join('waiter as wa', 'wa.waiter_no = su.waiter', 'LEFT');
          // $this->db->join('users use', 'use.user_id = su.cashier', 'LEFT');
           $query = $this->db->get();
           return $query->result(); 
           
       }
       
       //payment_ok
       
        public function update_sum($bill_number,$bilup) {
        $this->db->where('bill_number',$bill_number);
        $this->db->update('sum_bill',$bilup);  
        }
        
         public function bil_table($bill_number,$pa) {
        $this->db->where('bill_number',$bill_number);
        $this->db->update('bil_table',$pa);  
        }
    
          // update waiter
        
       public function update_waiter($table_no,$update) {
        $this->db->where('table_id',$table_no);
        $this->db->update('table_no',$update);  
        }
        
        
        public function sumtabal() {
            $this->db->where('cashier',$this->session->user_id);
           $this->db->where('table_no',1);
           $this->db->where('temp_date',date('Y-m-d'));
           $this->db->where('bill_type',2);           
           $this->db->from('temp_bill as tb'); 
           $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
           $this->db->select_sum('total');
           $query = $this->db->get();
           $data= $query->result();
           
           foreach ($data as $data) {
               
          echo   $data->total;
               
           }
            
        }
}

