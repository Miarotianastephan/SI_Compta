<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Redir extends CI_Controller{
        
        public function index(){
            $passing_value = $this->input->get('var');
            echo $passing_value;
            if(!empty($passing_value)){
                $indexation = "Control/%s";
                $indexation = sprintf($indexation, $passing_value);
                redirect($indexation);
            }
            else{
                redirect("Control");
            }
        }
    }

?>