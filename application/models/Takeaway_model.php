<?php

class Takeaway_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function all_Item_active() {
        $this->db->where('category_id', $_SESSION['cat']);
        $this->db->where('status', 'Active');
        $this->db->from('items');
        $query = $this->db->get();
        return $query->result();
    } 

    // temp bill  
    public function temp_bill($temp_bill) {
        $this->db->insert('temp_bill', $temp_bill);
    }

    // update bill


    public function temp_bill_update($temp_id, $temp_bill) {
        $this->db->where('temp_id', $temp_id);
        $this->db->update('temp_bill', $temp_bill);
    }

    //tackaway temp bill
    public function takeaway_temp() {
        $this->db->where('cashier', $this->session->user_id);
        $this->db->where('table_no', '');
        $this->db->where('temp_date', date('Y-m-d'));
        $this->db->where('bill_type', 1);
        $this->db->from('temp_bill as tb');
        $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
         $this->db->join('categories ca', 'ca.categories_id = tb.category_id', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

    //takeway temp bill delet

    public function takeway_delet($temp_id) {
        $this->db->where('temp_id', $temp_id);
        $this->db->delete('temp_bill');
    }

    public function bill($tobill) {
        $this->db->insert('bil_table', $tobill);
    }

    public function sum_bill($sum_bill) {
        $this->db->insert('sum_bill', $sum_bill);
    }

    //tackaway temp bill
    public function printbill($bill_number) {
        $this->db->where('bill_number', $bill_number);
        $this->db->select('*');
        $this->db->from('bil_table as tb');
        $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
        $this->db->join('categories ca', 'ca.categories_id = tb.category_id', 'LEFT');

        $query = $this->db->get();
        return $query->result();
    }

    public function printbillsum($bill_number) {
        $this->db->where('bill_number', $bill_number);
        $this->db->select('*');
        $this->db->from('bil_table as tb');
        $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
        $this->db->select_sum('total');
        $query = $this->db->get();
        $printbillsum = $query->result();

        foreach ($printbillsum as $printbillsum) {
            echo number_format($printbillsum->total, 2);
        }
    }

    public function kotprint($bill_number) {
        $this->db->where('bill_number', $bill_number);
        $this->db->select('*');
        $this->db->from('bil_table as tb');


        $query = $this->db->get();
        $printbillsum = $query->result();

        foreach ($printbillsum as $printbillsum) {
            echo $printbillsum->itemname_id;
        }
    }

    

   
}
