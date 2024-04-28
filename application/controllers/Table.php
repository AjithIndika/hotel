<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('table_model'); 
        $this->load->model('Categories_model');  
         $this->load->model('Shop_model');  
        
         $this->load->model('Item_model');         
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
		$this->load->model('Bill_model');  
		$this->load->model('Takeaway_model');
		
		
    }

    public function table() {
        
$last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
$_SESSION['colour']= $record_num;


            $_SESSION['driver']='';
            $_SESSION['reference_number']='';
            $_SESSION['deliver']='';
            $_SESSION['waiter']="";
            $_SESSION['reference_number']='';
              
             

        $data = array(
            "page_title" => "Table List",
            "page_content" => "sys/table",
            "all_table" => $this->table_model->all_table(),
        );
        /// new user 
        if ($this->input->post('newcat')) {
  $this->form_validation->set_rules('table_no', 'Table Name', 'trim|required|xss_clean|is_unique[table_no.table_no]');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Table List",
                    "page_content" => "sys/table",
                    "all_table" => $this->table_model->all_table(),
                    "error" => '<div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Alert ! </strong> Please check again.</div>',
                );
            } else {

                $table_no = array("table_no" => $this->input->post('table_no'),);

                $this->table_model->new_table($table_no);
                $data = array(
                    "page_title" => "Table List",
                    "page_content" => "sys/table",
                    "all_table" => $this->table_model->all_table(),
                    "error" => '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> ' . $this->input->post('table_no') . ' crate a successful .</div>',
                );
            }
        }

        ///delet
        if ($this->input->post('delet')) {
            $table_id = $this->input->post('table_id');
            $this->table_model->delet($table_id);
            $data = array(
                "page_title" => "Table List",
                "page_content" => "sys/table",
                "all_table" => $this->table_model->all_table(),
                "error" => '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> Delete  successful .</div>',
                "all_table" => $this->table_model->all_table(),);
        }

        $this->load->view('template/template', $data);
    }
    
    
    public function tabal_bill() {   
        
$last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
$_SESSION['colour']= $record_num;


         if($this->input->post('waiter')){
                  $_SESSION['waiter']=$this->input->post('waiter_name'); 
              }
              
              if(!empty($this->input->get('table'))){
                  $_SESSION['table_no']=base64_decode(base64_decode($this->input->get('table')));
              }
        
        
        
           if($this->input->post('upvalue')){            
            $temp_id= $this->input->post('temp_id');           
            $temp_bill=array(
                "value"=>$this->input->post('total'),
                 "total"=>$this->input->post('total')*$this->db->select('*')->get_where('temp_bill', array('temp_id' =>$temp_id))->row()->quantity,);
              $this->table_model->temp_bill_update($temp_id,$temp_bill);
        }
 
           if($this->input->post('delet')){
            $temp_id= $this->input->post('temp_id');
            $this->table_model->temp_delet($temp_id);
        }
        
         $data = array(
                 "page_title" => "Table List",
                 "page_content" => "pos/tabal_bill",               
                 "error" => '',
                 "all_categories"=> $this->Categories_model->active_categories(),
                 "all_table" => $this->table_model->all_table(),
           );
              $this->load->view('template/template', $data);
    }
    
    
    
    public function tablelist() {
        $_SESSION['cat']= $this->input->get('cat');
       
        $data = array(
                 "page_title" => "Table List",
                 "page_content" => "pos/tablelist",
                  "itemlist"=> $this->table_model->all_Item_active(),
                 "all_categories"=> $this->Categories_model->active_categories(),
                 "all_table" => $this->table_model->all_table(),
           );
                 $this->load->view('template/template', $data);
        
    }
    
    public function add() {
      $itemname_id= $this->input->post('itemname_id');
       $itemqun=$this->input->post('itemqun');
     
    $this->db->where('itemname_id',$itemname_id);
    $this->db->where('cashier',$this->session->user_id);
    $this->db->where('temp_date',date('Y-m-d'));
    $this->db->where('bill_type',2);
    $this->db->where('table_no',1);
    $query = $this->db->get('temp_bill');
    $count_row = $query->num_rows();
    if ($count_row > 0) {
      $temp_id=  $this->db->select('*')->get_where('temp_bill', array('itemname_id' =>$itemname_id,'cashier'=>$this->session->user_id,'temp_date'=>date('Y-m-d'),'bill_type'=>2))->row()->temp_id;
      $quantity= $this->db->select('*')->get_where('temp_bill', array('temp_id' =>$temp_id))->row()->quantity;
     
       
        $temp_bill=array(
            "quantity"=>$itemqun,
            "total"=>$this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->value*($quantity+1),
            );
        $this->table_model->temp_bill_update($temp_id,$temp_bill);
         
         redirect(base_url('table/tablelist?cat='. $_SESSION['cat'].''));
       }else{
    
    
        $temp_bill=array(
            "itemname_id"=>$itemname_id,
            "category_id"=>$this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->category_id,
            "value"=>$this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->values,
            "cashier"=>$this->session->user_id,
            "bill_type"=>2,
            "quantity"=>$itemqun,
             "waiter"=>$_SESSION['waiter'],
            "table_no"=>1,
            "total"=>$this->db->select('*')->get_where('items', array('itemname_id' =>$itemname_id))->row()->values*$itemqun,
            "temp_date"=>date('Y-m-d')
            );
        $this->table_model->temp_bill($temp_bill);
         
          redirect(base_url('table/tablelist?cat='. $_SESSION['cat'].''));
       }
   
   
    }
    
    
    ///prosess
    
     
    public function prosess() {
        
     $pay= $this->input->get('pay');
        
        $bill_date=date('Y-m-d h:i:s a');
        
        if(!empty($this->db->select("*")->limit(1)->order_by('bill_number',"DESC")->get("bil_table")->row()->bill_number)){
        $bill_no=sprintf( "%04d", $this->db->select("*")->limit(1)->order_by('bill_number',"DESC")->get("bil_table")->row()->bill_number+1);
      }
       else{
          $bill_no=sprintf( "%04d", 1);
      }
      
     
           $this->db->where('cashier',$this->session->user_id);
           $this->db->where('table_no',1);
           $this->db->where('temp_date',date('Y-m-d'));
           $this->db->where('bill_type',2);           
           $this->db->from('temp_bill as tb'); 
           $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
           $query = $this->db->get();
           $data= $query->result();
           
         
         
          // $total_bill="";
           foreach ($data as $va) {               
            //   $total_bill[]=$va->total;
              
               $tobill=array(
                   "bill_number"=>$bill_no,
                   "itemname_id"=>$va->itemname_id,
                   "category_id"=>$va->category_id,
                   "value"=>$va->value,                    
                   "total"=>$va->total,
                   "quantity"=>$va->quantity,
                   "cashier"=>$va->cashier,
                   "bill_type"=>$va->bill_type,
                   "table_no"=>$va->table_no,
                   "temp_date"=>$bill_date,
                   "payed"=>0,
                   "bill_delete"=>0,
                   "payment_method_id"=>$pay,);
               
               $this->table_model->bill($tobill);
             
               
           }
           
             $this->db->where('cashier',$this->session->user_id);
           $this->db->where('table_no',1);
           $this->db->where('temp_date',date('Y-m-d'));
           $this->db->where('bill_type',2);           
           $this->db->from('temp_bill as tb'); 
           $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
           $this->db->select_sum('total');
           $querys = $this->db->get();
           $datas= $querys->result();
           
           foreach ($datas as $datas) {
               
         $totals=   $datas->total;
               
           }
           
           
           $sum_bill=array(
               'bill_number'=>$bill_no,
               'total_bill'=>  $totals,
               'bill_date'=>$bill_date,
               'cashier'=>$this->session->user_id,
               'bill_type'=>2,
               'table_no'=>1,
               'print_bill' => 0,
               'pay_bill'=>0,
                "bill_delete"=>0,
              "waiter"=>$_SESSION['waiter'],
               "payment_method_id"=>$pay,
           );
           
           
             
            $this->db->where('cashier',$this->session->user_id);
           $this->db->where('table_no',1);
           $this->db->where('temp_date',date('Y-m-d'));
           $this->db->where('bill_type',2);           
           $this->db->from('temp_bill as tb');           
           $query = $this->db->get();
           $data= $query->result();           
           foreach ($data as $data) {
               $temp_id=$data->temp_id; 
          $this->table_model->temp_delet($temp_id);
               
           }
           
           
           
           $this->table_model->sum_bill($sum_bill);
            $this->Bill_model->ricipt($bill_no);
           
           
          redirect(base_url('takeaway/bill?bill='.base64_encode(base64_encode($bill_no)).''));
        
    }
    
    
    
    public function pending() {  
        
        $last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
$_SESSION['colour']= $record_num;

              $_SESSION['driver']='';
              $_SESSION['reference_number']='';
              $_SESSION['deliver']='';
              $_SESSION['waiter']="";
              $_SESSION['reference_number']='';
              
              
         $data = array(
                "page_title" => "Pending Bill",
                "page_content" => "pos/pending",
             "all_table" => $this->table_model->all_table(),
                //"itemlist"=> $this->table_model->all_Item_active(),
                );
   $this->load->view('template/template', $data);
     
    }
    
    
    public function pay() {
        



        $bill_number= $this->input->post('bill_number');
        $pays= $this->input->post('pay');
        
        $bilup=array(
            "pay_bill"=>1,
            "payment_method_id"=>$pays,
         );
        
        $pa=array(
            "payed"=>1,
            "payment_method_id"=>$pays,
        );
        $this->table_model-> bil_table($bill_number,$pa);
        $this->table_model->update_sum($bill_number,$bilup);
        
             $data = array(
               "page_title" => "Pending Bill",
               "page_content" => "pos/pending",
              // "all_table" => $this->table_model->all_table(),
              // "itemlist"=> $this->table_model->all_Item_active(),
               "eroor"=>'<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success ! </strong> '.$bill_number.' Payment Success
</div>'
                );
   $this->load->view('template/template', $data);
        
        
        
    }
    
    
    public function waiter() {
        
        if($this->input->post('waiter')){
             $table_no=$this->input->post('table_no');
            $update=array(
               "waiter"=> $this->input->post('waiter_name'),
            );
           $this->table_model->update_waiter($table_no,$update);
            
        }
        
         $data = array(
            "page_title" => "Waiter",
            "page_content" => "sys/waiter",
            "all_table" => $this->table_model->all_table(),
         );
         
          $this->load->view('template/template', $data);
        
    }
    
    
    public function deletBill() {
         $this->db->where('cashier',$this->session->user_id);
           $this->db->where('table_no',1);
           $this->db->where('temp_date',date('Y-m-d'));
           $this->db->where('bill_type',2);           
           $this->db->from('temp_bill as tb'); 
           $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
           $query = $this->db->get();
           $data= $query->result();
         
           foreach ($data as $va) {             
              $temp_id=$va->temp_id;
           $this->table_model->temp_delet($temp_id);
           }
           
           redirect(base_url('table/tabal_bill'));
    }
    
    
    
    public function aditems() {
        
         $data = array(
                "page_title" => "Items",
                "page_content" => "pos/tableaditems",);
                $this->load->view('template/template', $data);
        
        
        
    }
    
    public function other() {
         $data = array(
                "page_title" => "Table Other",
                "page_content" => "pos/table_other",);
          if($this->input->post('tabelother')){             
        
         $this->form_validation->set_rules('itemqun', 'Value', 'numeric|trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                
                $data = array(
                "page_title" => "Table Other",
                "page_content" => "pos/table_other",);
            }
            else{
              
           $temp_bill=array(
            "itemname_id"=>239,
            "category_id"=>26,
            "table_no"=>1,
            "value"=>intval($this->input->post('itemqun')),
            "cashier"=>$this->session->user_id,
            "bill_type"=>'2',
            "quantity"=>0,         
            "total"=>intval($this->input->post('itemqun')),//str_replace(str_split('/*-+='),'0',$this->input->post('itemqun')),
            "temp_date"=>date('Y-m-d')
            );
         $this->table_model->temp_bill($temp_bill);
        
          }
          }
        
       $this->load->view('template/template', $data);
        
        
        
    }

}
