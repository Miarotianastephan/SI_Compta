<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/person.css") ; ?>">
    <title>Inscrire mon dirigeant</title>
</head>
<body>
    <form action="InsertionCI/process" method="post">
    <input type="hidden" name="status" value="DIR">
    <div class="container-champ">
        <div class="prim-container">
            <p><center><h2>Le Dirigeant</h2></center></p>
            <div class="left-container">
                <p><div ><input class="label-content" type="text" name="namelead" id="" placeholder="Nom"></div></p>
                <p><div ><input class="label-content" type="text" name="adress" id="" placeholder="Adresse"></div></p>
                <p><div ><input class="label-content" type="text" name="phone" id="" placeholder="Phone"></div></p>
                <p><div ><input class="label-content" type="email" name="email" id="" placeholder="E-mail"></div></p>
                <p><div><input type="submit" class="button" value="INSERER"></div></p>
            </div>
            <div class="rigth-container">
                <div class="img-content">
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
