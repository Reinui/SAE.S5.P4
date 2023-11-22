<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('modif_recit.title') ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>

    <div class="login-container">
        <form action="<?= site_url('Modif/ModifPoly_Recit?idR=' . $_GET['idR']) ?>" method="post">
            <label><?= lang('modif_recit.name_narrative') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo '<input name="nomR" id="nomR" type="text" value="' . htmlspecialchars($elt['titre']) . '" required/><br><br>';
                    }
                }
            }
            ?>
            <label><?= lang('modif_recit.name_slave') ?></label>
            <select name="idE" id="idE" required>
                <?php
                if (!empty($auteurs) && is_array($auteurs)) {
                    foreach ($auteurs as $elt) {
                        if ($elt['id_auteur'] == $_GET['esc']) {
                            echo '<option value="' . $elt['id_auteur'] . '"selected>' . htmlspecialchars($elt['nom']) . ' </option>';
                        } else {
                            echo '<option value="' . $elt['id_auteur'] . '">' . htmlspecialchars($elt['nom']) . ' </option>';
                        }
                    }
                }
                ?>
            </select><br><br>

            <label><?= lang('modif_recit.location_publication') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo '<input name="lieuP" id="lieuP" type="text" value="' . htmlspecialchars($elt['lieu_publi']) . '" required/><br><br>';
                    }
                }
            }
            ?>


            <label><?= lang('modif_recit.year_publication') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo '<input name="dateP" id="dateP" type="number" min="0" max="2100" value="' . htmlspecialchars($elt['date_publi']) . '" required/><br><br>';
                    }
                }
            }
            ?>

            <label><?= lang('modif_recit.type_narrative') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo '<input name="typeR" id="typeR" type="text" value="' . htmlspecialchars($elt['lieu_publi']) . '" required/><br><br>';
                    }
                }
            }
            ?>

            <label><?= lang('modif_recit.comments') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo "<input name='com' id='com' type='text' value='" . htmlspecialchars($elt['historiographie']) . "' required/><br><br>";
                    }
                }
            }
            ?>

            <label><?= lang('modif_recit.method_publication') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo '<input name="modeP" id="modeP" type="text" value="' . htmlspecialchars($elt['mode_publi']) . '" required/><br><br>';
                    }
                }
            }
            ?>

            <!--<label>Date de naissance :</label>
           <input name="dateN" id="dateN" type="date" /><br><br> -->

            <label><?= lang('modif_recit.name_writer') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo '<input name="nomS" id="nomS" type="text" value="' . htmlspecialchars($elt['scribe_editeur']) . '" required/><br><br>';
                    }
                }
            }
            ?>

            <label><?= lang('modif_recit.link_narrative') ?></label>
            <?php
            if (!empty($title) && is_array($title)) {
                foreach ($title as $elt) {
                    if ($elt['id_recit'] == $_GET['idR']) {
                        echo '<input name="lienR" id="lienR" type="text" value="' . htmlspecialchars($elt['lien_recit']) . '" required/><br><br>';
                    }
                }
            }
            ?>

            <label><?= lang('ajout_recit.choix_polys') ?></label>
            <select name="poly[]" id="poly" multiple required>
                <?php
                if (!empty($polys) && is_array($polys)) {
                    foreach ($polys as $elt) {
                        $write = true;
                        if (!empty($recitP) && is_array($recitP)) {
                            foreach ($recitP as $pol) {
                                if ($pol['poly_id'] == $elt['id'] && $pol['recit_id'] == $_GET['idR']) {
                                    echo '<option value="' . $elt['id'] . '" selected>' . htmlspecialchars($elt['name']) . ' </option>';
                                    $write = false;
                                }
                            }
                            if ($write) {
                                echo '<option value="' . $elt['id'] . '">' . htmlspecialchars($elt['name']) . ' </option>';
                            }
                        }
                    }
                }
                ?>
            </select><br><br>

            <a class="retour" href="<?= site_url('/recits') ?>"><?= lang('recits.bouton_retour') ?></a></p>
            <button type="submit"><?= lang('modif_recit.modify_button') ?></button>
        </form>
        <script>
        var select = document.getElementById('poly');
        var scrollPosition = 0;

        window.onmousedown = function(e) {
            // Enregistrez la position de défilement actuelle

            var el = e.target;
            if (el.tagName.toLowerCase() === 'option' && el.parentNode.hasAttribute('multiple')) {
                e.preventDefault();

                // Toggle selection
                if (el.hasAttribute('selected')) el.removeAttribute('selected');
                else el.setAttribute('selected', '');

                // Hack to correct buggy behavior
                var clonedSelect = select.cloneNode(true);
                select.parentNode.replaceChild(clonedSelect, select);

                // Restaurez la position de défilement après le changement de sélection
                clonedSelect.scrollTop = scrollPosition;
            }
        };
        </script>

</body>

</html>