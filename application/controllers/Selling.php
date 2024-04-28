<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Selling extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Table_model');
          $this->load->model('Shop_model');
        
        
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
    }
    
    
    public function selling() {
        
       
 $last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
$_SESSION['colour']= $record_num;

        $data = array(
                "page_title" => "Selling Dash Bord",
                "page_content" => "pos/dashbord",
                "all_table" => $this->Table_model->all_table(),
            );
        $this->load->view('template/template', $data);
    }
    
    
    
    
    public function delet_bill() {
        
        if($this->input->post('delet')){
          $bill_number=  $this->input->post('bill_number');
          
          $bilup=array(
            "bill_delete"=>1,
            "delet_by"=>$this->session->user_id,
         );
        
        $pa=array(
            "bill_delete"=>1,
            "delet_by"=>$this->session->user_id,
        );
        $this->Table_model-> bil_table($bill_number,$pa);
        $this->Table_model->update_sum($bill_number,$bilup);
        }
        
         $data = array(
                "page_title" => "Delet Bill",
                "page_content" => "pos/delet_bill",
                 "all_table" => $this->Shop_model->all_bill(),
            );
        $this->load->view('template/template', $data);
        
    }

    
}
