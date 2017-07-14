<?php

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('post_model');
         $this->load->library('session');
      //  $this->load->model('category_model');
        if(!$this->session->userdata('session_data')['loggedIn']){
            redirect('user/login');
        }
        
    }

    public function index() {
        $this->getAll();
    }

    public function do_upload() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|psd';
//        $config['max_size'] = 100;
//        $config['max_width'] = 2000;
//        $config['max_height'] = 2000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

            print_r($error); exit;
//            $this->load->view('upload_form', $error);
        } else {
            $data = $this->upload->data();
            return $data['file_name'];
        }
    }

    public function addpost() {
       // $data['categories'] = $this->category_model->getAllPublished();
         //print_r($data); exit;
         $session= $this->session->userdata('session_data');
         
        if($_POST) {
           // $this->form_validation->set_rules('title', 'Post Title', 'required');
          
               // $image = $this->do_upload();
        //    echo $this->input->post('posted_by');exit();
       
                $input = array(
                    'post' => $this->input->post('post'),                  
                   // 'post_image' => $image,
                    'created_by' =>$session['u_no'],
                    
                );

                $this->post_model->add($input);
                redirect('home');
            }// validation passed
        } 
    

    private function getAll() {
        $data['title'] = "Post Table";
        $data['module'] = "Post";
        $data['categories'] = $this->post_model->getAllJoined();
        $this->load->view('base/header', $data);
        $this->load->view('post/table');
    }

    public function detail($id) {
        $data['title'] = "Post Detail";
        $data['module'] = "Post";
        $data['post'] = $this->post_model->getSingle($id);
        $this->load->view('base/header', $data);
        $this->load->view('post/detail');
    }

    public function edit($id) {
        $data['title'] = "Post Table";
        $data['module'] = $this->uri->segment(1);
        $data['categories'] = $this->post_model->getAllJoined();
        if ($_POST) {
            $input = array(
                'post_title' => $this->input->post('title'),
                'post_description' => $this->input->post('description'),
                'published' => $this->input->post('published'),
                'featured' => $this->input->post('featured'),
            );
            $this->post_model->update($input, $id);
            redirect('post');
        } else {

            $data['post'] = $this->post_model->getSingle($id);
            $this->load->view('base/header', $data);
            $this->load->view('post/edit');
        }
    }

    public function delete($id) {
        $this->post_model->delete($id);
        redirect('post');
    }

}

?>