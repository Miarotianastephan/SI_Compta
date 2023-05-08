<?php 
// security
    defined('BASEPATH') OR exit('No direct script access allowed');
// --- 
    class InsertionCI extends CI_Controller{
        
        
        public function index(){
            $this->load->view("person");
        }

        public function process(){
            $stat = $_POST['status'];
            echo $stat;
            if( $stat == 'DIR'){
                $this->all_model->insertDT( $_POST['namelead'],$_POST['adress'],$_POST['phone'],$_POST['email']);
                redirect("IndexCI");
            }
            else if( $stat == 'SOCIETE'){

                $this->all_model->insertINFO($_POST['nom'],$_POST['objet'],$_POST['capital'],$_POST['dg'],$_POST['creation'],$_POST['siege'],$_POST['emptotal'],$_POST['datedebut'],$_POST['devisetenu']);
                //bouclena ny devis izay tsy null ihany no inserena amle societe
                $all_devise = $this->all_model->get_all_("devise");
                $idsociete = $this->all_model->get_lastId_from_("societe");
                foreach($all_devise as $dev){
                    $devise_choix = "dev_".$dev['id'];
                    if(isset($_POST[$devise_choix])){
                        if($idsociete!=""){
                            echo $_POST[$devise_choix];
                            $this->all_model->insertDeviseReference($idsociete,$_POST[$devise_choix]);
                        }
                    }
                }
                redirect("IndexCI");
            }
        }

        // journal
        public function updatejrn(){
            $id = $_POST['id'];
            $code = $_POST['code'];
            $intitule = $_POST['intitule'];
            $this->all_model->upadate_journal($id, $code, $intitule);
        }
        public function insertionjrn(){
            $code = $_POST['code'];
            $intitule = $_POST['intitule'];
            $this->all_model->insert_journal($code, $intitule);
        }
        public function deletejrn(){
            $id = $_POST['id'];
            $code = $_POST['code'];
            $intitule = $_POST['intitule'];
            $this->all_model->delete_journaux($id);
        }

        // plan tier
        public function update_list_tier(){
            $id = $_POST['id'];
            $code = $_POST['code'];
            $numero = $_POST['num'];
            $intitule = $_POST['intitule'];
            $this->all_model->upadate_tier($id ,$code, $num, $intitule);
        }
        public function insertiontier(){
            $code = $_POST['code'];
            $intitule = $_POST['intitule'];
            $this->all_model->insert_tier($code, $intitule);
        }
        public function deletetier(){
            $id = $_POST['id'];
            $code = $_POST['code'];
            $intitule = $_POST['intitule'];
            $this->all_model->delete_tier($id);
        }

        public function insert_ecriture(){
            $message = "Message:";
            $id = $_POST['id'];
            $date = $_POST['date'];
            $lib_piece = $_POST['libpiece'];
            $n_piece = $_POST['codepiece'];
            $id_co_general = $_POST['compte_gen'];
            $id_co_tier = $_POST['compte_tier'];
            $libelle = $_POST['libelle'];
            $id_devise = $_POST['devise'];
            $debit = $_POST['debit'];
            $credit = $_POST['credit'];
            $typeval = 0;
            // Construct the ident of piece 
            $n_piece = $n_piece."/".$lib_piece;
            if( (strlen($n_piece) <= 13) && (strlen($libelle) <=35) ){
                if( ($id_co_general != "") && ($id_co_tier == "")){
                    $id_co_tier = null;
                    if( ($debit != "") && ($credit == "" || $credit == 0) ){
                        $debit = $this->all_model->selectDevise_($id_devise,$debit);
                        $credit = 0;
                    }
                    else if( ($credit != "") && ($debit == "" || $debit == 0) ){
                        $credit = $this->all_model->selectDevise_($id_devise,$credit);
                        $debit = 0;
                    }
                    else{
                        return $message." verifier les montants voulue  à debiter ou à crediter !";
                    }
                    $this->all_model->insert_ecriture_jrn($id, $date, $n_piece, $id_co_general, $id_co_tier, $libelle, $id_devise, $debit, $credit,$typeval);
                    return $message;
                }
                else if ( ($id_co_tier != "") &&  ($id_co_general == "")){
                    $data_tier = $this->all_model->selectData_Tier($id_co_tier);
                    $id_co_general = $data_tier['idplancompte'];
                    if( ($debit != "") && ($credit == "" || $credit == 0) ){
                        $debit = $this->all_model->selectDevise_($id_devise,$debit);
                        $credit = 0;
                    }
                    else if( ($credit != "") && ($debit == "" || $debit == 0) ){
                        $credit = $this->all_model->selectDevise_($id_devise,$credit);
                        $debit = 0;
                    }
                    $this->all_model->insert_ecriture_jrn($id, $date, $n_piece, $id_co_general, $id_co_tier, $libelle, $id_devise, $debit, $credit,$typeval);
                    return $message;
                }
                else{
                    return $message."Verifier les numeros decomptes";
                } 
            }
            else{
                return $message."Numero de piece ou intitule non-valide";
            }
        }
        
    }
?>