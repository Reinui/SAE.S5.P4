<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajout esclave</title> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>
<body>
    <div class="contentAjout">
           <form action="<?= site_url('Ajout/InsertAuteur') ?>" method="post">
           <label>Nom de l'esclave :</label>
           <input name="nomR" id="nomR" type="text" required/><br><br>
        
           <label>Année de naissance :</label>
           <input name="anneeN" id="anneeN" type="number" min="0" max="2030" required/><br><br>

           <label>Lieu de naissance :</label>
           <input name="lieuN" id="lieuN" type="text" required/><br><br>

           <label>Année de décès :</label>
           <input name="dateD" id="dateD" type="text" required/><br><br>
        
           <label>Lieu de décès :</label>
           <input name="lieuD" id="lieuD" type="text" required/><br><br>

           <label>Lieu d'esclavage :</label>
           <input name="lieuE" id="lieuE" type="text" required/><br><br>

           <label>Moyen de libération :</label>
           <input name="moy" id="moy" type="text" required/><br><br>

           <label>Lieu de vie après la libération :</label>
           <input name="lieuV" id="lieuV" type="text" required/><br><br>

           <label>Origine des parents :</label>
           <input name="origP" id="origP" type="text" required/><br><br>
        
           <label>Militant abolitionniste :</label>
           <input name="mil" id="mil" type="text" required/><br><br>

           <label>Particularités :</label>
           <input name="part" id="part" type="text" required/><br><br>
        
           <button type="submit">Ajouter</button>
        </form>
</body>
</html>
