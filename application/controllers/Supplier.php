<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Shop_model');
        $this->load->model('Image_model');
        $this->load->model('Report_model');
        $this->load->model('Supplier_model');
        $this->load->model('Bill_model');
        
        
        
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
    }

    public function new_supplier() {
        
        if($this->input->post('newsupplier')){
           $suppier=array(
                 "supplier_name"=> $this->input->post('supplier_name'),
                "supplier_items"=> $this->input->post('supplier_items'),
                "balance"=>0,
            );
            
            $this->Supplier_model->new_supplier($suppier);
           
            
        }

        $data = array(
            "page_title" => "Shop Setup",
            "page_content" => "supplier/index",);
  $this->load->view('template/template', $data);
    }

    
    public function suplist() {
          $data = array(
            "page_title" => "Shop Setup",
            "page_content" => "supplier/list",);
  $this->load->view('template/template', $data);
        
    }
    
    
    public function newbill() {
         $data = array(
            "page_title" => "Shop Setup",
            "page_content" => "supplier/crate",);
         
        if($this->input->post('new_bill')){
            
             if (!empty($this->db->select("*")->limit(1)->order_by('supplier_bill_no', "DESC")->get("supplier_acc")->row()->supplier_bill_no)) {
            $bill_no = sprintf("%04d", $this->db->select("*")->limit(1)->order_by('supplier_bill_no', "DESC")->get("supplier_acc")->row()->supplier_bill_no + 1);
        } else {
          $bill_no =sprintf("%04d", 1);
            
     
        }

        
           $supplier=array(
                "supplier_bill_no"=>$bill_no,
                "supplier_id"=> $this->input->post('supplier_id'),
                "item_quntity"=>$this->input->post('item_quntity'),
                "item_price"=>$this->input->post('item_price'),
                "total"=>$this->input->post('item_quntity')*$this->input->post('item_price'),
                "bill_balance"=>$this->input->post('item_quntity')*$this->input->post('item_price'),
               "bill_by"=>$this->session->user_id,              
               "bill_date"=>date('Y-m-d h:i:s a'),
           );
           
           $this->Supplier_model->newbill($supplier);
           
           $sup=array(
               "balance"=> $this->db->get_where('supplier', array('supplier_id' =>$this->input->post('supplier_id')))->row()->balance + $this->input->post('item_quntity')*$this->input->post('item_price'),
           );
          // $this->db->get_where('shop_seting', array('supplier_id' =>$this->input->post('supplier_id')))->row()->balance + $this->input->post('item_quntity')*$this->input->post('item_price');
           
           
        $this->db->where('supplier_id',$this->input->post('supplier_id'));
        $this->db->update('supplier',   $sup);  
        
        //print bill     
       $this->Bill_model->sup($bill_no);        
       redirect(base_url('supplier/newbill'));
         
        }
         
  $this->load->view('template/template', $data);
    }
    
    
    
    
    public function suppliervice() {
        
        if($this->input->post('bill_balance')){
            
         $bill_pay=   $this->input->post('bill_pay');
            //ad payment
            
          $bill_no=  $this->input->post('supplier_bill_no');
          $bill=array(
              'supplier_bill_no'=>$bill_no,
              'supplier_id'=>$this->db->get_where('supplier_acc', array('supplier_bill_no' =>$bill_no))->row()->supplier_id,
              "pay"=>  $this->input->post('bill_pay'),
               "print_bill"=>0,
              "bill_by"=>$this->session->user_id,
               "bill_date"=>date('Y-m-d h:i:s a'),
              );
           $this->Supplier_model->newpay($bill);
           
           
           //supplier id
           
            $supplier_id=$this->db->get_where('supplier_acc', array('supplier_bill_no' =>$bill_no))->row()->supplier_id;
           
           
            $billBalance=$this->db->get_where('supplier_acc', array('supplier_bill_no' =>$bill_no))->row()->bill_balance;
            
             $this->Bill_model->sup_pay($bill_no,$billBalance, $bill_pay);
           
           // update bill
           
           $bill_balance=array(
              "bill_balance" =>$this->db->get_where('supplier_acc', array('supplier_bill_no' =>$bill_no))->row()->bill_balance-$this->input->post('bill_pay'),
           );
           
           $this->db->where('supplier_bill_no',$bill_no);
           $this->db->update('supplier_acc',$bill_balance);
          
          
          // acc balance 
           
          
           
            $supplier_acc=array(
              "balance" =>$this->db->get_where('supplier', array('supplier_id' =>$supplier_id))->row()->balance-$this->input->post('bill_pay'),
           );
           
           $this->db->where('supplier_id',$supplier_id);
           $this->db->update('supplier', $supplier_acc);
           
           
       //    $this->Bill_model->sup_pay($bill_no);
           
           redirect(base_url('supplier/suppliervice'));
   
            
        }
        
        $data = array(
            "page_title" => "Shop Setup",
            "page_content" => "supplier/suppliervice",);
        $this->load->view('template/template', $data);
    }
    
}
