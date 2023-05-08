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
                <li><a href="#"><i class="fa fa-sign-out"></i> Sign-out</a></li>         
            </ul>
        </div>
        <div class="menu-hamburger">
            <p>Menu</p>
            <img src="<?php echo site_url("assets/fonts/icon/menu_FILL0_wght400_GRAD0_opsz48.svg"); ?>" alt="">
        </div>
    </nav>

    <header>
    </header>


    
    <h1 class="title"><center>test</center></h1>
    
    <div class="contain-table">
        <table border="1">
            <thead>
                <tr>
                    <th class="titre" width="100">Selectionner</th>
                    <th class="titre" width="100">Validation</th>
                </tr>
            </thead>
            <tbody>
                <form action="<?php echo site_url("Redir?var="); ?>" method="get">
                    <tr>
                        <td class="titre" width="100"><input type="file"></td>
                        <td class="titre" width="100"><input type="submit">Valider</button></td>
                    </tr>
                </form>
            </tbody>
        </table>
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