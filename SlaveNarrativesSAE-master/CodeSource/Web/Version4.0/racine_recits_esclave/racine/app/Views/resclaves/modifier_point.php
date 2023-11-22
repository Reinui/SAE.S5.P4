<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('modif_point.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="container">
        <div class="login-container">
            <h2><?= lang('modif_point.title') ?></h2>
            <form action="<?= site_url('Ajout/modificationPoint') ?>" method="post">
                <div class="input-group">
                    <label for="coord"><?= lang('modif_point.coordinates') ?></label>
                    <input type="text" id="coord" name="coord" value="<?php echo htmlspecialchars($coord); ?>" required>
                </div>
                <div class="input-group">
                    <label for="ville"><?= lang('modif_point.city') ?></label>
                    <input type="ville" id="ville" name="ville" <?php echo "value=" . htmlspecialchars($ville) . "" ?> required>
                </div>
                <div class="input-group">
                    <label for="type"><?= lang('modif_point.type') ?></label>
                    <select name="type" id="type">
                        <option value="naissance"><?= lang('modif_point.types.birth') ?></option>
                        <option value="publication"><?= lang('modif_point.types.publication') ?></option>
                        <option value="deces"><?= lang('modif_point.types.death') ?></option>
                        <option value="esclavage"><?= lang('modif_point.types.slavery') ?></option>
                        <option value="lieuvie"><?= lang('modif_point.types.location_life') ?></option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="recit"><?= lang('modif_point.attach_narrative') ?></label>
                    <select name="recit" id="recit">
                        <?php
                        if (!empty($title) && is_array($title)) {
                            foreach ($title as $elt) {
                                if ($elt['id_recit'] == $id_recit) {
                                    //$Licoord = explode(',',$elt['titre']);
                                    echo '<option value="' . $elt['id_recit'] . '" selected>' . htmlspecialchars($elt['nom_esc']) . ' (' . htmlspecialchars($elt['date_publi']) . ')</option>';
                                } else {
                                    echo '<option value="' . $elt['id_recit'] . '">' . htmlspecialchars($elt['nom_esc']) . ' (' . htmlspecialchars($elt['date_publi']) . ')</option>';
                                }
                            }
                        }


                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <!-- champ caché -->
                    <input type="hidden" id="id_point" name="id_point" <?php echo 'value="' . htmlspecialchars($id_point) . '"' ?>>
                </div>
                <a class="retour" href="<?= site_url('/map') ?>"><?= lang('recits.bouton_retour') ?></a></p>
                <button type="submit"><?= lang('modif_point.modify_point_button') ?></button>
            </form>
        </div>
        <!-- Div de la map -->
        <div id="mappoint"></div>
    </div>

    <!-- Script pour gérer la carte et récupérer les coordonnées -->
    <script>
    //le setView possède ces valeurs pour avoir une vue d'ensemble des tous les continents sur la carte
    var map = L.map('mappoint').setView([0, 0], 1);

    //Référence et configuration de la carte
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    //Variable d'affectation qui servira dans la fonction ci-dessous
    var coordInput = document.getElementById("coord");
    var villeInput = document.getElementById("ville");

    //Mise du bouton dans une variable pour changer son état (visibilité)
    var submitButton = document.getElementById("submit-button");


    // Ajustez la taille de la zone géographique autour des coordonnées
    var radius = 5.0; // Par exemple, un rayon de 0,01 degré (environ 500 km)


    //Méthode qui permet d'ajouter les coordonées dans la zone de texte souhaité suite à un clic sur la carte
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        //En suivant la norme ISO 6709 => l'ordre est latitude et longitude
        var coordValue = lat + ',' + lng;
        //Ajout des valeurs dans la zone de texte "Coordonées" suite au clic
        coordInput.value = coordValue;

        // Calcul des coordonnées de la zone géographique autour du clic
        var latMin = lat - radius;
        var latMax = lat + radius;
        var lngMin = lng - radius;
        var lngMax = lng + radius;


        //Ajout de l'api qui permettra d'associer la ville au coordonnées
        fetch(
                `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&lat_min=${latMin}&lat_max=${latMax}&lon_min=${lngMin}&lon_max=${lngMax}`
            )
            //Ajout des villes dans le fichier json
            .then(response => response.json())
            .then(data => {
                if (data.address && data.address.city) {
                    var city = data.address.city || data.address.town || data.address.village || data
                        .address.hamlet;
                    // Ajout de la ville dans la zone de texte "Ville"
                    villeInput.value = city;
                    //Réapparition du bouton car tous les éléments sont renseignés
                    submitButton.style.display = "block";
                } else {
                    // Effacer la valeur de la zone de texte "Ville" si aucune ville n'est trouvée
                    villeInput.value = '';

                }
            })
            .catch(error => {
                console.error('Erreur :', error);
                // Effacer la valeur de la zone de texte "Ville" en cas d'erreur
                document.getElementById("ville").value = '';
            });

    });
    </script>
</body>

</html>