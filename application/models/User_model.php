<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function check($logindata){
        $email = $logindata['u_email'];
        $password = $logindata['u_password'];
       // $type = $logindata['type'];

        $query = $this->db->query("SELECT * FROM user WHERE u_email='$email' AND u_password='$password'");

        $data = $query->row();
       // print_r($data);
      //  exit();
 
        if (count($data) == 1) {
            return $data;
        } else {
            return FALSE;
        }
        
    }
    public function signup($input){
            $this->db->insert('user',$input);
           // $this->session->set_flashdata('msg',"Registration Successfull , Please login to continue");
        }
     public function getall(){
            $query = $this->db->query("SELECT * FROM user");
           return $query->result_array();
           
        }
    public function deleteuser($u_no){
        $this->db->query("DELETE FROM user WHERE u_no='$u_no'");
       
    } 
    public function updateuser($u_no,$input) {
       // $u_type=$input['u_type'];
        $u_photo=$input['u_photo'];
      
         $this->db->query("UPDATE user SET u_photo='$u_photo' WHERE u_no='$u_no'");
    }
    public function getsingle($u_no){
       $query = $this->db->query("SELECT u_name,u_photo,u_no FROM user where u_no ='$u_no'");
           return $query->row_array();  
    }
    public function getcompliment($u_no){
       $query = $this->db->query("SELECT u_name,u_photo,u_no FROM user where u_no !='$u_no'");
           return $query->result_array(); 
    }
    
      public function getnotfollowing($u_no){
//     $query = $this->db->query("SELECT following From follow where followed_by='$u_no'");
  
//       
//    $query = $this->db->query("SELECT * FROM user,follow 
//            WHERE 
//
//user.u_no!=follow.following
//
//AND (    user.u_no!='$u_no' OR  follow.followed_by='$u_no')    
//
//ORDER BY u_no DESC");
//     $query = $this->db->query("SELECT DISTINCT user.u_name,user.u_photo,user.u_no FROM user INNER JOIN follow ON $u_no!='followed_by'");
          
           
           $query = $this->db->query("select u.u_name, u.u_no,u.u_photo
	 from user u 
	 left outer join follow f on f.followed_by=u_no
	 where f.following IS NULL ORDER BY u.u_no DESC ");
          return $query->result_array();  
    }
    
}
?>

