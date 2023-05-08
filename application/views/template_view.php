<h4>Bonjour <?php echo $pseudo; ?></h4>
<h5>Votre nom de session: <?php echo $this->session->nom ?></h5>
    <p>
        Votre mail <?php echo $email; ?>
    </p>
        <p>
            <?php if($en_ligne): ?>
                Vous etes en ligne.
            <?php endif; ?>
        </p>

<h4>Test a partir du model</h4>
<p>Votre information : <?php echo $user_info[0]['nom'] ?></p>
<p>Deuxieme email <?php echo $user_info[0]['pwd'] ?></p>
<p>Date naissance <?php echo $user_info[0]['email'] ?></p>