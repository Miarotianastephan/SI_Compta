<?php
// security
defined('BASEPATH') OR exit('No direct script access allowed');
// --- 

    class IndexCI extends CI_Controller{
        // Main of the page
        public function index(){
            $data['devise'] = $this->all_model->get_all_("devise");
            $data['person'] = $this->all_model->get_all_("person");
            $this->load->view("create",$data);
        }

        public function insert(){
            redirect("IndexCI");
        }
    }
?>