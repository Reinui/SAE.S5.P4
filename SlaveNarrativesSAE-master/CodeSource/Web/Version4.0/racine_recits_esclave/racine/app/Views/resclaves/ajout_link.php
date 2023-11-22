<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('ajout_link.title') ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_ajout_link.css'); ?>">
</head>

<body>
    <div id="page">
        <div id='block1'>
            <form id="form1" class="form" action="#" method="post">
                <h2><?= lang('ajout_link.tab1') ?></h2>
                <label for="champ1"><?= lang('ajout_link.tab1_ch1') ?></label>
                <input type="text" id="champ1" name="champ1"><br>
                <label for="champ2"><?= lang('ajout_link.tab1_ch2') ?></label>
                <input type="text" id="champ2" name="champ2"><br><br>
                <a class="retour" href="<?= site_url('/recits') ?>"><?= lang('recits.bouton_retour') ?></a></p>
                <button type="button" id="addLinkButton"><?= lang('ajout_link.tab1_add') ?></button>
            </form>
        </div>
        <div id='block2'>
            <form id="form2" class="form" action="<?= site_url('Ajout/InsertLink') ?>" method="post">
                <h2><?= lang('ajout_link.tab2') ?></h2>
                <table>
                    <thead>
                        <tr>
                            <th><?= lang('ajout_link.tab2_name') ?></th>
                            <th><?= lang('ajout_link.tab2_link') ?></th>
                            <th style="position: relative; width: 30%;"><?= lang('ajout_poly.suppr') ?></th>
                        </tr>
                    </thead>
                    <tbody id="linkTable">
                        <!-- Les coordonnées seront ajoutées ici -->
                    </tbody>
                </table>
                <input type="hidden" name="ref" id="refinput">
                <input type="hidden" name="link" id="linkinput"><br>

                <button type="submit"><?= lang('ajout_link.tab2_send') ?></button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var refs = [];
            var links = [];

            var addLinkButton = document.getElementById("addLinkButton");
            var linkTable = document.getElementById("linkTable");
            var refInput = document.getElementById("refinput");
            var linkInput = document.getElementById("linkinput");

            addLinkButton.addEventListener("click", function() {
                var champ1Value = document.getElementById("champ1").value;
                var champ2Value = document.getElementById("champ2").value;

                // Créez un tableau pour stocker les données
                var data = [champ1Value, champ2Value];
                // Ajoutez les données au tableau
                refs.push(data[0]);
                links.push(data[1]);

                var newRow = linkTable.insertRow();
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var deleteCell = newRow.insertCell(2);

                cell1.innerHTML = data[0];
                cell2.innerHTML = data[1];

                // Ajouter un bouton de suppression pour la nouvelle ligne
                var deleteButton = document.createElement("button");
                deleteButton.textContent = "Supprimer";
                deleteButton.addEventListener("click", function() {
                    var index = Array.from(linkTable.rows).indexOf(newRow);
                    if (index !== -1) {
                        // Supprimez la ligne du tableau
                        linkTable.deleteRow(index);
                        // Supprimez les données correspondantes du tableau
                        refs.splice(index, 1);
                        links.splice(index, 1);
                        updateHiddenInputs();
                    }
                });
                deleteCell.appendChild(deleteButton);

                // Effacer les valeurs des champs du formulaire
                document.getElementById("champ1").value = "";
                document.getElementById("champ2").value = "";

                updateHiddenInputs();
            });

            // Fonction pour mettre à jour les champs cachés avec les données du tableau
            function updateHiddenInputs() {
                refInput.value = JSON.stringify(refs);
                linkInput.value = JSON.stringify(links);
            }
        });
    </script>
</body>
</html>

</body>

</html>