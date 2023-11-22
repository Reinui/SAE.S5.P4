<!DOCTYPE html>
<html lang="fr">

<?php
$model = new \App\Models\ModelGetPoints();
$lastPoint = $model->getLastPoint();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un Point</title>
    <!-- Ajout du css pour la carte leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
    <!-- Ajout du js pour la carte leaflet -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
<div class="login-container">

        <h2>Ajout d'un Point</h2>
        <form action="<?= site_url('Ajout/InsertPoint') ?>" method="post">
            <div class="input-group">
                <label for="coord">Coordonnées</label>
                <input type="text" id="coord" name="coord" required>
            </div>
            <div class="input-group">
                <label for="ville">ville</label>
                <input type="ville" id="ville" name="ville" required>
            </div>
            <div class="input-group">
                <label for="type">Type de point:</label>
                <select name="type" id="type">
                    <option value="naissance">Naissance</option>
                    <option value="publication">Publication</option>
                    <option value="deces">Décée</option>
                    <option value="esclavage">Esclavage</option>
                    <option value="lieuvie">Lieu de Vie</option>
                </select>
            </div>
            <div class="input-group">
                <label for="recit">Joindre a un Récit:</label>
                <select name="recit" id="recit">
                    <?php
                    if (!empty($title) && is_array($title)) {
                        foreach ($title as $elt) {
                            //$Licoord = explode(',',$elt['titre']);
                            echo '<option value="' . $elt['id_recit'] . '">' . $elt['nom_esc'] . ' (' . $elt['date_publi'] . ')</option>';
                        }
                    }


                    ?>
                </select>
            </div>
            <div class="input-group">
                <label for="point">Id du Recit</label>
                <?php
                echo '<input type="text" id="point" name="point" value="' . $lastPoint . '">';
                ?>
            </div>
                
            <button type="submit">Terminer</button>
        </form>
    </div>
    <!-- Div de la map -->
    <div id="map" style="width: 100%; height: 500px;"></div>
   
    <!-- Script pour gérer la carte et récupérer les coordonnées -->
    <script>
        //le setView possède ces valeurs pour avoir une vue d'ensemble des tous les continents sur la carte
        var map = L.map('map').setView([0, 0], 1);
        
        //Référence et configuration de la carte
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        //Variable d'affectation qui servira dans la fonction ci-dessous
        var coordInput = document.getElementById("coord");
        
        //Méthode qui permet d'ajouter les coordonées dans la zone de texte souhaité suite à un clic sur la carte
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            //En suivant la norme ISO 6709 => l'ordre est latitude et longitude
            var coordValue = lat + ','  + lng;
            //Ajout des valeurs dans la zone de texte "Coordonées" suuite au clic
            coordInput.value = coordValue;
        });
    </script>
</body>

</html>