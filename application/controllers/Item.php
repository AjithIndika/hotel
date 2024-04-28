<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Item_model');
        $this->load->model('Image_model');         
        $this->load->model('Categories_model'); 
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
    }

    public function item() {


       
            
             $data = array(
                "page_title" => "Items",
                "page_content" => "sys/items",
                "all_categories"=> $this->Item_model->all_Item(),
                "categories"=> $this->Categories_model->active_categories(),
                 );
             $this->load->view('template/template', $data);
        
       
    }
    
 
    
    public function newitem() {
        
        
          $data = array(
                "page_title" => "New Items",
                "page_content" => "sys/newitem",
                "all_categories"=> $this->Categories_model->active_categories(),
                "categories"=> $this->Categories_model->active_categories(),);
     
        
        if($this->input->post('upload')){
            $this->form_validation->set_rules('itemname_name', 'Itemname Name', 'trim|required|xss_clean|is_unique[items.itemname_name]');
            $this->form_validation->set_rules('person', 'Person', 'trim|required|xss_clean');
            $this->form_validation->set_rules('value', 'Rs', 'trim|required|xss_clean');
           $this->form_validation->set_rules('category_id', 'Category', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                  $data = array(
                "page_title" => "New Items",
                "page_content" => "sys/newitem",
                "all_categories"=> $this->Categories_model->active_categories(),
                "categories"=> $this->Categories_model->active_categories(),
                "eroor"=>'<div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Warning ! </strong> Please Check ...</div>');
                
            }
            else{
                
               
        
         //  $newimage = strtolower(str_replace(' ', '_',date('Ymdhis'))). '.' . strtolower(pathinfo($_FILES["userfile"]['name'], PATHINFO_EXTENSION));
        //   $image_details = array('newimage' => $newimage,'path'=>'itemimage/');
           
           $item=array(
               "itemname_name"=> $this->input->post('itemname_name'),
               "person"=> $this->input->post('person'),
               "values"=> $this->input->post('value'),
               "category_id"=>$this->input->post('category_id'),
               "adby"=> $this->session->uname,
               "datetime"=>date('Y-m-d h:i:s a'),
             //  "image"=> $newimage,
               "status"=> "Active",
           );
           $this->Item_model->newItem($item);
          // $this->Image_model->image_up($image_details);
           
             $data = array(
              "page_title" => "New Items",
              "page_content" => "sys/newitem",
              "all_categories"=> $this->Categories_model->active_categories(),
              "categories"=> $this->Categories_model->active_categories(),
               "eroor"=>'<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('itemname_name').' Item Save Success</div>');
           
            }
        }
           
       
             $this->load->view('template/template', $data);
        
    }
   
    
  

      
    // update
    public function update() {
        
    
        
          $itemname_id=  $this->input->post('itemname_id');
        
        //edit
        if($this->input->post('edit')){       
             $status=  $this->input->post('status');            
             $update=array(
                 "itemname_name"=>  $this->input->post('itemname_name'),
                 "category_id"=> $this->input->post('category_id'),
                 "status"=>$status,
                 'values'=> $this->input->post('values'));
             $this->Item_model->update($itemname_id,$update) ;  
             
             $data = array(
              "page_title" => "Items",
              "page_content" => "sys/items",
              "all_categories"=> $this->Item_model->all_Item(),
               "categories"=> $this->Categories_model->active_categories(),
              "error"=>'<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('itemname_name').' Item Update Success ... </div>', );
       }
       
       //image remove 
       
       if($this->input->post('delet')){
            $update=array("image"=>'',);
            
            if(!empty($this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->image)){
             $path_to_file='./itemimage/'. $this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->image;
            unlink($path_to_file);
            }
            
            $this->Item_model->update($itemname_id,$update) ; 
             $data = array(
              "page_title" => "Items",
              "page_content" => "sys/items",
              "all_categories"=> $this->Item_model->all_Item(),
               "categories"=> $this->Categories_model->active_categories(),
              "error"=>'<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('itemname_name').' Item Image remove Success ... </div>', );
        }
       
       // uplodimage
       
       if($this->input->post('uplodimage')){      
         $newimage = strtolower(str_replace(' ', '_',date('Ymdhis'))). '.' . strtolower(pathinfo($_FILES["userfile"]['name'], PATHINFO_EXTENSION));
         $image_details = array('newimage' => $newimage,'path'=>'itemimage/');       
         $update=array("image"=>$newimage,);
         $this->Image_model->image_up($image_details);
         $this->Item_model->update($itemname_id,$update) ; 
         
         $data = array(
              "page_title" => "Items",
              "page_content" => "sys/items",
              "all_categories"=> $this->Item_model->all_Item(),
              "categories"=> $this->Categories_model->active_categories(),
              "error"=>'<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('itemname_name').' Item Image Upload Success ... </div>', );
         }
         
       if($this->input->post('deletItem')){
              if(!empty($this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->image)){
           $path_to_file='./itemimage/'. $this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->image;
            unlink($path_to_file);
            }
           
           $this->Item_model->delet($itemname_id);
            
         $data = array(
              "page_title" => "Items",
              "page_content" => "sys/items",
              "all_categories"=> $this->Item_model->all_Item(),
              "categories"=> $this->Categories_model->active_categories(),
              "error"=>'<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong>  Item Delete Success ... </div>', );
        
       }
       
       
     $this->load->view('template/template', $data);   
    }
    
    

}
