<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Categories_model');      
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
    }

    public function categories() {
            

      
            
             $data = array(
                "page_title" => "Categories",
                "page_content" => "sys/categories",
                "all_categories"=> $this->Categories_model->all_categories(),);
             /// new user 
            if($this->input->post('newcat')){
                
                
                
                 
              $this->form_validation->set_rules('categories_name', 'Categories Name', 'trim|required|xss_clean|is_unique[categories.categories_name]');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                "page_title" => "Categories",
                "page_content" => "sys/categories",
                "error" => '<div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Alert ! </strong> Please check again.</div>',
                "all_categories"=> $this->Categories_model->all_categories(),);
                
            } else{
                
                $category=array(
                    "categories_name"=> $this->input->post('categories_name'),                    
                    "adby"=>$this->session->uname,
                    "states"=>'Active',
                    "date_time"=>date('Y-m-d h:i:s a'),
                );
                
                $this->Categories_model->newcategory($category);
                $data = array(
                "page_title" => "Categories",
                "page_content" => "sys/categories",
                "error" =>  '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('uname').' crate a successful .</div>',
                "all_categories"=> $this->Categories_model->all_categories(),);
            }
                
            }
            
            // update user
            
            if($this->input->post('updatep')){                
                $categories_id=$this->input->post('categories_id');                
                 $category=array(                    
                 "categories_name"=> $this->input->post('categories_name'),
                 "states"=>$this->input->post('states'),
                 "lastUpdate"=>date('Y-m-d h:i:s a'),
                );
                 $this->Categories_model->updatecategory($category,$categories_id);
                 
                 $data = array(
                "page_title" => "Categories",
                "page_content" => "sys/categories",
                "error" =>  '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('uname').' Update successful .</div>',
                "all_categories"=> $this->Categories_model->all_categories(),);
                
            }
      
            
            ///delet
            if($this->input->post('delet')){
                 $categories_id=$this->input->post('categories_id');  
                $this->Categories_model->deletcategory($categories_id);
                
                $data = array(
                "page_title" => "Categories",
                "page_content" => "sys/categories",
                "error" =>  '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> Delete  successful .</div>',
                "all_categories"=> $this->Categories_model->all_categories(),);
            }
           
            $this->load->view('template/template', $data);
            
            
            
            
            
        
    }
    
    
   

}
