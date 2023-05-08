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

    <!-- NEW TABLE DATA  -->
    <div class="main_table">
        <section class="table__header">
            <h1>Les codes Journaux</h1>
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
                    <tr>
                        <th class="titre">Code</th>
                        <th class="titre">Intitulé du Journaux</th>
                        <th class="titre"><center></center></th>
                    </tr>
                </thead>
                <tbody id="uptable">
                <?php foreach ($code_jrn as $code){ ?>
                    <tr id="<?php echo $code['id']; ?>">
                        <td class="component" id="tooltip" data-target="code_jrn">
                            <span  id="code_jrn"><a><?php echo $code['code']; ?></a></span>
                        </td>                    
                        <td class="component" data-target="intitule">
                            <!-- data-role is to acces in jquery -->
                            <span  id="intitule_value"><a id="open-popup" onClick="gettext(this)" data-role="update" data-id="<?php echo $code['id']; ?>"><?php echo $code['intitule']; ?></a></span>
                        </td>
                        <td class="component">
                            <a onClick="onDelete(this)" data-id="<?php echo $code['id']; ?>">
                                <div class="img_">
                                    <img class="img_del" src="<?php echo site_url("assets/fonts/icon/del.png"); ?>" alt="Delete">
                                </div>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
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
    <script  src="<?php echo site_url("assets/js/setting.js")?>"></script>
</html>