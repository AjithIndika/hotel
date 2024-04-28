<?php

$this->load->view('template/heder');
if ($this->session->user_type == "Admin") { 
$this->load->view('template/menu');
}
if ($this->session->user_type == "Cashier") { 
$this->load->view('template/menu_bill');
}
$this->load->view($page_content);
$this->load->view('template/foter');
