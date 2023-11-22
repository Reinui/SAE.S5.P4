<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Modifier un récit</title> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    
    <div class="contentAjout">
           <form action="<?= site_url('Modif/ModifRecit?idR='.$_GET['idR']) ?>" method="post">
           <label>Nom du récit :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="nomR" id="nomR" type="text" value="'. $elt['titre'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
           <label>Nom de l'esclave :</label>
           <select name="idE" id="idE">
                    <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            if ($elt['id_auteur'] == $_GET['esc']){
                                echo '<option value="' . $elt['id_auteur'] . '"selected>' . $elt['nom'] . ' </option>'; 
                            } else {
                                echo '<option value="' . $elt['id_auteur'] . '">' . $elt['nom'] . ' </option>';
                            }
                        }  
                    }
                    ?>
                </select><br><br>

           <label>Lieu de publication :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="lieuP" id="lieuP" type="text" value="'. $elt['lieu_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
           

           <label>Année de publication :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="dateP" id="dateP" type="number" min="0" max="2100" value="'. $elt['date_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label>Type de récit :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="typeR" id="typeR" type="text" value="'. $elt['lieu_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Préface existante :</label>
           <?php
           if (!empty($title) && is_array($title)) {
            foreach ($title as $elt) {
                if ($elt['id_recit'] == $_GET['idR']){
                    if ($elt['preface_blanc'] == "oui"){
                        echo '<select name="prefD" id="prefD">
                                <option value="non">Non</option>
                                <option value="oui" selected>Oui</option>
                                <option value="nonVerif">Non vérifiable</option>
                            </select> <br><br>';
                    } elseif ($elt['preface_blanc'] == "non"){
                        echo '<select name="prefD" id="prefD">
                                <option value="non"selected>Non</option>
                                <option value="oui">Oui</option>
                                <option value="nonVerif">Non vérifiable</option>
                            </select> <br><br>';
                    } else {
                        echo '<select name="prefD" id="prefD">
                                <option value="non">Non</option>
                                <option value="oui">Oui</option>
                                <option value="nonVerif" selected>Non vérifiable</option>
                            </select> <br><br>';
                    }
                }
            }
        }
            ?>
           <label>Détails de la préface :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="prefD" id="prefD" type="text" value="'. $elt['details_preface'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label>Commentaires / Historiographie :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="com" id="com" type="text" value="'. $elt['historiographie'] .'"/><br><br>';
                            }
                        }
                    }
            ?>

           <label>Mode de publication :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="modeP" id="modeP" type="text" value="'. $elt['mode_publi'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
          <!--<label>Date de naissance :</label>
           <input name="dateN" id="dateN" type="date" /><br><br> -->

           <label>Nom du scribe/écrivain :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="nomS" id="nomS" type="text" value="'. $elt['scribe_editeur'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <label>Lien vers le récit :</label>
           <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            if ($elt['id_recit'] == $_GET['idR']){
                            echo '<input name="lienR" id="lienR" type="text" value="'. $elt['lien_recit'] .'"/><br><br>';
                            }
                        }
                    }
            ?>
        
           <button type="submit">Modifier</button>
        </form>
</body>
</html>
