<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper('security');
    }

    public function userlist() {


            
             $data = array(
                "page_title" => "User List",
                "page_content" => "sys/userlist",
                "userlist"=> $this->User_model->all_users(),);
             /// new user 
            if($this->input->post('newuser')){
                 $this->form_validation->set_rules('uname', 'User Name', 'trim|required|xss_clean|is_unique[users.uname]');
                 $this->form_validation->set_rules('upassword', 'Password', 'trim|required|xss_clean');
                 $this->form_validation->set_rules('user_type', 'User Type', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $data = array(
                "page_title" => "User List",
                "page_content" => "sys/userlist",
                "error" => '<div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong>Alert ! </strong> Please check again.</div>',
                "userlist"=> $this->User_model->all_users(),);
                
            } else{
                
                $newuser=array(
                    "uname"=> $this->input->post('uname'),
                     "upassword"=> md5($this->input->post('upassword')),
                    "user_type"=> $this->input->post('user_type'),
                    "states"=>'Active',
                    "dateTime"=>date('Y-m-d h:i:s a'),
                );
                
                $this->User_model->newuser($newuser);
                $data = array(
                "page_title" => "User List",
                "page_content" => "sys/userlist",
                "error" =>  '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('uname').' crate a successful .</div>',
                "userlist"=> $this->User_model->all_users(),);
            }
                
            }
            
            // update user
            
            if($this->input->post('updatep')){                
                $user_id=$this->input->post('user_id');                
                 $upuser=array(                    
                 "user_type"=> $this->input->post('user_type'),
                 "states"=>$this->input->post('states'),
                 "lastUpdate"=>date('Y-m-d h:i:s a'),
                );
                 $this->User_model->update($upuser,$user_id);
                 
                 $data = array(
                "page_title" => "User List",
                "page_content" => "sys/userlist",
                "error" =>  '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('uname').' Update successful .</div>',
                "userlist"=> $this->User_model->all_users(),);
                
            }
            
            
            //resetpass
            if($this->input->post('resetpass')){
                
                $user_id=$this->input->post('user_id');                
                 $upuser=array(                    
                 "upassword"=> md5($this->input->post('upassword')),
                 "states"=>$this->input->post('states'),
                 "lastUpdate"=>date('Y-m-d h:i:s a'),
                );
                 $this->User_model->update($upuser,$user_id);
                 
                 $data = array(
                "page_title" => "User List",
                "page_content" => "sys/userlist",
                "error" =>  '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> '.$this->input->post('uname').' Password reset successful .</div>',
                "userlist"=> $this->User_model->all_users(),);
                
                
            }
            
            
            ///delet
            if($this->input->post('delet')){
                 $user_id=$this->input->post('user_id');  
                $this->User_model->delet($user_id);
                
                 $data = array(
                "page_title" => "User List",
                "page_content" => "sys/userlist",
                "error" =>  '<div class="alert alert-success alert-dismissible">  <button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Success ! </strong> User Delet successful .</div>',
                "userlist"=> $this->User_model->all_users(),);
            }
           
            $this->load->view('template/template', $data);
            
            
            
            
            
        
    }
    
    
   

}
