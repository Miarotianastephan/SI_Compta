<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class All_model extends CI_Model {
        
        public function insertDT($nm,$add,$phone,$mail){
            $request = "insert into person(namelead,addres,phone,mail) values(%s , %s, %s, %s)";
            $request  = sprintf($request,$this->db->escape($nm),$this->db->escape($add),$this->db->escape($phone),$this->db->escape($mail));
            $status = $this->db->query($request);
            return $status;
        }

        public function insertINFO($nom,$obj,$capital,$dg,$creation,$adress,$nbemp,$datedebut,$devis_tenu){
            $request = "insert into societe(soc_name,soc_objet,capital,dirigeantID,soc_creationdate,soc_adresse,soc_emptotal,datedebut,devise_tenu_compte)
                        values 
                        (%s,%s,%s,%s,%s,%s,%s,%s,%s)";
            $request  = sprintf($request,
            $this->db->escape($nom),$this->db->escape($obj),
            $this->db->escape($capital),$this->db->escape($dg),$this->db->escape($creation),
            $this->db->escape($adress),$this->db->escape($nbemp),
            $this->db->escape($datedebut),
            $this->db->escape($devis_tenu));
            $status = $this->db->query($request);
            return $status;
        }

        public function insertDeviseReference($idsociete,$devis_tenu){
            $request = "insert into S_devisereference(idsociete,idref_devise) values 
            (%s,%s)";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($devis_tenu));
            $status = $this->db->query($request);
            return $status;
        }
        public function insertDetailScan($idsociete,$type,$num,$scanpdf){
            $request = "insert into S_detailscan(idsociete,idtype,numero,scanpdf) values 
            ('%s,%s,%s,%s')";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($type),$this->db->escape($num),$this->db->escape($scanpdf));
            $status = $this->db->query($request);
            return $status;
        }  
        public function insertPhoneList($idsociete,$phone){
            $request = "insert into S_phonelist(idsociete,phonenumber) values 
            ('%s,%s')";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($phone));
            $status = $this->db->query($request);
            return $status;
        }
        public function insertEmailList($idsociete,$mail){
            $request = "insert into S_emaiList(idsociete,email) values 
            ('%s,%s')";
            $request = sprintf($request,$this->db->escape($idsociete),$this->db->escape($mail));
            $status = $this->db->query($request);
            return $status;
        }

        public function get_all_($nom_table){
            $tab = array();
            $str = "select * from %s";
            $str = sprintf($str, $nom_table);
            $request = $this->db->query($str);
            foreach( $request->result_array() as $row ){
                array_push($tab,$row);
            }
            // var_dump($tab);
            return $tab;
        }

        public function get_lastId_from_($nom_table){
            $request = 'select * from %s order by id desc limit 1';
            $request = sprintf($request, $nom_table);
            $request = $this->db->query($request);
            $linedata = $request->row_array();
            return $linedata['id'];
        }
        
        public function import_Files(){
            $fp = fopen('test.txt', 'r');
            $content = fgets($fp,255);
            fclose($fp);
            echo 'Notre contenue '.$contenu_du_fichier;
        } 
        
        public function import_Csv(){
            $fp = fopen('test.txt', 'r');
            if ($fp !== false){
                $csv_data =[];

                while(($data =  fgetcsv($fp, 1000, ",")) !== false ){
                    $csv_data[] = $data;
                }

                fclose($fp);
                
                foreach($csv_data as $row){
                    echo implode(",", $row). "</br>";
                }
            }else{
                echo "Error lors du chargement";
            }
        }
        // TABLE JOURNAUX
        public function upadate_journal($id, $new_code, $new_title){
            $request = "update journaux set code=%s, intitule=%s where id=%s"; 
            $request = sprintf($request,$this->db->escape($new_code),$this->db->escape($new_title),$this->db->escape($id));
            $status = $this->db->query($request);
            return $status;
        }
        public function insert_journal($code, $title){
            $request = "insert into journaux(code,intitule) values (%s,%s)"; 
            $request = sprintf($request,$this->db->escape($code),$this->db->escape($title));
            $status = $this->db->query($request);
            $id_last_ = $this->get_lastId_from_("journaux");    
            // $id_last_ = 9;    
            $my_id = array(
                "id" => $id_last_,
                "code" => $code,
                "intitule" => $title
            );
            // return $status;
            echo json_encode($my_id);
        }
        public function delete_journaux($id){
            $request = "delete from journaux where id=%s";
            $request = sprintf($request, $this->db->escape($id));
            $status = $this->db->query($request);
            return $status;
        }
        
        // TABLE TIER
        public function upadate_tier($id ,$code_collectif, $num, $intitule){
            $request = "update compte_tier set idcompte_collectif=%s, numerocompte=%s, intitule=%s where id=%s"; 
            $request = sprintf($request,$this->db->escape($code_collectif),$this->db->escape($num),$this->db->escape($intitule),$this->db->escape($id));
            $status = $this->db->query($request);
            return $status;   
        }
        public function insert_tier($code_collectif, $num, $title){
            $request = "insert into compte_tier(idcompte_collectif,numerocompte,intitule) values (%s,%s,%s)"; 
            $request = sprintf($request,$this->db->escape($code_collectif),$this->db->escape($num),$this->db->escape($intitule));
            $status = $this->db->query($request);
            $id_last_ = $this->get_lastId_from_("compte_tier");    
            $my_id = array(
                "id" => $id_last_,
                "code_collectif" => $code_collectif,
                "numerocompte" => $num,
                "intitule" => $title
            );
            echo json_encode($my_id);
        }
        public function delete_tier($id){
            $request = "delete from compte_tier where id=%s";
            $request = sprintf($request, $this->db->escape($id));
            $status = $this->db->query($request);
            return $status;
        }

        public function insert_ecriture_jrn($id_code, $date_ecr, $n_piece, $id_co_general, $id_co_tier, $libelle, $id_devise, $debit, $credit, $typeval){            
            $request = "insert into ecriture_journaux(id_code_journaux,dat_ecriture,numero_piece,idcompte_general,idcompte_tier,libelle,iddevise,debit,credit,typeval) values 
            (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)";
            $request = sprintf($request,
            $this->db->escape($id_code),
            $this->db->escape($date_ecr),
            $this->db->escape($n_piece),
            $this->db->escape($id_co_general),
            $this->db->escape($id_co_tier),
            $this->db->escape($libelle),
            $this->db->escape($id_devise),
            $this->db->escape($debit),
            $this->db->escape($credit),
            $this->db->escape($typeval));
            $status = $this->db->query($request);
            $id_last_ = $this->get_lastId_from_("ecriture_journaux");    
            // $id_last_ = 9;    
            $my_id = array(
                "id" => $id_last_,
                "code" => $id_code,
                "intitule" => $libelle
            );
            // return $status;
            echo json_encode($my_id);
        }

        // apres une validation d'ecriture on insere dans le grand livvre
        // Si on valide une ecriture et au'elle nest pas encore dans le grand livre CAS1
        // Sinon on fait une update de cette ecriture(ou operation) pour ajouter a sa somme de debit ou credit le montant voulue
        public function insert_grand_livre(){

        }

        // CAS2 on applique une vue qui va regrouper les references de pieces et de chaque date d'ecriture
        

        // Partie suivant on va appliquer la balance des comptes
            // Somme_Debit et Somme_Credit ainsi que solde pour chaque compte 
            

        // READ THE XLS FILES 
        public function readFls($name){
            $this->load->library('Spreadsheet');
            $this->spreadsheet->load('your_excel_file.xls');
            $data = $this->spreadsheet->getData();
            return $data;
        }

        public function selectData_Tier($id){
            $req = "select * from v_compte_tier_alldetail where id=%s";
            $req = sprintf($req, $id);
            $request = $this->db->query($req);
            $linedata = $request->row_array();
            return $linedata;
        }
        public function selectDevise_($id,$montant){
            $req = "select * from devise where id=%s";
            $req = sprintf($req, $id);
            $request = $this->db->query($req);
            $linedata = $request->row_array();
            $devise_val = $linedata['taux'];
            if( $linedata['nomdevise'] == "Ariary" ){
                return "".$montant."";
            }
            else{
                return "".$montant*$devise_val."";
            }
            return 0;
        }

        
    }
        

?>