<?php

class User_model extends CI_Model {

        function __construct() {
        parent::__construct();
  }
  
   /// login
    function log($uname,$upassword) {
     
    $user = $this->db->select("states,user_type,user_id,uname")->where(['uname' => $uname, 'upassword' => md5($upassword),'states'=>'Active'])->get('users')->row();
  if ($user) {
            $logindata = ['user_id'=>$user->user_id,'uname' => $user->uname,'user_type'=>$user->user_type];
           $this->session->set_userdata($logindata);
           
        if ($this->session->user_type =="Admin") {
            redirect(base_url('dash'));
        }
        
        if ($this->session->user_type =="Cashier") {
            redirect(base_url('selling'));
        }
       else{
            redirect(base_url());
        }
        
         
           /*
           redirect(base_url('dash'));
        } else {
           redirect(base_url());
        }
            * */
           
    }
    }
    
    public function all_users() {
         $this->db->from('users');           
         $query = $this->db->get();
         return $query->result(); 
        }
    

    public function newuser($newuser) {
       $this->db->insert('users',$newuser);
       }
       
       public function update($upuser,$user_id) {
        $this->db->where('user_id',$user_id);
        $this->db->update('users', $upuser);  
           
       }
       
       public function delet($user_id) {
       $this->db->where('user_id',$user_id);
       $this->db->delete('users');       
           
       }
       
       
    
    

}
