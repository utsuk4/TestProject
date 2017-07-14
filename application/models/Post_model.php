<?php

class Post_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    } // end of constructor

    public function add($input) {
      //  $input['post_slug'] = url_title($input['post_title'],'dash',TRUE);
        $input['created_at']  = date('Y/m/d:h-i-s');
//         echo $input['created_at']; exit;
     //   $input['created_by'] = $this->session->userdata('session_data')['uid'];         
        $this->db->insert('post', $input);
       // $this->session->set_flashdata('msg', "Inserted Successfully");
    }
    
    public function getAll(){
       // $this->db->select('*')->from('post');
       // $query = $this->db->get();
         $query = $this->db->query("SELECT post.*,user.u_name as u_name,user.u_photo FROM post INNER JOIN user ON post.created_by=u_no ORDER BY post.id DESC");
        return $query->result_array();
    }
     
    
    public function getSingle($id){
        $query = $this->db->query("SELECT * FROM post WHERE id='$id'");
        return $query->row_array();
    }
    
    public function update($data,$id){
        $this->db->where('id',$id);
        $this->db->update('post',$data);
        $this->session->set_flashdata('msg',"Update  successfull");
    }

    
    public function delete($id){
        $this->db->query("DELETE FROM post WHERE id='$id'");
        $this->session->set_flashdata('msg',"Deletion successfull");
    }
   
   
    public function getfollowingpost($u_no){
      // $query = $this->db->query("SELECT post.* FROM post LEFT OUTER JOIN follow ON post.created_by=follow.following OR $u_no RIGHT OUTER JOIN user ON user.u_no = follow.followed_by ORDER BY post.id DESC");
//        $query = $this->db->query("SELECT * FROM post,user,follow 
//            WHERE 
//
//Post.created_by=user.u_no
//AND
//user.u_no=follow.Following
//
//
//AND (    user.u_no='$u_no' OR  follow.followed_by='$u_no')    
//    
//
//ORDER BY post.created_at DESC");
    
        
        $query = $this->db->query("select p.post, p.id,p.created_at,u.u_no,u.u_photo, u.u_name
	 from post p 
	 left join user u on p.created_by = u_no
	 left join follow f on f.following = u_no AND f.followed_by=$u_no 
	 where p.created_by = f.following OR p.created_by = $u_no ORDER BY p.created_at DESC ");
       return $query->result_array();
    }
    public function getslug($post_slug)
    {
        $query=$this->db->query("SELECT * from post where post_slug='$post_slug'");
        return $query->row_array();
        
    }
}

// end of class
?>