<?php
// security
defined('BASEPATH') OR exit('No direct script access allowed');
// --- 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/style_acc.css") ; ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/table.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/fonts/fontawesome-free-6.3.0-web/css/all.css") ; ?>">
    <title>Ecriture Journal</title>
</head>
<body>

    <nav class="navbar_perso">
        <a href="" class="logo"><img src="<?php echo site_url(""); ?>" alt="LOGO"></a>
        <div class="nav-links">
            <ul>
                <li class="activ"><a href="<?php echo site_url("Redir?var="); ?>"><i class="fas fa-home-lg-alt"></i> Acceuil</a></li>
                <li><a href="<?php echo site_url("Redir?var=load_jrn"); ?>"><i class="fa fa-list-alt"></i> Code journal</a></li>
                <li><a href="<?php echo site_url("Redir?var=load_compta"); ?>"><i class="fa fa-exchange"></i> Plan Comptable</a></li>
                <li><a href="<?php echo site_url("Redir?var=load_tier"); ?>"><i class="fa fa-add"></i> Plan Compte des Tiers</a></li>
                <li><a href="<?php echo site_url("Redir?var=load_ecriture"); ?>"><i class="fa fa-sign-out"></i> Ecriture Journaux</a></li>  
            </ul>
        </div>
        <div class="menu-hamburger">
            <p>Menu</p>
            <img src="<?php echo site_url("assets/fonts/icon/menu_FILL0_wght400_GRAD0_opsz48.svg"); ?>" alt="">
        </div>
    </nav>

    <header>
    </header>

    <div class="main_table">
        <section class="table__header">
            <h1>Ecriture Journaux</h1>
            <a id="open-popup" onClick="gettext(this)" data-role="ajouter">
                <div class="img_">
                    <span class="img_text">Ajouter</span>
                    <img class="img_ajout" src="<?php echo site_url("assets/fonts/icon/insertrow.png"); ?>" alt="">
                </div>
            </a>
        </section>
        <section class="table__body">
            <table class="table_to_update">
                <thead>
                <!-- Champ d'ajout ecriture -->
                    <tr id="fill_info">
                        <th class="titre" ></th>
                        <th class="titre" ><input type="number" name="idjournaux" id="idjournaux"></th>
                        <th class="titre" ><input type="date" name="date" id="date"></th>
                        <th class="titre" > 
                            <select name="codepiece" id="codepiece">
                                <?php foreach ($codage_piece as $piece) { ?>
                                    <option value="<?php echo $piece['references_piece']?>"><?php echo $piece['signification']?></option>
                                    <?php } ?>
                            </select>
                            <span id="select_codepiece">Code piece</span>
                            <input type="text" name="libpiece" id="libpiece">
                        </th>
                        <th class="titre" >
                            <select name="compte_gen" id="compte_gen">
                                <option value="">Aucun</option>
                            <?php foreach ($pcg as $p) { ?>
                                <option value="<?php echo $p['id'] ?>"><?php echo $p['numerocompte'] ?>:<?php echo $p['intitule'] ?></option>
                            <?php } ?>
                            </select>
                        </th>
                        <th class="titre" >                            
                            <select name="compte_tier" id="compte_tier">                            
                                <option value="">Aucun</option>
                            <?php foreach ($tier_detail as $compteTier) { ?>
                                <option value="<?php echo $compteTier['id'] ?>"><?php echo $compteTier['cpt_num_aux'] ?></option>
                            <?php } ?>
                            </select>
                        </th>
                        <th class="titre" ><input type="text" name="libelle" id="libelle"></th>
                        <th class="titre" >
                            <select name="devise" id="devise">
                                <option value="1">EURO</option>
                                <option value="2">ARIARY</option>
                            </select>
                        </th>
                        <th class="titre" ><input type="number" name="debit" id="debit"></th>
                        <th class="titre" ><input type="nmuber" name="credit" id="credit"></th>
                        <th class="titre" ></th>        
                    </tr>
                    <!--  -->
                    <tr>
                        <th class="titre" >ID</th>
                        <th class="titre" >ID journaux</th>
                        <th class="titre" >Date ecriture</th>
                        <th class="titre" >Numero Piece</th>
                        <th class="titre" >ID Compte General</th>
                        <th class="titre" >ID Compte Tier</th>
                        <th class="titre" >Libelle</th>
                        <th class="titre" >ID Devise</th>
                        <th class="titre" >Debit</th>
                        <th class="titre" >Credit</th>
                        <th class="titre" >Type</th>        
                    </tr>
                </thead>
                <tbody id="uptable">            
                    <tr>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                        <td class="component" >1</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    <!-- FIN NEW TABLE -->

    <div class="popup_container">

        <div class="popup">
            <button class="close-btn" onclick=>&times;</button>
            <!-- Modal -->
            <div id="myModal" class="" role="dialog"> 

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Code Journal:</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Code</label>
                                <input type="text" id="codejrn" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Libele</label>
                                <input type="text" id="intitule" class="form-control">
                            </div>
                            <input type="hidden" id="userId" class="form-control">
                        </div>
                        <div class="modal-footer" id="champ_button">
                            <!-- BUTTON dynamique -->
                            <!-- <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                            <button id="insert" class="btn btn-default perso_action">Perso</button> -->
                        </div>
                    </div>
            </div>

        </div>
        
    </div>
    
    

</body>
    <script>
        var base_url = "<?php echo site_url();?>";
    </script>
    <script src="<?php echo site_url("assets/js/popup.js")?>"></script>
    <script src="<?php echo site_url("assets/js/jquery.min.js")?>"></script>
    <script  src="<?php echo site_url("assets/js/setecriture.js")?>"></script>
</html>