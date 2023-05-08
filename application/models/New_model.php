<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class New_model extends CI_Model{

        public function get_data_objet(){
            $tab[] = array();
            $i = 0;//chaque ligne du tableau
            $request = $this->db->query('select * from objet');
            foreach( $request->result_array() as $row ){
                $tab[$i]['id'] = $row['id'];
                $tab[$i]['idMembre'] = $row['idMembre'];
                $tab[$i]['descri'] = $row['descri'];
                $tab[$i]['prix'] = $row['prix'];
                $i++;
            }
            return $tab;
        }

        
        public function get_data_detailobjet(){
            $tab[] = array();
            $i = 0;//chaque ligne du tableau
            $request = $this->db->query('select * from detailobjet');
            foreach( $request->result_array() as $row ){
                $tab[$i]['idObjet'] = $row['idObjet'];
                $tab[$i]['photo'] = $row['photo'];
                $i++;
            }
            return $tab;
        }

        public function insert_data_user($pwd,$nom,$email){
            $request = "insert into user(pwd,nom,email) values(%s , %s, %s)";
            $request  = sprintf($request,$this->db->escape($pwd),$this->db->escape($nom),$this->db->escape($email));
            $this->db->query($request);
        }
        

        // insertion objet
        public function insert_objet($idM,$desc,$prix){
            $request = "insert into objet(idMembre,descri,prix) values(%s , %s, %s)";
            $request  = sprintf($request,$this->db->escape($idM),$this->db->escape($desc),$this->db->escape($prix));
            $status = $this->db->query($request);
            return $status;
        }

        public function get_lastIdObjet(){
            $request = $this->db->query('select * from objet order by id desc limit 1');
            $linedata = $request->row_array();
            return $linedata['id'];
        }

        // insertion detail_objet
        public function insert_datailobjet($detail){
            // alaina ny id maximum alohany insert detail objet
            $lastID = $this->get_lastIdObjet();
            $request = "insert into detailobjet values(%s , %s)";
            $request  = sprintf($request,$this->db->escape($lastID),$this->db->escape($detail));
            $status = $this->db->query($request);
            return $status;
        }

        // insert objetDetailer
        public function insertMyObjet($idM,$desc,$prix,$imgsource){
            $this->insert_objet($idM,$desc,$prix);
            for($i = 0; $i < count($imgsource); $i++){
                $this->insert_datailobjet($imgsource[$i]);
            }
        }

        public function get_AllObjet(){
            $tab = array();
            $request = $this->db->query('select * from listdetailobjet');
            foreach( $request->result_array() as $row ){
                array_push($tab,$row);
            }
            return $tab;
        }

        public function insert_ObjetDetail($idM,$desc,$prix){ 
            // File upload configuration 
            $targetDir = "C:/IT_WORK/work_ITU/work_web/UwAmp/www/takalo/sary/"; 
            $allowTypes = array('jpg','png','jpeg','gif','webp'); 
            
            $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
            $fileNames = array_filter($_FILES['files']['name']); 
            if(!empty($fileNames)){ 
                foreach($_FILES['files']['name'] as $key=>$val){ 
                    // File upload path 
                    $fileName = basename($_FILES['files']['name'][$key]); 
                    $targetFilePath = $targetDir . $fileName; 
                    
                    // Check whether file type is valid 
                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                    if(in_array($fileType, $allowTypes)){ 
                        // Upload file to server 
                        // argument ====> temp_name du fichier ::: dossier contenant les images
                        if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                            // insertion objet+image
                            if($insertValuesSQL == ''){
                                $insertValuesSQL = $this->insert_objet($idM,$desc,$prix);
                            }
                            $this->insert_datailobjet($_FILES["files"]["name"][$key]);
                        }else{ 
                            $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                        } 
                    }else{ 
                        $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
                    } 
                } 
            }else{ 
                $statusMsg = 'Please select a file to upload.'; 
            } 
        } 

        public function update_objet($idObA_echanger,$idObB_echanger){
            // maka ojbet roa ho permutena
            
            $ObjA = $this->getObjet($idObA_echanger);
            $idMembre_A = $ObjA['idMembre'];
            $ObjB = $this->getObjet($idObB_echanger);
            $idMembre_B = $ObjB['idMembre'];

            $request = "update objet set idMembre=%s where id=%s";
            $request  = sprintf($request,$this->db->escape($idMembre_B),$this->db->escape($idObA_echanger));
            $status = $this->db->query($request);

            $request2 = "update objet set idMembre=%s where id=%s";
            $request2 = sprintf($request2,$this->db->escape($idMembre_A),$this->db->escape($idObB_echanger));
            $status = $this->db->query($request2);

            return $status;
        }

        public function getObjet($idOb){
            $obj = $this->get_data_objet();
            for($i=0 ; $i < count($obj); $i++){
                if( $obj[$i]['id'] == $idOb ){
                    return $obj[$i];
                }
            }return null;
        }

    }
?>