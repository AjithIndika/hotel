<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Shop_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
        $this->load->model('Report_model');
        $this->load->model('Bill_model');
    }

    public function index() {
        
        if(!empty($this->session->user_id)){
            redirect(base_url());
        }
        $data = array(
            "page_title" => "Home", 
            "page_content" => "login/login",
        );
       
        if ($this->input->post('login')) {
            $this->form_validation->set_rules('uname', 'User Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('upassword', 'Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {

                $data = array(
                    "page_title" => "Home",
                    "page_content" => "login/login",
                    "error" => '<div class="alert alert-danger alert-dismissible mt-2"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Info! </strong> User Name Or Password Wrong Or Empty.!</div>',
                );
            } else {
                $uname = $this->input->post('uname');
                $upassword = $this->input->post('upassword');
                $this->User_model->log($uname, $upassword);
            }
        }

        $this->load->view('template/template', $data);
        
    }

    public function dash() {
         $data = array(
           "page_title" => "Dash Bord",
           "page_content" => "sys/dash",
             );
          $this->load->view('template/template', $data);
    }
    
    public function sellingDate() {
          $data = array(
             "page_title" => "Selling",
             "page_content" => "sys/sellingDate",);
          
        if($this->input->post('report')){
            
            $first_date = $this->input->post('first_date');
            $second_date = $this->input->post('second_date');
                    
             $data = array(
             "page_title" => "Selling",
             "page_content" => "sys/sellingDate",
             "summery"=> $this->Report_model->selling_report($first_date,$second_date),
             );
            
        }
         
          $this->load->view('template/template', $data);
        
    }
    
    
     public function delet_bill_data() {
          $data = array(
             "page_title" => "Delet Bile",
             "page_content" => "sys/sellingDate",);
          
        if($this->input->post('report')){
            
            $first_date = $this->input->post('first_date');
            $second_date = $this->input->post('second_date');
                    
             $data = array(
             "page_title" => "Delet Bile",
             "page_content" => "sys/sellingDate",
             "summery"=> $this->Report_model->delet_report($first_date,$second_date),
             );
            
        }
         
          $this->load->view('template/template', $data);
        
    }
    
    
    public function rebill() {
         $data = array(
             "page_title" => "Rebill Print",
             "page_content" => "pos/rebill",
             );
           $this->load->view('template/template', $data);
        
    }
    
    
    


    public function logout() {
        
       $this->db->where('cashier',$this->session->user_id);
       $this->db->delete('temp_bill');  
        
        session_destroy();
        unset($this->session->user_id);
        unset($this->session->uname);
        unset($this->session->user_type);
        
        unset($_SESSION['driver']);
        unset($_SESSION['reference_number']);
        unset($_SESSION['deliver']);
        unset($_SESSION['waiter']);
        unset($_SESSION['reference_number']);
        
        
        redirect(base_url());
    }
    
    public function noprint() {
        $data = array(
             "page_title" => "No Printt",
             "page_content" => "pos/noprint",
             );
           $this->load->view('template/template', $data);
        
    }
    
    
    
    public function workprint($user_id) {
        
     
      
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('payment_method_id',3);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0); 
         $this->db->like('bill_date',date('Y-m-d'));          
         $query = $this->db->get();
         $cshTotal= $query->result();
          $cashs=array();
         foreach ($cshTotal as $cshTotal) {
             $cashs[]=$cshTotal->total_bill;
         }
        $ricive_Caash= array_sum($cashs);
        
      
        // bank
        $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('payment_method_id',5);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0);
          $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $bankTotal= $query->result();
          $bank=array();
         foreach ($bankTotal as $bankTotal) {
             $bank[]=$bankTotal->total_bill;
         }
        $ricive_bank= array_sum($bank);
        
        // card
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('payment_method_id',4);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $cardTotal= $query->result();
          $card=array();
         foreach ($cardTotal as $cardTotal) {
             $card[]=$cardTotal->total_bill;
         }
        $ricive_card= array_sum($card);
        
        // pending
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('payment_method_id',6);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $pendingTotal= $query->result();
          $pending=array();
         foreach ($pendingTotal as $pendingTotal) {
             $pending[]=$pendingTotal->total_bill;
         }
        $ricive_pending= array_sum($pending);
        
        
      // uber        
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('bill_type',10);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $uberTotal= $query->result();
          $uber=array();
         foreach ($uberTotal as $uberTotal) {
             $uber[]=$uberTotal->total_bill;
         }
        $ricive_uber= array_sum($uber);
        
        // pick me       
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('bill_type',9);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $pickmeTotal= $query->result();
          $pickme=array();
         foreach ($pickmeTotal as $pickmeTotal) {
             $pickme[]=$pickmeTotal->total_bill;
         }
        $ricive_pickme= array_sum($pickme);
        
        // negambo dilive     
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('bill_type',12);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $negamboTotal= $query->result();
          $negambo=array();
         foreach ($negamboTotal as $negamboTotal) {
             $negambo[]=$negamboTotal->total_bill;
         }
        $ricive_negambo= array_sum($negambo);
        
        
          // table    
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('bill_type',2);
         $this->db->where('print_bill',0);
         $this->db->where('bill_delete',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $tableTotal= $query->result();
          $table=array();
         foreach ($tableTotal as $tableTotal) {
             $table[]=$tableTotal->total_bill;
         }
        $ricive_table= array_sum($table);
        
        
        /// pay bills
        
          // table    
         $this->db->from('supplier_payment');
         $this->db->where('bill_by',$user_id);
         $this->db->where('print_bill',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $billTotal= $query->result();
          $bill=array();
         foreach ($billTotal as $billTotal) {
             $bill[]=$billTotal->pay;
         }
        $pay_bill= array_sum($bill);
        
        
      $this->Bill_model->workPrint($user_id,$ricive_Caash,$ricive_bank,$ricive_card,$ricive_pending,$ricive_uber,$ricive_pickme, $ricive_negambo,$ricive_table,$pay_bill);
        
       
        // sumbill print marck
         $this->db->from('sum_bill');
         $this->db->where('cashier',$user_id);
         $this->db->where('payment_method_id',3);
          $this->db->where('print_bill',0);
         $this->db->like('bill_date',date('Y-m-d'));          
         $query = $this->db->get();
         $cshTotal= $query->result(); 
         foreach ($cshTotal as $cshTotal) {
         
        $tbs=array("print_bill"=>1);         
        $this->db->where('id',$cshTotal->id);
        $this->db->update('sum_bill',$tbs); 
            
         }
         
          $this->db->from('supplier_payment');
         $this->db->where('bill_by',$user_id);
         $this->db->where('print_bill',0);
         $this->db->like('bill_date',date('Y-m-d')); 
         $query = $this->db->get();
         $billTotal= $query->result();
         foreach ($billTotal as $billTotal) {
             
        $tbs=array("print_bill"=>1);         
        $this->db->where('supplier_payment_id',$billTotal->supplier_payment_id);
        $this->db->update('supplier_payment',$tbs); 
        
         }
          redirect(base_url('pos/dash'));
    }
    
    
    public function testbill() {
        $this->Bill_model->testbill_kot();
         $this->Bill_model->testbill_bill();
        redirect(base_url('selling'));
    }

}
