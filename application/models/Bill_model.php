<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

class Bill_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function kot($bill_no) {
                //define 4 printer
        $connector1 = new NetworkPrintConnector($this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_ip, $this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_port);
      //  $connector1 = new NetworkPrintConnector('192.168.1.100',9100);
        $printer1 = new Printer($connector1);


        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service)) {
            $deliver_service = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service;
            $type = $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $deliver_service))->row()->deliver_service_name . ' - BILL';
        } else {
            $type = 'TAKE AWAY BILL';
        }



        $printer1->setJustification(Printer::JUSTIFY_CENTER);
        $printer1->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer1->text("BIll NO " . $bill_no . "");
        $printer1->selectPrintMode();
        $printer1->feed(2);

        $printer1->setJustification(Printer::JUSTIFY_CENTER);
        $printer1->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer1->text("" . $type . "");
        $printer1->selectPrintMode();
        $printer1->feed(2);

        $printer1->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $this->db->where('bill_number', $bill_no);
        $this->db->from('bil_table as tb');
        $this->db->join('items it', 'it.itemname_id = tb.itemname_id', 'LEFT');
        $this->db->join('categories ca', 'ca.categories_id = tb.category_id', 'LEFT');
        $query = $this->db->get();
        $printbillsum = $query->result();
        foreach ($printbillsum as $printbillsum) {
            // if($printbillsum->categories_name=='Grocery Items' ){}else{
            $printer1->text("" . $printbillsum->itemname_name . " \n" . $printbillsum->quantity . " / " . $this->db->select('*')->get_where('bil_table', array('id' => $printbillsum->id))->row()->total . "\n");

// }
        }
        $printer1->selectPrintMode();
        $printer1->feed(1);
       
        $printer1->text("*************************\n");
        $printer1->cut();
        $printer1->close();
    }

    public function ricipt($bill_no) {

        $bill_number = $bill_no;

        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service)) {
            $deliver_service = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service;
            $type = $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $deliver_service))->row()->deliver_service_name . '';
        } else {
            $type = 'TAKE AWAY BILL';
        }


        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->payment_method_id)) {
            $payment_method_id = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->payment_method_id;
            $payment_name = $this->db->select('*')->get_where('payment_method', array('payment_method_id' => $payment_method_id))->row()->payment_name;
        }



        $connector = new NetworkPrintConnector("192.168.1.100", 9100);
        $printer = new Printer($connector);



        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('' . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_name . '');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_addres . "\n");
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_tp . "\n");
        $printer->text("Cahier : " . $this->session->uname . "\n");
        $printer->text("Bill Type : " . $type . "\n");
        $printer->text("Date : " . date('Y-m-d') . "   " . date('h:i:s a') . "\n");
        $printer->selectPrintMode();
        $printer->text("Payment : " . $payment_name . "\n");

        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->waiter)) {
            $waiter_name = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->waiter;
            $printer->text("Waiter : " . $this->db->select('*')->get_where('waiter', array('waiter_no' => $waiter_name))->row()->waiter_name . "\n");
        }


        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->refernumber))
            if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service)) {
                $deliver_service = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service;
                $printer->text("RFN : " . $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $deliver_service))->row()->deliver_service_name . '-' . $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->refernumber . "\n");
            }




        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('Rcp No ' . $bill_no . '');
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Price               Qty    Total \n");
        $total = '';
        $temp = $this->Takeaway_model->printbill($bill_number);
        foreach ($temp as $temp) {
            $printer->text("" . number_format($temp->value, 2) . " " . $temp->itemname_name . "\n");
            $printer->text("                  " . number_format($temp->value, 2) . " x " . $temp->quantity . " = " . number_format($temp->total, 2) . " \n");
        }
        $printer->selectPrintMode();
        $printer->feed(1);





        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('Total Bill Rs:' . $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->total_bill . '/=');
        $printer->selectPrintMode();
        $printer->feed(2);


        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('Item ' . $this->db->where(['bill_number' => $bill_number])->from("bil_table")->count_all_results() . '');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('**********************************************');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("THANK YOU COME AGAIN\n");
        $printer->text('WEBIOSA - 0769281189');
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->cut();
        $printer->close();
    }

    public function uber_picme($bill_no) {

        $bill_number = $bill_no;

        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service)) {
            $deliver_service = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service;
            $type = $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $deliver_service))->row()->deliver_service_name . '';
        } else {
            $type = 'TAKE AWAY BILL';
        }


        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->payment_method_id)) {
            $payment_method_id = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->payment_method_id;
            $payment_name = $this->db->select('*')->get_where('payment_method', array('payment_method_id' => $payment_method_id))->row()->payment_name;
        }



        $connector = new NetworkPrintConnector("192.168.1.100", 9100);
        $printer = new Printer($connector);



        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('' . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_name . '');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_addres . "\n");
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_tp . "\n");
        $printer->text("Cahier : " . $this->session->uname . "\n");
        $printer->text("Bill Type : " . $type . "\n");
        $printer->text("Date : " . date('Y-m-d') . "   " . date('h:i:s a') . "\n");
        $printer->selectPrintMode();
        $printer->text("Payment : " . $payment_name . "\n");

        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->waiter)) {
            $waiter_name = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->waiter;
            $printer->text("Waiter : " . $this->db->select('*')->get_where('waiter', array('waiter_no' => $waiter_name))->row()->waiter_name . "\n");
        }


        if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->refernumber))
            if (!empty($this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service)) {
                $deliver_service = $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->deliver_service;
                $printer->text("RFN : " . $this->db->select('*')->get_where('deliver_service', array('deliver_id' => $deliver_service))->row()->deliver_service_name . '-' . $this->db->select('*')->get_where('sum_bill', array('bill_number' => $bill_no))->row()->refernumber . "\n");
            }




        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('Rcp No ' . $bill_no . '');
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Item Name              Qty     \n");
        $total = '';
        $temp = $this->Takeaway_model->printbill($bill_number);
        foreach ($temp as $temp) {
            $printer->text("" . $temp->itemname_name . " " . $temp->quantity . " \n");
        }
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('Item ' . $this->db->where(['bill_number' => $bill_number])->from("bil_table")->count_all_results() . '');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('**********************************************           ');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("THANK YOU COME AGAIN\n");
        $printer->text('WEBIOSA - 0769281189');
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->cut();
        $printer->close();
    }

//supplier bill

    public function sup($bill_no) {

        // $bill_number = $bill_no;




        $connector = new NetworkPrintConnector("192.168.1.100", 9100);
        $printer = new Printer($connector);



        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('' . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_name . '');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_addres . "\n");
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_tp . "\n");
        $printer->text("Cahier : " . $this->session->uname . "\n");
        $printer->text("Bill Type : Supplier Bill\n");
        $printer->text("Date : " . date('Y-m-d') . "   " . date('h:i:s a') . "\n");
        $printer->selectPrintMode();




        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('Rcp No ' . $bill_no . '');
        $printer->selectPrintMode();
        $printer->feed(2);



        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Price               Qty    Total \n");
        $total = '';
        $temp = $this->Supplier_model->one_bill($bill_no);
        foreach ($temp as $temp) {
            $printer->text("" . number_format($temp->item_price, 2) . " " . $temp->item_quntity . "\n");
            $printer->text("                  " . number_format($temp->item_price, 2) . " x " . $temp->item_quntity . " = " . number_format($temp->total, 2) . " \n");
        }
        $printer->selectPrintMode();
      $printer->feed(1);






        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('**********************************************           ');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("THANK YOU COME AGAIN\n");
        $printer->text('WEBIOSA - 0769281189');
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->cut();
        $printer->close();
    }

    //supplier bill

    public function sup_pay($bill_no, $billBalance, $bill_pay) {

        $connector = new NetworkPrintConnector("192.168.1.100", 9100);
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('' . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_name . '');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_addres . "\n");
        $printer->text("" . $this->db->select('*')->get_where('shop_setting', array('id' => 1))->row()->shop_tp . "\n");
        $printer->text("Cahier : " . $this->session->uname . "\n");
        $printer->text("Bill Type : Supplier Bill\n");
        $printer->text("Date : " . date('Y-m-d') . "   " . date('h:i:s a') . "\n");
        $printer->selectPrintMode();

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('Rcp No ' . $bill_no . '');
        $printer->selectPrintMode();
        $printer->feed(2);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Bill Balance  " . number_format($billBalance, 2) . " \n");
        $printer->text("Pay           " . number_format($bill_pay, 2) . " \n");
        $printer->text("Balance       " . number_format($billBalance - $bill_pay, 2) . " \n");

        $printer->selectPrintMode();
        $printer->feed(2);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('**********************************************           ');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("THANK YOU COME AGAIN\n");
        $printer->text('WEBIOSA - 0769281189');
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->cut();
        $printer->close();
    }

/// work bill print

    public function workPrint($user_id, $ricive_Caash, $ricive_bank, $ricive_card, $ricive_pending, $ricive_uber, $ricive_pickme, $ricive_negambo, $ricive_table, $pay_bill) {

        $connector = new NetworkPrintConnector("192.168.1.100", 9100);
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('' . $this->db->select('*')->get_where('users', array('user_id' => $user_id))->row()->uname . '');
        $printer->selectPrintMode();
        $printer->feed(1);



        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Cash  " . number_format($ricive_Caash, 2) . " \n");
        $printer->text("Bank           " . number_format($ricive_bank, 2) . " \n");
        $printer->text("Card       " . number_format($ricive_card, 2) . " \n");
        $printer->text("Pending       " . number_format($ricive_pending, 2) . " \n");
        $printer->selectPrintMode();
        $printer->feed(2);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Uber  " . number_format($ricive_uber, 2) . " \n");
        $printer->text("Pick Me           " . number_format($ricive_pickme, 2) . " \n");
        $printer->text("Negambo Dil       " . number_format($ricive_negambo, 2) . " \n");
        $printer->selectPrintMode();
        $printer->feed(2);


        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Total Table " . number_format($ricive_table, 2) . " \n");
        $printer->selectPrintMode();
        $printer->feed(2);

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("Pay Bill " . number_format($pay_bill, 2) . " \n");
        $printer->selectPrintMode();
        $printer->feed(2);


        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("In Cashier " . number_format($ricive_Caash - $pay_bill, 2) . " \n");
        $printer->selectPrintMode();
        $printer->feed(2);


        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('**********************************************           ');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text('THANK YOU COME AGAIN');
        $printer->text('WEBIOSA - 0769281189');
        $printer->selectPrintMode();
        $printer->feed(1);

        $printer->cut();
        $printer->close();
    }

    public function testbill_kot() {
        $connector = new NetworkPrintConnector($this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_ip, $this->db->select('*')->get_where('kot', array('id' => 1))->row()->print_port);
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('Test Bill KOT');
        $printer->selectPrintMode();
        $printer->feed(5);
        $printer->cut();
        $printer->close();
    }
    
    
    
       public function testbill_bill() {
        $connector = new NetworkPrintConnector("192.168.1.100", 9100);
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text('Test Bill POS');
        $printer->selectPrintMode();
        $printer->feed(5);
        $printer->cut();
        $printer->close();
    }

}
