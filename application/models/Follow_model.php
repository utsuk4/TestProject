<?php

class Follow_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

   
    public function update($input) {
       // $u_type=$input['u_type'];
        $following=$input['following'];
        $followed_by=$input['followed_by'];
              
        $this->db->query("INSERT INTO follow (following,followed_by) VALUES('$following','$followed_by')");
    }
    
  
}
?>

