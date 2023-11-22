<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('ajout_recit.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="login-container">
        <form action="<?= site_url('Ajout/InsertPoly_Recit') ?>" method="post">
            <label><?= lang('ajout_recit.name_narrative') ?></label>
            <input name="nomR" id="nomR" type="text" value="<?php if(isset($_GET['nomR'])){echo htmlspecialchars($_GET['nomR']);} ?>" /><br><br>

            <label><?= lang('ajout_recit.name_slave') ?></label>
            <select name="idE" id="idE" required>
                <?php
                if (!empty($auteurs) && is_array($auteurs)) {
                    foreach ($auteurs as $elt) {
                        if(isset($_GET['idE']) && $_GET['idE'] == $elt['id_auteur']){
                            echo '<option value="' . $elt['id_auteur'] . '" selected>' . htmlspecialchars($elt['nom']) . ' </option>';
                        } else {
                            echo '<option value="' . $elt['id_auteur'] . '">' . htmlspecialchars($elt['nom']) . ' </option>';
                        }
                    }
                }
                ?>
            </select><br><br>

            <label><?= lang('ajout_recit.location_publication') ?></label>
            <input name="lieuP" id="lieuP" type="text" value="<?php if(isset($_GET['lieuP'])){echo htmlspecialchars($_GET['lieuP']);} ?>" required /><br><br>

            <!--<label>Information supplémentaire :</label>
           <input name="infoSup" id="infoSup" type="text" /><br><br>-->

            <label><?= lang('ajout_recit.year_publication') ?></label>
            <input name="dateP" id="dateP" type="date" value="<?php if(isset($_GET['dateP'])){echo htmlspecialchars($_GET['dateP']);} ?>" required /><br><br>

            <label><?= lang('ajout_recit.type_narrative') ?></label>
            <input name="typeR" id="typeR" type="text" value="<?php if(isset($_GET['typeR'])){echo htmlspecialchars($_GET['typeR']);} ?>" required /><br><br>

            <label><?= lang('ajout_recit.comments') ?></label>
            <input name="com" id="com" type="text" value="<?php if(isset($_GET['com'])){echo htmlspecialchars($_GET['com']);} ?>" required /><br><br>

            <label><?= lang('ajout_recit.method_publication') ?></label>
            <input name="modeP" id="modeP" type="text" value="<?php if(isset($_GET['modeP'])){echo htmlspecialchars($_GET['modeP']);} ?>" required /><br><br>

            <!--<label>Date de naissance :</label>
           <input name="dateN" id="dateN" type="date" /><br><br> -->

            <label><?= lang('ajout_recit.name_writer') ?></label>
            <input name="nomS" id="nomS" type="text" value="<?php if(isset($_GET['nomS'])){echo htmlspecialchars($_GET['nomS']);} ?>" required /><br><br>

            <label><?= lang('ajout_recit.link_narrative') ?></label>
            <input name="lienR" id="lienR" type="text" value="<?php if(isset($_GET['lienR'])){echo htmlspecialchars($_GET['lienR']);} ?>" /><br><br>

            <label><?= lang('ajout_recit.choix_polys') ?></label>
            <select name="poly[]" id="poly" multiple required>
                <?php
                $write = true;
                if (!empty($polys) && is_array($polys)) {
                    foreach ($polys as $elt) {
                        if(isset($_GET['polys'])){
                            $polygones = explode(",", $_GET['polys']);
                            $write = true;
                            for($i=0;$i<count($polygones);$i++){       
                                if($polygones[$i] == $elt['name']){
                                    echo '<option value="' . $elt['id'] . '" selected>' . htmlspecialchars($elt['name']) . ' </option>';
                                    $write = false;
                                    break;
                                } 
                            }
                        } 
                        if(isset($write)){
                            if($write){
                                echo '<option value="' . $elt['id'] . '">' . htmlspecialchars($elt['name']) . ' </option>';
                            }
                        }
                    }
                }
                ?>
            </select><br><br>
            <a class="retour" href="<?= site_url('/map') ?>"><?= lang('recits.bouton_retour') ?></a></p>

            <button type="submit"><?= lang('ajout_recit.add_button') ?></button>

        </form>

    </div>
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