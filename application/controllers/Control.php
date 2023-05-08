<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Control extends CI_Controller{
        
        public function index(){
            $data['societe'] = $this->all_model->get_all_("v_societe_info_and_devise");
            $data['v_societe_dirigeant'] = $this->all_model->get_all_("v_societe_dirigeant");
            $data['v_societe_deviseref'] = $this->all_model->get_all_("v_societe_info_devise_ref");
            $this->load->view("page_acceuil",$data);
        }
        public function load_jrn(){
            $data['code_jrn'] = $this->all_model->get_all_("journaux");
            $this->load->view("page_journaux",$data);
        }
        public function load_compta(){
            $data['plancomptable'] = $this->all_model->get_all_("plancomptable");
            $this->load->view("page_comptable",$data);
        }
        public function load_tier(){
            $data['plan_tier'] = $this->all_model->get_all_("v_compte_tier_alldetail");
            $data['plan_comptable_tier'] = $this->all_model->get_all_("v_plan_compta_tier");
            $this->load->view("page_tiers",$data);
        }
        public function load_test(){
            $this->load->view("testselect");
        }
        public function load_ecriture(){
            $data['codage_piece'] = $this->all_model->get_all_("pointage_piece");
            $data['tier_detail'] = $this->all_model->get_all_("v_compte_tier_alldetail");
            $data['pcg'] = $this->all_model->get_all_(" plancomptable");
            $this->load->view("ecriture",$data);
        }


        public function about()
        {
            // définition des données variables du template
            $data['pseudo'] = 'Miaro';
            $data['email'] = 'miarotiana@gmail.com  ';
            $data['en_ligne'] = true;

            $data['title'] = 'Le titre de la page';
            $data['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // on charge la view qui contient le corps de la page
            $data['contents'] = 'template_view';
            // on charge la page dans le template
            $this->load->view('templates/template', $data);
        }

        public function loadmodel(){
            $this->load->model("new_model");
            $data = array();
            // $data['user_info'] = $this->new_model->get_info();
            $data['user_info'] = $this->new_model->get_data_user();
            
            $data['pseudo'] = 'MiaroOO1';
            $data['email'] = 'ramanatsoamiaro@gmail.com';
            $data['en_ligne'] = true;
            $data['title'] = 'Le titre de la page';
            $data['description'] = 'La description de la page pour les moteurs de recherche';
            $data['keywords'] = 'les, mots, clés, de, la, page';
            // corp de la page 
            $data['contents'] = 'template_view';

            $this->load->view('templates/template',$data);
        }



    }
?>