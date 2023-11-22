<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('ajout_poly.title') ?>
    <title><?= $page_name ?></title>
    <!-- Ajout du CSS pour la carte Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="container">
        <div class="poly-container">
            <h2><?= lang('ajout_poly.title') ?></h2>
            <form action="<?= site_url('Ajout/InsertPoly') ?>" method="post">
                <div class="input-group">
                    <label for="nom_poly"><?= lang('ajout_poly.poly_name') ?></label>
                    <input type="text" id="nom_poly" name="nom_poly" required>
                </div>
                <div class="input-group">
                    <div class="scrollable-table">
                        <table id="exa" class="display" style="width:100%;">
                            <thead>
                                <tr>
                                    <th><?= lang('ajout_poly.point') ?></th>
                                    <th style="position: relative; width: 30%;"><?= lang('ajout_poly.suppr') ?></th>
                                </tr>
                            </thead>
                            <tbody id="coordonneesTable">
                                <!-- Les coordonnées seront ajoutées ici -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Ajoutez un champ de formulaire caché pour les coordonnées -->
                <input type="hidden" name="coordonnees" id="coordonneesInput">

                <a class="retour" href="<?= site_url('/map') ?>"><?= lang('recits.bouton_retour') ?></a></p>
                <button type="submit" id="submit-button"><?= lang('ajout_poly.add_poly_button') ?></button>
            </form>
        </div>

        <!-- Div de la carte -->
        <div class="map-container" id="map"></div>
    </div>

    <!-- Script pour gérer la carte et ajouter les coordonnées au tableau -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
    var map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    var coordonnees = []; // Tableau pour stocker les coordonnées
    var polyline; // Variable pour stocker la polyline

    // Fonction pour gérer les clics sur la carte
    function onClick(e) {
        var latlng = e.latlng;
        var lat = latlng.lat;
        var lng = latlng.lng;

        coordonnees.push(latlng);

        // Créez une nouvelle ligne pour le tableau
        var newRow = document.createElement("tr");

        // Créez une cellule pour les coordonnées
        var coordCell = document.createElement("td");
        coordCell.textContent = lat + ", " + lng;

        // Créez une cellule pour le bouton de suppression
        var deleteCell = document.createElement("td");
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Supprimer";
        deleteButton.onclick = function() {
            // Supprimez la ligne lorsque le bouton est cliqué
            var row = this.parentNode.parentNode;

            // Supprimez également le cercle de la carte
            map.removeLayer(row.circleMarker);

            // Supprimez les coordonnées du tableau
            var index = coordonnees.indexOf(row.latlng);
            if (index !== -1) {
                coordonnees.splice(index, 1);
            }

            row.parentNode.removeChild(row);

            var coordonneesInput = document.getElementById('coordonneesInput');
            coordonneesInput.value = JSON.stringify(coordonnees);

            // Mettez à jour la polyline ou la ligne en conséquence
            updatePolyline();
        };

        deleteCell.appendChild(deleteButton);

        var coordonneesInput = document.getElementById('coordonneesInput');
        coordonneesInput.value = JSON.stringify(coordonnees);

        // Ajoutez les cellules à la ligne
        newRow.appendChild(coordCell);
        newRow.appendChild(deleteCell);

        // Ajoutez la ligne au tableau
        document.getElementById("coordonneesTable").appendChild(newRow);

        // Après avoir ajouté un point au tableau
        // Scrollez vers le bas pour afficher le nouveau point ajouté
        var scrollableTable = document.querySelector('.scrollable-table');
        scrollableTable.scrollTop = scrollableTable.scrollHeight;

        // Ajoutez un cercle sur la carte (CircleMarker)
        var circleMarker = L.circleMarker([lat, lng]).addTo(map);
        newRow.circleMarker = circleMarker; // Associez le cercle à la ligne

        // Mettez à jour la polyline ou la ligne en conséquence
        updatePolyline();

        newRow.latlng = latlng; // Associez les coordonnées à la ligne
    }

    function updatePolyline() {
        // Si le tableau coordonnees a plus de 2 points, créez ou mettez à jour le polygone
        if (coordonnees.length >= 2) {
            if (polyline) {
                map.removeLayer(polyline); // Supprimez la polyline existante
            }

            var latlngs = coordonnees.map(function(coord) {
                return [coord.lat, coord.lng];
            });

            if (latlngs.length === 2) {
                // Si vous avez exactement deux points, créez une ligne (polyline)
                polyline = L.polyline(latlngs, {
                    color: 'blue'
                }).addTo(map);
            } else {
                // Sinon, créez un polygone
                polyline = L.polygon(latlngs, {
                    color: 'blue'
                }).addTo(map);
            }
        } else if (polyline) {
            map.removeLayer(polyline); // Supprimez la polyline s'il existe mais a moins de 2 points
        }
    }

    map.on('click', onClick);
    </script>
</body>

</html>