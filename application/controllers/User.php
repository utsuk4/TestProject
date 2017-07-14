<?php

    class User extends CI_Controller {

        public function __construct() {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('session');
            $this->load->model('User_model');
        }

        public function index() {
           $this->login();
        }
        
        public function do_upload() {
        $config['upload_path'] = './uploads/profile';
        $config['allowed_types'] = 'gif|jpg|png|psd';
//        $config['max_size'] = 100;
//        $config['max_width'] = 2000;
//        $config['max_height'] = 2000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('u_photo')) {
            $error = array('error' => $this->upload->display_errors());

            print_r($error); exit;
//            $this->load->view('upload_form', $error);
        } else {
            $data = $this->upload->data();
            return $data['file_name'];
        }
    }
        public function signup(){
             if ($_POST) {
//                $this->form_validation->set_rules('u_name', 'Full Name', 'required');
//                $this->form_validation->set_rules('u_email', 'Email Id', 'required|valid_email|is_unique[user.email]');
//                $this->form_validation->set_rules('u_password', 'Password', 'required');
//                $this->form_validation->set_rules('u_address', 'Address', 'required');
//                $this->form_validation->set_rules('u_contact', 'Contact', 'required');
//                if ($this->form_validation->run() == FALSE) {
//
//                   // $this->load->view('user/signup');
//                } 
//                else {
                    $input = array(
                        'u_name' => $this->input->post('u_name'),
                        'u_email' => $this->input->post('u_email'),                       
                        'u_password' => md5($this->input->post('u_password')),
                        'u_contact' =>  $this->input->post('u_contact'),
                    );
                    $this->User_model->signup($input);
    //              
                 //   redirect('home');
                } 
                
                else{
                    $this->load->view('signup/signup_form');
                }
                $this->login();
            } // end of post 
            
        

        public function login() {
          //  $data['title'] = "LOGIN FORM";
            
            if ($_POST) {
                $this->form_validation->set_rules('u_email', 'Email Id', 'required|valid_email|is_unique[user.email]');
                $this->form_validation->set_rules('u_password', 'Password', 'required');
                    $logindata = array(
                        'u_email' => $this->input->post('u_email'),
                        'u_password' => md5($this->input->post('u_password')),    
                    );

                    $success = $this->User_model->check($logindata);

                    if ($success) { //if there's something in $success (TRUE)
                        $sess_data = array(//set session data for future use
                            'u_no' => $success->u_no,
                            'u_email' => $success->u_email,
                            'u_password' => $success->u_password,
                            'u_type' => $success->u_type,
                            'loggedIn' => 1,
                            'u_name'=> $success->u_name,
                            'u_photo'=> $success->u_photo,
                            'u_contact'=> $success->u_contact,
                        );
                        //$key=$sess_data['u_no'];
                        
                        $this->session->set_userdata('session_data', $sess_data);
                        redirect('home');
                       // $this->load->view('dashboard/dashHead',$sess_data);
                     //   $this->load->view('dashboard/profile');
                        


                    }
                    else { 
                    echo '<script type="text/javascript">alert("Invalid Username / Password");</script>';
                    echo '<script type="text/javascript">history.back(-1);</script>';
                    
                    ////if $success==FALSE
//                        $this->session->set_flashdata('msg', "Email or Password Error!!!");
//                        redirect(base_url()."#myModal");
                        //$this->load->view('home/home');
                    }

            } 
            else{
             $this->load->view('login/login_form');
            }

        }

        public function userdetail(){
            $data['users']=  $this->User_model->getall();
            $this->load->view('dashboard/dashHead');
            $this->load->view('user/user_detail',$data);
        }

        public function logout(){
         $this->session->sess_destroy();
         redirect('home');
        }

        public function deleteuser($u_no) {
            $this->User_model->deleteuser($u_no);
            $this->userdetail();

        }
        public function updateuser($u_no) {
            
                $config['upload_path'] = './uploads/profile/';
                 if ($_POST) {
                $image = $this->do_upload($config);
                  $input = array(
                        'u_name' => $this->input->post('u_name'),
                        'u_photo' => $image,
                       
                    );
                  
                } 
                $this->User_model->updateuser($u_no,$input);
                redirect('home');

        }

    }

?>