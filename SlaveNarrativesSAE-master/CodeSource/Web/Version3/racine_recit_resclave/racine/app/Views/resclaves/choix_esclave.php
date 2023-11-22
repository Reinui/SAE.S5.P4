<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Choix modification esclave/auteur</title> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    
    <div class="contentAjout">
           <form action="<?= site_url('/modif_esclave') ?>" method="post">
        
           <label>Nom de l'esclave que vous voulez modifier:</label>
           <select name="idE" id="idE" required>
                    <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            echo '<option value="' . $elt['id_auteur'] . '">' . $elt['nom'] . ' </option>';
                        }  
                    }
                    ?>
                </select><br><br>
        
           <button type="submit">Modifier</button>
        </form>
</body>
</html>
