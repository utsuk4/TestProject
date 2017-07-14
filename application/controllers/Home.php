<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
      public function __construct() {
            parent::__construct();
            $this->load->model('Post_model');
            $this->load->model('User_model');
            $this->load->model('Follow_model');
            $this->load->library('session');
            $session= $this->session->userdata('session_data');
             
            if ($session['loggedIn'] != 1) {
            redirect('User/login');
        }
        }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
         $session= $this->session->userdata('session_data');
         // $data['session']= $this->session->userdata('session_data');
          $data['posts']=$this->Post_model->getall();
          $data['followingposts']=$this->Post_model->getfollowingpost($session['u_no']);
          $data['users']=$this->User_model->getall(); 
          $data['user']=$this->User_model->getsingle($session['u_no']);
          $data['notfollowing']=  $this->User_model->getnotfollowing($session['u_no']);
//          
// print_r($data['followingposts']);
////////////        
//  exit();
//         
// print_r($data['notfollowing']);
////////////        
//  exit();
////         
   
                  
        //  $id=$session['u_no'];
         
          $this->load->view('home/home',$data);
	}
//        public function notfollowinginfo($u_no)
//               
//        {
//            $info=$this->User_model->getfollowing($u_no);
//           
//         //  $followers_info=  array();
//         foreach ($info as $i):
//             
//                    if($i['followed_by']==$u_no&&$i['following']=!$u_no){
//                     $followers_info[]=$this->User_model->getcompliment($i['following']);
//                    }
//         
//         endforeach;
//         
//             return $followers_info;
//        }
        public function notfollowinginfo($u_no)
               
        {
            $info=$this->Follow_model->getnotfollowing($u_no);
           
         //  $followers_info=  array();
       
         
             return $info;
        }
        
        public function updatefollow($following){
            $session= $this->session->userdata('session_data');
             if ($_POST) {
//               
               //  echo $session['u_no'];
                    $input = array(
                        'following' => $following,
                        'followed_by' => $session['u_no'],                       
                       
                    );
                    $this->Follow_model->update($input);
    //  
    $this->index(); 
   
                }
               
                redirect('home');
            } 
//        public function getuserinfo($u_no)
//               
//        {
//            $info=$this->User_model->getsingle($u_no);
//            return $info;
//            
//        }
//         public function usercompliment($u_no)
//                 {
//             $info=  $this->User_model->getcompliment($u_no);
//             return $info;
//         }
        
        }
