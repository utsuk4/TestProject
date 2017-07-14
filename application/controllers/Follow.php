<?php

    class Follow extends CI_Controller {

        public function __construct() {
            parent::__construct();
           
            $this->load->library('session');
            $this->load->model('User_model');
            $this->load->model('Follow_model');
        }

        public function index() {
           
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
               
                }
                redirect('home');
               
            } // end of post 
            
        

       
    }

?>