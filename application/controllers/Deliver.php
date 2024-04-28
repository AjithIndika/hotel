<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deliver extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Categories_model');
        $this->load->model('Takeaway_model');
        $this->load->model('table_model');
        $this->load->model('Delivery_model');
		$this->load->model('Bill_model'); 
		$this->load->model('Takeaway_model');


        $this->load->model('Shop_model');
        $this->load->model('Table_model');

        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
    }

public function deliver() {
        
 $last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
$_SESSION['colour']= $record_num;

        $_SESSION['waiter'] = "";
        


        if ($this->input->post('reference')) {
            $_SESSION['reference_number'] = $this->input->post('reference_number');
        }

        if ($this->input->get('deliver')) {
            $_SESSION['deliver'] = base64_decode(base64_decode($this->input->get('deliver')));
            $_SESSION['driver'] =$_SESSION['deliver'];
        }

        if ($this->input->get('drive')) {
            $_SESSION['driver'] = $this->input->get('drive');
        }

        if ($this->input->post('delet')) {
            $temp_id = $this->input->post('temp_id');
            $this->Delivery_model->delivery_delet($temp_id);
        }
        if ($this->input->post('upvalue')) {

            $temp_id = $this->input->post('temp_id');
            $temp_bill = array(
                "value" => $this->input->post('total'),
                "total" => $this->input->post('total') * $this->db->select('*')->get_where('temp_bill', array('temp_id' => $temp_id))->row()->quantity,);
            $this->Delivery_model->temp_bill_update($temp_id, $temp_bill);
        }


        $data = array(
            "page_title" => "Deliver Billing",
            "page_content" => "pos/diliver",
            "all_categories" => $this->Categories_model->active_categories(),
            "all_table" => $this->Table_model->all_table());
        $this->load->view('template/template', $data);
    }

    public function diliveritem() {

        $_SESSION['cat'] = $this->input->get('cat');

        $data = array(
            "page_title" => "Deliver Items",
            "page_content" => "pos/diliveritem",
            "all_table" => $this->table_model->all_table(),
            "itemlist" => $this->Takeaway_model->all_Item_active(),);
        $this->load->view('template/template', $data);
    }

    public function add() {

        $itemname_id = $this->input->post('itemname_id');
        $itemqun = $this->input->post('itemqun');

        //  $temp_id=  $this->db->select('*')->get_where('temp_bill', array('itemname_id' =>$this->input->get('id'),'cashier'=>$this->session->user_id,'temp_date'=>date('Y-m-d'),'bill_type'=>3))->row()->temp_id;
        $this->db->where('itemname_id', $itemname_id);
        $this->db->where('cashier', $this->session->user_id);
        $this->db->where('temp_date', date('Y-m-d'));
        $this->db->where('deliver_service', $_SESSION['deliver']);
        $this->db->where('bill_type', 3);
        $query = $this->db->get('temp_bill');
        $count_row = $query->num_rows();
        if ($count_row > 0) {
            $temp_id = $this->db->select('*')->get_where('temp_bill', array('itemname_id' => $itemname_id, 'cashier' => $this->session->user_id, 'temp_date' => date('Y-m-d'), 'bill_type' => 3))->row()->temp_id;
            $quantity = $this->db->select('*')->get_where('temp_bill', array('temp_id' => $temp_id))->row()->quantity;

            $temp_bill = array(
                "quantity" => $itemqun,
                "total" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->values * ($quantity + 1),
            );
            $this->Delivery_model->temp_bill_update($temp_id, $temp_bill);
            redirect(base_url('deliver/diliveritem?cat=' . $_SESSION['cat'] . ''));
        } else {


            $temp_bill = array(
                "itemname_id" => $itemname_id,
                "category_id" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->category_id,
                "value" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->values,
                "cashier" => $this->session->user_id,
                "bill_type" => 3,
                "deliver_service" => $_SESSION['deliver'],
                "refernumber" => $_SESSION['reference_number'],
                "quantity" => $itemqun,
                "driver" => $_SESSION['driver'],
                "total" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->values * $itemqun,
                "temp_date" => date('Y-m-d')
            );
            $this->Delivery_model->temp_bill($temp_bill);
            redirect(base_url('deliver/diliveritem?cat=' . $_SESSION['cat'] . ''));
        }
    }

    public function prosess() {

        $pay = $this->input->get('pay');

        $bill_date = date('Y-m-d h:i:s a');

        if (!empty($this->db->select("*")->limit(1)->order_by('bill_number', "DESC")->get("bil_table")->row()->bill_number)) {
            $bill_no = sprintf("%04d", $this->db->select("*")->limit(1)->order_by('bill_number', "DESC")->get("bil_table")->row()->bill_number + 1);
        } else {
            $bill_no = sprintf("%04d", 1);
        }


        $this->db->where('cashier', $this->session->user_id);
        $this->db->where('table_no', '');
        $this->db->where('temp_date', date('Y-m-d'));
        $this->db->where('bill_type', 3);
        $this->db->where('deliver_service', $_SESSION['deliver']);
        $this->db->from('temp_bill as tb');
        $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
        $query = $this->db->get();
        $data = $query->result();
        ;

        foreach ($data as $va) {

            $total_bill[] = $va->total;
            $temp_id = $va->temp_id;
            $tobill = array(
                "bill_number" => $bill_no,
                "itemname_id" => $va->itemname_id,
                "category_id" => $va->category_id,
                "value" => $va->value,
                "total" => $va->total,
                "quantity" => $va->quantity,
                "cashier" => $va->cashier,
                "bill_type" => $va->bill_type,
                "table_no" => $va->table_no,
                "temp_date" => $bill_date,
                "deliver_service" => $_SESSION['deliver'],
                "driver" => $_SESSION['driver'],
                "refernumber" => $_SESSION['reference_number'],
                "payed" => 1,
                "bill_delete" => 0,
                "payment_method_id" => $pay,
            );

            $this->Delivery_model->bill($tobill);
            $this->Delivery_model->delivery_delet($temp_id);
        }

        $sum_bill = array(
            'bill_number' => $bill_no,
            'total_bill' =>array_sum($total_bill), //array_sum($total_bill),
            'bill_date' => $bill_date,
            'cashier' => $this->session->user_id,
            "refernumber" => $_SESSION['reference_number'],
            'bill_type' => 3,
            'table_no' => '',
            'pay_bill' => 1,
            'print_bill' => 0,
            "bill_delete" => 0,
            "driver" => $_SESSION['driver'],
            "payment_method_id" => $pay,
            "deliver_service" => $_SESSION['deliver'],
        );
        $this->Delivery_model->sum_bill($sum_bill);
        
       // kot print on off
           if($this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_status==1) 
           {
             $this->Bill_model->kot($bill_no);  }
          
       
        
        if($_SESSION['deliver'] ==12){ 

        $this->Bill_model->ricipt($bill_no);		
        redirect(base_url('takeaway/bill?bill=' . base64_encode(base64_encode($bill_no)) . ''));
        }
        else{
			 $this->Bill_model->uber_picme($bill_no);
          redirect(base_url('takeaway/uberpicbill?bill=' . base64_encode(base64_encode($bill_no)) . ''));  
        }
    }

    public function bill() {
        $data = array(
            "page_title" => "Items",
            "page_content" => "pos/bill",
            "all_table" => $this->table_model->all_table(),
            'bill_number' => base64_decode(base64_decode($this->input->get('bill'))));
        $this->load->view('template/template', $data);
    }
    
    
    
       public function uberpicbill() {
        $data = array(
            "page_title" => "Items",
            "page_content" => "pos/uberpicbill",
            "all_table" => $this->table_model->all_table(),
            'bill_number' => base64_decode(base64_decode($this->input->get('bill'))));
        $this->load->view('template/template', $data);
    }
    

    public function deletBill() {
        $this->db->where('cashier', $this->session->user_id);
        $this->db->where('table_no', '');
        $this->db->where('temp_date', date('Y-m-d'));
        $this->db->where('bill_type', 3);
        $this->db->where('deliver_service', $_SESSION['deliver']);
        $this->db->from('temp_bill as tb');
        $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
        $query = $this->db->get();
        $data = $query->result();
        ;

        foreach ($data as $va) {
            $temp_id = $va->temp_id;
            $this->Delivery_model->delivery_delet($temp_id);
        }

        redirect(base_url('deliver/deliver'));
    }

    public function aditems() {
        $data = array(
            "page_title" => "Items",
            "page_content" => "pos/diliveryadditems",);
        $this->load->view('template/template', $data);
    }

    public function other() {

          $data = array(
            "page_title" => "Deliver Other",
            "page_content" => "pos/deliver_other",);
        if ($this->input->post('deliver_other')) {
            
            $this->form_validation->set_rules('itemqun', 'Value', 'numeric|trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                 $data = array(
            "page_title" => "Deliver Other",
            "page_content" => "pos/deliver_other",);
            }
            else{

            $temp_bill = array(
                "itemname_id" => 239,
                "category_id" => 26,               
                "value" => intval($this->input->post('itemqun')),
                "cashier" => $this->session->user_id,
                "bill_type" => '3',
                "quantity" => 0,
                "deliver_service" => $_SESSION['deliver'],
                "refernumber" => $_SESSION['reference_number'],
                "driver" => $_SESSION['driver'],
                "total" => intval($this->input->post('itemqun')),
                "temp_date" => date('Y-m-d')
            );
            $this->Delivery_model->temp_bill($temp_bill);
          
        }
        }
       
        $this->load->view('template/template', $data);
    }
    
    
    public function refernumber() {
        
         if ($this->input->get('deliver')) {
            $_SESSION['deliver'] = base64_decode(base64_decode($this->input->get('deliver')));
            $_SESSION['driver'] =$_SESSION['deliver'];
        }
        
      //  $_SESSION['driver']=  base64_decode(base64_decode($this->input->get('deliver')));
        
        $data = array(
            "page_title" => "Refer Number",
            "page_content" => "pos/refernumber",);
        $this->load->view('template/template', $data);
        
    }

}
