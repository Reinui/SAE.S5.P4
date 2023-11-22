<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page_name = lang('insert_polys.title') ?>
    <title><?= $page_name ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_connexion.css'); ?>">
</head>

<body>
    <div class="login-container">
        <form action="<?= site_url('Ajout/InsertRecit') ?>" method="post">

            <label><?= lang('insert_polys.type_polys') ?></label>
            <?php
            $i = 0;
            $names = array();
            if (!empty($polys) && is_array($polys)) {
                foreach ($polys as $elt) {
                    foreach ($polygones as $te) {
                        if ($te['id'] == $elt) {
                            echo $te['name'] . '<br>';
                            $names[$i] = $te['name'];
                            echo '<select name="type' . $i . '" id="type' . $i . '" required>';
                            echo '<option value="publication">' . lang('insert_polys.publi') . '</option>';
                            echo '<option value="naissance">' . lang('insert_polys.naiss') . '</option>';
                            echo '<option value="deces">' . lang('insert_polys.deces') . '</option>';
                            echo '<option value="esclavage">' . lang('insert_polys.esc') . '</option>';
                            echo '<option value="lieuvie">' . lang('insert_polys.lieuv') . '</option>';
                            echo '</select><br><br>';
                            echo '<input name="idP' . $i . '" id="idP' . $i . '" type="hidden" value="' . $elt . '"/>';
                            echo '<input name="nomP' . $i . '" id="nomP' . $i . '" type="hidden" value="' . htmlspecialchars($te['name']) . '"/>';
                            $i++;
                        }
                    }
                }
            }
            echo '<input name="nb" id="nb" type="hidden" value="' . $i . '"/>';
            ?>
            <input name="nomR" id="nomR" type="hidden" value="<?php echo htmlspecialchars($nomR); ?>" />
            <input name="idE" id="idE" type="hidden" value="<?php echo htmlspecialchars($idE); ?>" />
            <input name="lieuP" id="lieuP" type="hidden" value="<?php echo htmlspecialchars($lieuP); ?>" />
            <input name="infoSup" id="infoSup" type="hidden" value="<?php echo htmlspecialchars($infoSup); ?>" />
            <input name="dateP" id="dateP" type="hidden" value="<?php echo htmlspecialchars($dateP); ?>" />
            <input name="typeR" id="typeR" type="hidden" value="<?php echo htmlspecialchars($typeR); ?>" />
            <input name="com" id="com" type="hidden" value="<?php echo htmlspecialchars($com); ?>" />
            <input name="modeP" id="modeP" type="hidden" value="<?php echo htmlspecialchars($modeP); ?>" />
            <input name="dateN" id="dateN" type="hidden" value="<?php echo htmlspecialchars($dateN); ?>" />
            <input name="nomS" id="nomS" type="hidden" value="<?php echo htmlspecialchars($nomS); ?>" />
            <input name="lienR" id="lienR" type="hidden" value="<?php echo htmlspecialchars($lienR); ?>" />
            <input name="idR" id="idR" type="hidden" value="<?php echo htmlspecialchars($idR); ?>" />
            <input name="nomE" id="nomE" type="hidden" value="<?php echo htmlspecialchars($nomE); ?>" />

            <a class="retour"
                href="<?= site_url('/ajout_recit?nomR='.$nomR.'&idE='.$idE.'&lieuP='.$lieuP.'&infoSup='.$infoSup.'&dateP='.$dateP.'&typeR='.$typeR.'&com='.$com.'&modeP='.$modeP.'&dateN='.$dateN.'&nomS='.$nomS.'&lienR='.$lienR.'&idR='.$idR.'&nomE='.$nomE.'&polys='.(implode(',', $names))) ?>"><?= lang('recits.bouton_retour') ?></a></p>
            </p>
            <button type="submit"><?= lang('insert_polys.add_button') ?></button>
        </form>

    </div>
</body>

</html>