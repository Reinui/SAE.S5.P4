<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Supprimer esclave/auteur</title> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    
    <div class="contentAjout">
           <form action="<?= site_url('Suppr/SupprAuteur') ?>" method="post">
        
           <label>Nom de l'esclave  que vous voulez supprimer:</label>
           <select name="idE" id="idE" required>
                    <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            echo '<option value="' . $elt['id_auteur'] . '">' . $elt['nom'] . ' </option>';
                        }  
                    }
                    ?>
                </select><br><br>
        
           <button type="submit" onclick="return confirm('Êtes vous sûr ?')">Supprimer</button>
        </form>
</body>
</html>
