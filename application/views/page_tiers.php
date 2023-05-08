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
    <link rel="stylesheet" href="<?php echo site_url("assets/css/tableau.css"); ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/bootstrap/css/bootstrap.min.css");?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/fonts/fontawesome-free-6.3.0-web/css/all.css") ; ?>">
    <title>Code Journal</title>
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


    
    <div class="main-table">  

        <div class="contain-table">
        <h1 class="title"><center>Les plans Tiers</center></h1>
        <a href="#" id="open-popup" onClick="gettext(this)" data-role="ajouter">Ajouter</a>
            <table class="table_to_update" id="my_update_table">

                <tr>
                    <th class="titre">Type</th>
                    <th class="titre">Numéro</th>
                    <th class="titre"><center>Intitulé</center></th>
                    <th class="titre"><center></center></th>
                </tr>

                <?php foreach ($plan_tier as $det){ ?>
                <tr id="<?php echo $det['id']; ?>">
                    <td class="component" id="tooltip" data-target="code_tier">
                        <span  id="code_tier"><a><?php echo $det['code']; ?></a></span>
                        <span  id="idplancompte"><?php echo $det['idplancompte']; ?></span>
                    </td>
                    <td class="component" data-target="intitule_num">
                        <span  id="intitule_num_value"><a id="open-popup" data-role="update" data-id="<?php echo $det['id']; ?>"><?php echo $det['cpt_num_aux']; ?></a></span>
                    </td>
                    <td class="component" data-target="intitule">
                        <span  id="intitule_value"><a id="open-popup" data-role="update" data-id="<?php echo $det['id']; ?>"><?php echo $det['intitule_aux']; ?></a></span>
                    </td>
                    <td class="component">
                        <a onClick="onDelete(this)" data-id="<?php echo $det['id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>
    
    <div class="popup_container">
        <div class="popup">

            <button class="close-btn" onclick=>&times;</button>
            <!-- Modal -->
            <div id="myModal" class="" role="dialog"> 
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Compte Tier :</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="compte" id="">
                                <?php foreach ($plan_comptable_tier as $detail_tier){ ?>
                                    <option value="<?php echo $detail_tier['id'] ?>"><?php echo $detail_tier['plancompta_intitule'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <input type="text" id="codetier" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Numero</label>
                                <input type="text" id="numero" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Intitule</label>
                                <input type="text" id="intitule" class="form-control">
                            </div>
                            <input type="hidden" id="userId" class="form-control">
                            <input type="hidden" id="usercpt_collectif" class="form-control">
                        </div>
                        <div class="modal-footer" id="champ_button">
                            <!-- BUTTON dynamique -->
                        </div>
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
    <script  src="<?php echo site_url("assets/js/setting2.js")?>"></script>
</html>