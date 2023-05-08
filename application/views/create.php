<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/style.css") ; ?>">
    <title>Creer,Formaliser,Immatriculer</title>
</head>
<body>
    <div class="container">
        <div class="form_head">
            <span class="title"><h4>Completer les informations pour votre societe</h4></span>
            <a href="InsertionCI">Inscription dirigeant</a>
            <a href="Control">Acceuil</a>
        </div>
        <div class="form_body">
            <form action="InsertionCI/process" method="post">
                <input type="hidden" name="status" value="SOCIETE">
                <div class="champ">
                    <!--1 NOM -->
                    <label for="">Label</label>
                        <input type="text" name="nom" placeholder="Mon entreprise" required>
                </div>  
                <div class="champ">
                    <!--2 Objet -->
                    <label for="">Votre activité</label>
                    <textarea name="objet" cols="30" rows="3" placeholder="A quel fin ?" required></textarea>
                </div>
                <!--3 PATRON à Ajouter apres confirmation des informations -->
                <!--4 DATE DE CREATION NOW -->
                <div class="champ">
                    <!--5 capital -->
                    <label for="">Capital</label>
                    <input type="text" name="capital" placeholder="capital" required>
                </div>
                <div class="champ">
                    <label for="">DG</label>
                    <select name="dg" required>                    
                    <?php $k = 0;
                    foreach ($person as $per){ ?>
                        <option value="<?php echo $per['id']?>"><?php echo $per['namelead'];?></option>
                    <?php $k++; } ?>
                    </select>
                </div>
                <div class="champ">
                    <!--10 creation -->
                    <label for="">Date de création</label>
                    <input type="date" name="creation" required>
                </div>
                <div class="champ">
                    <!--7 siege-->
                    <label for="">Siège</label>
                    <input type="text" name="siege" placeholder="adress" required>
                </div>
                <div class="champ">
                    <!--6 Nombre de mpiasa -->
                    <label for="">Nombre d'employées</label>
                    <input type="number" name="emptotal" placeholder="Combien d/'employées au total" required>
                </div>
                <div class="champ">
                    <!--10 datedebut -->
                    <label for="">Debut d'activité</label>
                    <input type="date" name="datedebut" required>
                </div>
                <div class="champ">
                    <!--11 devise1 -->
                    <label for="">Devis Courant</label>
                    <select name="devisetenu" required>
                    <?php $k = 0;
                        foreach ($devise as $dev){ ?>
                        <option value="<?php echo $dev['id']?>"><?php echo $dev['nomdevise'];?></option>
                    <?php $k++; } ?>
                    </select>
                </div>
                <div class="gender-detail">
                    <input type="hidden" name="hide" value="ok">
                    <span class="gender-title">Devis de reference</span>

                    <?php $k = 0; 
                    foreach ($devise as $dev){  ?>
                        <input type="checkbox" value="<?php echo $dev['id'];?>" name="dev_<?php echo $dev['id'];?>" id="dot-<?php echo ($k+1)?>">
                    <?php $k++; } ?>

                    <div class="categorie">
                        <?php $k = 0;
                        foreach ($devise as $dev){ ?>
                        <label for="dot-<?php echo ($k+1)?>">
                            <span class="dot dot-<?php echo ($k+1)?>"></span>
                            <span class="genre"><?php echo $dev['nomdevise'];?></span>
                        </label>
                        <?php $k++; } ?>
                    </div>
                </div>
                <div class="champ btn">
                    <button type="submit">ENREGISTRER</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>