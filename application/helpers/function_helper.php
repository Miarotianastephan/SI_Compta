<?php
// security
defined('BASEPATH') OR exit('No direct script access allowed');
// ---         

    function verif_login($nom = '',$pass = '',$tab){
        $value = 0;
        for( $i=0; $i < count($tab); $i++ ){
            echo $tab[$i]['email'];
            if( ($nom == $tab[$i]['email']) && ($pass == $tab[$i]['pwd'])   ){
                $value = 1;//mety
                return $value;
            }
        }return $value=0;
    }

?>