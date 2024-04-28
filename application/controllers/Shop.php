<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Shop_model');
        $this->load->model('Image_model');
        $this->load->model('Report_model');

        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
    }

    public function shop() {

        $data = array(
            "page_title" => "Shop Setup",
            "page_content" => "sys/shop",);

        if ($this->input->post('save')) {

            $this->form_validation->set_rules('shop_name', 'Shop Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('shop_addres', 'Shop Addres', 'trim|required|xss_clean');
            $this->form_validation->set_rules('shop_tp', 'Shop Number', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Shop Setup",
                    "page_content" => "sys/shop",
                    "eroor" => '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>info !</strong> Please Check again....</div>',);
            } else {
                $shop = array(
                    "shop_name" => $this->input->post('shop_name'),
                    "shop_addres" => $this->input->post('shop_addres'),
                    "shop_tp" => $this->input->post('shop_tp'),);

                $this->Shop_model->shop($shop);


                $data = array(
                    "page_title" => "Shop Setup",
                    "page_content" => "sys/shop",
                    "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong>  Shop details save success.....</div>',);
            }
        }
        $this->load->view('template/template', $data);
    }

    public function payment() {

        $data = array(
            "page_title" => "Payment",
            "page_content" => "sys/payment",
            "all_payment" => $this->Shop_model->all_payment(),);


        if ($this->input->post('newpayment')) {
            $this->form_validation->set_rules('payment_name', 'Payment Method', 'trim|required|xss_clean|is_unique[payment_method.payment_name]');
            if ($this->form_validation->run() == FALSE) {

                $data = array(
                    "page_title" => "Payment",
                    "page_content" => "sys/payment",
                    "all_payment" => $this->Shop_model->all_payment(),
                    "eroor" => '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Info !</strong> ' . $this->input->post('payment_name') . ' This already exists </div>',);
            } else {
                $payment = array(
                    "payment_name" => $this->input->post('payment_name'),
                    "states" => 1,
                );
                $this->Shop_model->new_payment($payment);

                $data = array(
                    "page_title" => "Payment",
                    "page_content" => "sys/payment",
                    "all_payment" => $this->Shop_model->all_payment(),
                    "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong> ' . $this->input->post('payment_name') . ' Payment Method Save Success Full</div>',);
            }
        }


        if ($this->input->post('delet')) {
            $payment_method_id = $this->input->post('payment_method_id');
            $this->Shop_model->delet_payment($payment_method_id);
            $data = array(
                "page_title" => "Payment",
                "page_content" => "sys/payment",
                "all_payment" => $this->Shop_model->all_payment(),
                "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong> Delet Success Full</div>',);
        }
        $this->load->view('template/template', $data);
    }

    public function deliver() {

        $data = array(
            "page_title" => "Deliver",
            "page_content" => "sys/deliver",
                //  "all_payment" => $this->Shop_model->all_payment(),
                // "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong> Delet Success Full</div>',
        );


        if ($this->input->post('save')) {
            $this->form_validation->set_rules('deliver_service_name', 'Deliver Service Name', 'trim|required|xss_clean|is_unique[deliver_service.deliver_service_name]');
            //  $this->form_validation->set_rules('userfile', 'Image', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Deliver",
                    "page_content" => "sys/deliver",
                    //   "all_payment" => $this->Shop_model->all_payment(),
                    "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Error!</strong> Somthing Loss</div>',
                );
            } else {



                $newimage = strtolower(str_replace(' ', '_', date('Ymdhis'))) . '.' . strtolower(pathinfo($_FILES["userfile"]['name'], PATHINFO_EXTENSION));
                $image_details = array('newimage' => $newimage, 'path' => 'service/');

                $diliver = array(
                    "deliver_service_name" => $this->input->post('deliver_service_name'),
                    "deliver_image" => $newimage,
                    "status" => 1,
                );
                $this->Shop_model->new_deliver($diliver);
                $this->Image_model->image_up($image_details);

                $data = array(
                    "page_title" => "Deliver",
                    "page_content" => "sys/deliver",
                    //  "all_payment" => $this->Shop_model->all_payment(),
                    "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong> Data save Success Full</div>',
                );
            }
        }



        $this->load->view('template/template', $data);
    }

    public function deliver_list() {

        if ($this->input->post('update')) {
            $deliver_id = $this->input->post('deliver_id');
            $dilive_up = array(
                "status" => $this->input->post('status'),
            );

            $this->Shop_model->update_deliver($deliver_id, $dilive_up);
        }

        $data = array(
            "page_title" => "Deliver List",
            "page_content" => "sys/deliver_list",
            //  "all_payment" => $this->Shop_model->all_payment(),
            "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong> Data save Success Full</div>',
        );
        $this->load->view('template/template', $data);
    }

    public function driver() {
        $data = array(
            "page_title" => "Drives",
            "page_content" => "sys/driver",
            "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong> Data save Success Full</div>',
        );

        if ($this->input->post('dive_dtails')) {

            $this->form_validation->set_rules('drive_name', 'Drive Name', 'trim|required|xss_clean|is_unique[drive.drive_name]');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    "page_title" => "Drives",
                    "page_content" => "sys/driver",
                    "eroor" => '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Infor !</strong>' . $this->input->post('drive_name') . ' Allredy Use</div>',);
            } else {

                $drive = array(
                    "drive_name" => $this->input->post('drive_name'),
                );

                $this->Shop_model->new_drive($drive);
                $data = array(
                    "page_title" => "Drives",
                    "page_content" => "sys/driver",
                    "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong>' . $this->input->post('drive_name') . ' Data save Success Full</div>',);
            }
        }

        $this->load->view('template/template', $data);
    }

    public function driver_list() {
        $data = array(
            "page_title" => "Drive List",
            "page_content" => "sys/driver_list",
            "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong>' . $this->input->post('drive_name') . ' Data save Success Full</div>',);
        $this->load->view('template/template', $data);
    }

    public function kot() {
        if ($this->input->post('kot')) {

            $kotprint = array(
                "print_ip" => $this->input->post('print_ip'),
                "print_port" => $this->input->post('print_port'),
                "print_status" => $this->input->post('print_status'),
            );

            $this->Shop_model->kotprint($kotprint);
        }

        $data = array(
            "page_title" => "KOT print",
            "page_content" => "sys/kot",
            "eroor" => '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success !</strong>' . $this->input->post('drive_name') . ' Data save Success Full</div>',);
        $this->load->view('template/template', $data);
    }

    public function see() {
        $this->Report_model->cra();
    }

    public function waiter() {

        if ($this->input->post('waiter')) {
            $new_waier = array(
                "waiter_no" => $this->input->post('waiter_no'),
                "waiter_name" => $this->input->post('waiter_name'),
            );
            $this->Shop_model->new_waiter($new_waier);
        }

        if ($this->input->post('delet')) {
            $waiter_id = $this->input->post('waiter_id');
            $this->Shop_model->delt_waiter($waiter_id);
        }


        $data = array(
            "page_title" => "Waiter",
            "page_content" => "sys/waiter",);
        $this->load->view('template/template', $data);
    }
    
    
    
    public function clashop() {
        $this->db->empty_table('bil_table');
        $this->db->empty_table('sum_bill');   
        $this->db->empty_table('temp_bill');   		
        redirect(base_url('pos/dash'));
        
    }

}
