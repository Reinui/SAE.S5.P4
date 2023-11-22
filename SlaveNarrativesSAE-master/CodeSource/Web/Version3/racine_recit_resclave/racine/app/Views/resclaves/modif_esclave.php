<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajout esclave</title> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>


    <div class="contentAjout">
           <form action="<?= site_url('Modif/ModifAuteur') ?>" method="post">
           <label>Nom de l'esclave :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="nomE" id="nomE" type="text" value="'. $elt['nom'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label>Année de naissance :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="anneeN" id="anneeN" type="text"  value="'. $elt['naissance'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Lieu de naissance :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuN" id="lieuN" type="text" value="'. $elt['lieu_naissance'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Année de décès :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="dateD" id="dateD" type="text" value="'. $elt['deces'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label>Lieu de décès :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuD" id="lieuD" type="text" value="'. $elt['lieu_deces'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Lieu d'esclavage :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuE" id="lieuE" type="text" value="'. $elt['lieu_esclavage'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Moyen de libération :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="moy" id="moy" type="text" value="'. $elt['moyen_lib'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Lieu de vie après la libération :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="lieuV" id="lieuV" type="text" value="'. $elt['lieuvie_ap_lib'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Origine des parents :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="origP" id="origP" type="text" value="'. $elt['origine_parents'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label>Militant abolitionniste :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="mil" id="mil" type="text" value="'. $elt['militant_abolitionniste'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Particularités :</label>
           <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $auteur){
                            echo '<input name="part" id="part" type="text" value="'. $elt['particularites'] .'" required/><br><br>';
                            }
                        }
                    }
            ?>

            <?php
            echo '<input name="idE" id="idE" type="hidden" value="'. $auteur .'" required/><br><br>';
            ?>
        
           <button type="submit">Modifier</button>
        </form>
</body>
</html>
