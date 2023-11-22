<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajout récit</title> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    
    <div class="contentAjout">
           <form action="<?= site_url('Ajout/InsertRecit') ?>" method="post">
           <label>Nom du récit :</label>
           <input name="nomR" id="nomR" type="text" /><br><br>
        
           <label>Nom de l'esclave :</label>
           <select name="idE" id="idE">
                    <?php
                    if (!empty($auteurs) && is_array($auteurs)) {
                        foreach ($auteurs as $elt) {
                            echo '<option value="' . $elt['id_auteur'] . '">' . $elt['nom'] . ' </option>';
                        }  
                    }
                    ?>
                </select><br><br>

           <label>Lieu de publication :</label>
           <input name="lieuP" id="lieuP" type="text" /><br><br>

           <!--<label>Information supplémentaire :</label>
           <input name="infoSup" id="infoSup" type="text" /><br><br>-->

           <label>Année de publication :</label>
           <input name="dateP" id="dateP" type="date" /><br><br>
        
           <label>Type de récit :</label>
           <input name="typeR" id="typeR" type="text" /><br><br>

           <label>Préface existante :</label>
           <select name="prefD" id="prefD">
                    <option value="non">Non</option>
                    <option value="oui">Oui</option>
                    <option value="nonVerif">Non vérifiable</option>
                </select> <br><br>

           <label>Détails de la préface :</label>
           <input name="pref" id="pref" type="text" /><br><br>
        
           <label>Commentaires / Historiographie :</label>
           <input name="com" id="com" type="text" /><br><br>

           <label>Mode de publication :</label>
           <input name="modeP" id="modeP" type="text" /><br><br>
        
          <!--<label>Date de naissance :</label>
           <input name="dateN" id="dateN" type="date" /><br><br> -->

           <label>Nom du scribe/écrivain :</label>
           <input name="nomS" id="nomS" type="text" /><br><br>
        
           <label>Lien vers le récit :</label>
           <input name="lienR" id="lienR" type="text" /><br><br>
        
           <button type="submit">Ajouter</button>
        </form>
</body>
</html>
