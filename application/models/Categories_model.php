<?php

class Categories_model extends CI_Model {

        function __construct() {
        parent::__construct();
  }
  

    
    public function all_categories() {
         $this->db->order_by('oder', 'asc');
         $this->db->from('categories');           
         $query = $this->db->get();
         return $query->result(); 
        }
        
        public function active_categories() {
         $this->db->where('states','Active');
         $this->db->order_by('oder', 'asc'); 
         $this->db->from('categories');           
         $query = $this->db->get();
         return $query->result(); 
        }    
    

    public function newcategory($category) {
       $this->db->insert('categories',$category);
       }
       
       public function updatecategory( $category,$categories_id) {
        $this->db->where('categories_id',$categories_id);
        $this->db->update('categories',  $category);  
           
       }
       
       public function deletcategory($categories_id) {
       $this->db->where('categories_id',$categories_id);
       $this->db->delete('categories');       
           
       }
    

}
