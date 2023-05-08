<?php
// security
defined('BASEPATH') OR exit('No direct script access allowed');
// --- 
$info_princ_societe = $societe[0];
$info_dirigeant = $v_societe_dirigeant[0];
$info_devise = $v_societe_deviseref;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/style_acc.css") ; ?>">
    <link rel="stylesheet" href="<?php echo site_url("assets/fonts/fontawesome-free-6.3.0-web/css/all.css") ; ?>">
    <title>Information Société</title>
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



    <div class="contents">

        <!-- information 1: principale -->
        <div class="card">
            <div class="card-header">
                <h3><?php echo $info_princ_societe['soc_name'];?></h3>
                <p><?php echo $info_princ_societe['soc_adresse'];?></p>
                <p><small>
                    <p>Distinction social : </p>
                    <?php echo $info_princ_societe['soc_objet'];?>
                    </small>
                </p>
            </div>

            <div class="card-img">
                <img src="<?php echo site_url("assets/image/acc.jpg");?>" alt="">
            </div>

            <div class="card-details">
                <div class="price">
                    <p>Fond d'investissement</p>
                    <p><?php echo $info_princ_societe['capital'];?></p>
                </div>
                <div class="colors">

                </div>
            </div>
        </div>
        <!-- fin 1 -->
        <!-- information 2: dir et date -->
        <div class="card">
            <div class="card-header">
                <h3>Informations supll</h3>
                
                <p><a href="#?detail_dir=0">Dirigée par: <?php echo $info_dirigeant['namelead'] ?></a></p>
                <p>Crée le: <?php echo $info_princ_societe['soc_creationdate'];?></p>
                <p><small>Date d'exercice courant: <?php echo $info_princ_societe['datedebut'];?></small></p>
            </div>

            <div class="card-img">
                <img src="<?php echo site_url("assets/image/jaune.jpg");?>" alt="">
            </div>

            <div class="card-details">
                <div class="price">
                    <p>NIF:</p>
                    <p>STAT:</p>
                    <p>RCS:</p>
                </div>
                <div class="colors">
                </div>
            </div>
        </div>
        <!-- fin 2 -->
        <!-- information 3: chiffre -->
        <div class="card">
            <div class="card-header">
                <h3>A propos des devises</h3>
                <p>Devise de tenue de compte:</p>
                <span><?php echo $info_princ_societe['nomdevise'];?></span>
            </div>

            <div class="card-img">
                <img src="<?php echo site_url("assets/image/devise.jpg");?>" alt="">
            </div>

            <div class="card-details">
                <div class="price">
                    <p>Devises de réferences:</p>
                </div>
                <div class="colors">
                    <?php for( $i=0; $i < count($info_devise); $i++ ){ ?>
                        <p> 1 <?php echo $info_devise[$i]['nomdevise'];?> : <?php echo $info_devise[$i]['taux'];?> Ar</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- fin 3 -->
        <!-- info 4: Lien docs telechargeables -->
        <div class="card">
            <div class="card-header">
                <h3>Les documents téléchargeables</h3>
                <p><a href="">Logo</a></p>
                <p><a href="">Scan d'images</a></p>
            </div>
        </div>
    </div>
</body>
    <script>
        const menuHamburger = document.querySelector(".menu-hamburger");
        const navLinks = document.querySelector(".nav-links");
        menuHamburger.addEventListener("click", ()=>{
            navLinks.classList.toggle("mobile-menu")
        })
    </script>
</html>