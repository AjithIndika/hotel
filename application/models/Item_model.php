<?php

class Item_model extends CI_Model {

        function __construct() {
        parent::__construct();
  }
  

    
    public function all_Item() {
         $this->db->from('items itm');  
         $this->db->join('categories ca', 'ca.categories_id = itm.category_id', 'LEFT');         
         $query = $this->db->get();
         return $query->result(); 
        }
    

    public function newItem($item) {
       $this->db->insert('items',$item);
       }
       
       public function updateItem( $category,$categories_id) {
        $this->db->where('categories_id',$categories_id);
        $this->db->update('categories',  $category);  
           
       }
       
       public function delet($itemname_id) {
       $this->db->where('itemname_id',$itemname_id);
       $this->db->delete('items');       
           
       }
    
       
       // uplode image
       public function update($itemname_id,$update) {
       $this->db->where('itemname_id',$itemname_id);
       $this->db->update('items',$update); 
      // redirect(base_url('item/item'));   
     
       }

}
