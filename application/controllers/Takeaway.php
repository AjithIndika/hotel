<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Takeaway extends CI_Controller {

public function __construct() {
parent::__construct();

$this->load->model('Categories_model');
$this->load->model('Takeaway_model');
$this->load->model('table_model');
$this->load->model('Shop_model');
$this->load->model('Table_model');
$this->load->model('Bill_model');


$this->load->library(array('form_validation', 'session'));
$this->load->helper('security');
}

public function takeaway() {


$last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
$_SESSION['colour'] = $record_num;


$_SESSION['driver'] = '';
$_SESSION['reference_number'] = '';
$_SESSION['deliver'] = '';
$_SESSION['waiter'] = "";

if($this->input->post('delet')){
$temp_id = $this->input->post('temp_id');
$this->Takeaway_model->takeway_delet($temp_id);
}

if($this->input->post('upvalue')){

$temp_id = $this->input->post('temp_id');
$temp_bill = array(
"value" => $this->input->post('total'),
 "total" => $this->input->post('total')*$this->db->select('*')->get_where('temp_bill', array('temp_id' => $temp_id))->row()->quantity, );
$this->Takeaway_model->temp_bill_update($temp_id, $temp_bill);
}


$data = array(
"page_title" => "Takeaway Billing",
 "page_content" => "pos/takeaway",
 "all_categories" => $this->Categories_model->active_categories(),
 "all_table" => $this->Table_model->all_table());
$this->load->view('template/template', $data);

}

public function shpitem() {

$_SESSION['cat'] = $this->input->get('cat');

$data = array(
"page_title" => "Items",
 "page_content" => "pos/shpitem",
 "all_table" => $this->table_model->all_table(),
 "itemlist" => $this->Takeaway_model->all_Item_active(), );
$this->load->view('template/template', $data);

}


public function add() {

$itemname_id = $this->input->post('itemname_id');
$itemqun = $this->input->post('itemqun');

$this->db->where('itemname_id', $itemname_id);
$this->db->where('cashier', $this->session->user_id);
$this->db->where('temp_date', date('Y-m-d'));
$this->db->where('bill_type', 1);
$query = $this->db->get('temp_bill');
$count_row = $query->num_rows();
if ($count_row > 0) {
$temp_id = $this->db->select('*')->get_where('temp_bill', array('itemname_id' => $itemname_id, 'cashier' => $this->session->user_id, 'temp_date' => date('Y-m-d'), 'bill_type' => 1))->row()->temp_id;
$quantity = $this->db->select('*')->get_where('temp_bill', array('temp_id' => $temp_id))->row()->quantity;


$temp_bill = array(
"quantity" => $itemqun,
 "total" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->value*($itemqun),
);
$this->Takeaway_model->temp_bill_update($temp_id, $temp_bill);
redirect(base_url('shpitem?cat='. $_SESSION['cat'].''));

}else{


$temp_bill = array(
"itemname_id" => $itemname_id,
 "category_id" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->category_id,
 "value" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->values,
 "cashier" => $this->session->user_id,
 "bill_type" => '1',
 "quantity" => $itemqun,
 //  "bill_delete"=>0,
"total" => $this->db->select('*')->get_where('items', array('itemname_id' => $itemname_id))->row()->values*$itemqun,
 "temp_date" => date('Y-m-d')
);
$this->Takeaway_model->temp_bill($temp_bill);
redirect(base_url('shpitem?cat='. $_SESSION['cat'].''));

}


}


public function prosess() {
$pay = $this->input->get('pay');



$bill_date = date('Y-m-d h:i:s a');
if(!empty($this->db->select("*")->limit(1)->order_by('bill_number', "DESC")->get("bil_table")->row()->bill_number)){
$bill_no = sprintf( "%04d", $this->db->select("*")->limit(1)->order_by('bill_number', "DESC")->get("bil_table")->row()->bill_number+1);
}
else{
$bill_no = sprintf( "%04d", 1);
}





$this->db->where('cashier', $this->session->user_id);
$this->db->where('table_no', '');
$this->db->where('temp_date', date('Y-m-d'));
$this->db->where('bill_type', 1);
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
 "bill_delete" => 0,
 "payed" => 1,
 "payment_method_id" => $pay,
);





$this->Takeaway_model->bill($tobill);
$this->Takeaway_model->takeway_delet($temp_id);



}

$sum_bill = array(
'bill_number' => $bill_no,
 'total_bill' => array_sum($total_bill),
 'bill_date' => $bill_date,
 'cashier' => $this->session->user_id,
 'bill_type' => 1,
 'print_bill' => 0,
 'table_no' => '',
 'pay_bill' => 1,
 "bill_delete" => 0,
 "payment_method_id" => $pay,
);
$this->Takeaway_model->sum_bill($sum_bill);

// kot print on off
if($this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_status==1)
{
$this->Bill_model->kot($bill_no);
}

$this->Bill_model->ricipt($bill_no);
redirect(base_url('takeaway/bill?bill='.base64_encode(base64_encode($bill_no)).''));

}


public function bill() {
$_SESSION['driver'] = '';
$_SESSION['reference_number'] = '';
$_SESSION['deliver'] = '';
$_SESSION['waiter'] = "";

$data = array(
"page_title" => "Items",
 "page_content" => "pos/bill",
 "all_table" => $this->table_model->all_table(),
 'bill_number' => base64_decode(base64_decode($this->input->get('bill'))));
$this->load->view('template/template', $data);

//redirect(base_url('selling'));


}


public function uberpicbill() {


$data = array(
"page_title" => "Items",
 "page_content" => "pos/uberpicbill",
 "all_table" => $this->table_model->all_table(),
 'bill_number' => base64_decode(base64_decode($this->input->get('bill'))));
$this->load->view('template/template', $data);

//  redirect(base_url('selling'));
}


public function deletBill() {

$this->db->where('cashier', $this->session->user_id);
$this->db->where('table_no', '');
$this->db->where('temp_date', date('Y-m-d'));
$this->db->where('bill_type', 1);
$this->db->from('temp_bill as tb');
$this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
$query = $this->db->get();
$data = $query->result();
;

foreach ($data as $va) {
$total_bill[] = $va->total;
$temp_id = $va->temp_id;
$tobill = array();


$this->Takeaway_model->takeway_delet($temp_id);


}
redirect(base_url('takeaway'));
}


public function aditems() {

$data = array(
"page_title" => "Items",
 "page_content" => "pos/takeaditems", );
$this->load->view('template/template', $data);

}


public function other() {
$data = array(
"page_title" => "Takway Other",
 "page_content" => "pos/takway_other", );

if($this->input->post('takeway')){

$this->form_validation->set_rules('itemqun', 'Value', 'numeric|trim|required|xss_clean');
if ($this->form_validation->run() == FALSE) {
$data = array(
"page_title" => "Takway Other",
 "page_content" => "pos/takway_other", );

}else{
$temp_bill = array(
"itemname_id" => 239,
 "category_id" => 26,
 "value" => intval($this->input->post('itemqun')),
 "cashier" => $this->session->user_id,
 "bill_type" => '1',
 "quantity" => 0,
 //  "bill_delete"=>0,
"total" => intval($this->input->post('itemqun')),
 "temp_date" => date('Y-m-d')
);
$this->Takeaway_model->temp_bill($temp_bill);
}
}

$this->load->view('template/template', $data);

}



public function grosory() {

$data = array(
"page_title" => "Takway Other",
 "page_content" => "pos/grosory", );

if($this->input->post('takeway')){

$this->form_validation->set_rules('itemqun', 'Value', 'numeric|trim|required|xss_clean');
if ($this->form_validation->run() == FALSE) {
$data = array(
"page_title" => "Takway Other",
 "page_content" => "pos/grosory", );

}else{
$temp_bill = array(
"itemname_id" => 245,
 "category_id" => 28,
 "value" => intval($this->input->post('itemqun')),
 "cashier" => $this->session->user_id,
 "bill_type" => '1',
 "quantity" => 0,
 //  "bill_delete"=>0,
"total" => intval($this->input->post('itemqun')),
 "temp_date" => date('Y-m-d')
);
$this->Takeaway_model->temp_bill($temp_bill);
}
}

$this->load->view('template/template', $data);

}


}

