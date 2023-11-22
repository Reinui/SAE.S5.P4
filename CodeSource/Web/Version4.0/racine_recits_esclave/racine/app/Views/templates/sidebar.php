<div class="sidebar" id="sidebar">
<style>
	/* Style pour le bouton d'ouverture du menu */
#btnaction {
    background-color: #fff2e3;
    color: #111;
    padding: 10px;
    border: 1px solid #adadad;
    cursor: pointer;
    margin-bottom: 10px;
    border-radius: 5px;
    font-weight: bold;
    font-family: 'goudy', sans-serif;
}

#btnaction:hover {
    background-color: #fddeba;
}

/* Style pour le conteneur du menu */
#dropdown {
    display: none;
    position: absolute;
    top: 50px; /* Ajustez la position verticale pour placer le menu sous le bouton */
    left: 8px; /* Aligner le bord gauche du menu avec le bouton */
    background-color: #fff;
    border: 1px solid #ccc;
    z-index: 1;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}


/* Style pour la liste du menu */
ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Style pour les éléments de la liste */
li {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

li:last-child {
    border-bottom: none; /* Supprime la bordure inférieure du dernier élément de la liste */
}

/* Style pour les liens dans le menu */
a {
    text-decoration: none;
    color: #333;
}

/* Style pour le lien survolé */

a:hover {
    background-color: #f0f0f0;
    color: #0074D9;
}

/* Style pour les boutons dans la liste */
ul li a button {
    background-color: #0074D9;
    color: #fff;
    padding: 5px 10px;
    border: none;
    cursor: pointer;
    font-weight: bold;
    border-radius: 5px;
}

ul li a button:hover {
    background-color: #0056b3;
}

</style>
<?php $session = \Config\Services::session(); ?>

<button onclick="toggleDropdown()" id="btnaction"><?= lang('sidebar.menu_button')?></button>
<div id="dropdown" style="display: none;">
    <ul>
        <?php if($session->get('is_admin')): ?>
            <li><a href="/creercompte"><?= lang('sidebar.create_account_button') ?></a></li>
            <li><a href="/ajout_point"><?= lang('sidebar.add_point_button') ?></a></li>
            <li><a href="/ajout_recit"><?= lang('sidebar.add_narrative_button') ?></a></li>
			<li><a href="/ajout_poly"><?= lang('sidebar.add_polygon_button') ?></a></li>
            <li><a href="/ajout_esclave"><?= lang('sidebar.add_slave_button') ?></a></li>
            <li><a href="/choix_esclave"><?= lang('sidebar.modify_slave_button') ?></a></li>
            <li><a href="/suppr_esclave"><?= lang('sidebar.delete_slave_button') ?></a></li>
        <?php endif ?>
        
        <li><a href="<?= $session->get('is_admin') ? '/deconnexion' : '/connexion' ?>"
                onclick="<?= $session->get('is_admin') ? 'return confirmLogout()' : '' ?>">
            <?= $session->get('is_admin') ? lang('sidebar.logout_button') : lang('sidebar.login_button') ?>
        </a></li>
    </ul>
</div>

	<script>
		function toggleDropdown() {
			var dropdown = document.getElementById('dropdown');
			if (dropdown.style.display === 'none' || dropdown.style.display === '') {
				dropdown.style.display = 'block';
			} else {
				dropdown.style.display = 'none';
			}
		}
	</script>

	<script>
		function confirmLogout() {
			return confirm('<?= lang('sidebar.logout_confirmation') ?>');
		}
  	</script>




	<?= session()->getFlashdata('error') ?>

	<!-- Menu déroulant pour le choix des lieux -->
	<?php
	if (!empty($place) && is_array($place)) {

		if ($place[1]['type'] == "naissance") {
			echo "<p>Lieux de naissance</p>";
		}
		if ($place[1]['type'] == "publication") {
			echo "<p>Lieux de publication</p>";
		}
		if ($place[1]['type'] == "deces") {
			echo "<p>Lieux de décès</p>";
		}
		if ($place[1]['type'] == "esclavage") {
			echo "<p>Lieux d'esclavage</p>";
		}
		if ($place[1]['type'] == "lieuvie") {
			echo "<p>Lieux de vie après l'esclavage</p>";
		}
	} else {
		echo "<p>". lang('sidebar.location.search_location_type') ."</p>";
	}
	?>
	<?php 
		if (isset($type)) {
			// La variable $type existe
			// Vous pouvez effectuer des opérations sur cette variable ici
		} else {
			$type = 'rien';
		}
	?>
	<form action="<?= base_url(); ?>/map/places" method="post">
		<?= csrf_field() ?>
		<select name="select_place" id="select">
			<option selected disabled hidden style='display: none' value=''><?= lang('sidebar.location.select_location_type')?></option>
				 
				<?php if($type == 'naissance'){ ?>
					<option value='naissance' selected> <?= lang('sidebar.location.birth')?> </option>
				<?php } else{ ?>
					<option value='naissance'> <?= lang('sidebar.location.birth')?> </option>
				<?php } if($type == 'publication'){?>
					<option value='publication' selected> <?= lang('sidebar.location.publication')?>  </option>
				<?php } else{ ?>
					<option value='publication'> <?= lang('sidebar.location.publication')?>  </option>
				
				<?php } if($type == 'deces'){?>
					<option value='deces' selected> <?= lang('sidebar.location.death')?>  </option>
				<?php } else{ ?>
					<option value='deces'> <?= lang('sidebar.location.death')?>  </option>
				<?php } if($type == 'esclavage'){?>
					<option value='esclavage' selected> <?= lang('sidebar.location.slavery')?>  </option>
				<?php } else{ ?>
					<option value="esclavage"> <?= lang("sidebar.location.slavery")?>  </option>
				<?php } if($type == 'lieuvie'){?>
					<option value="lieuvie" selected> <?= lang("sidebar.location.location_life")?> </option>
				<?php } else{ ?>
					<option value="lieuvie"> <?= lang("sidebar.location.location_life")?> </option>
				<?php }?>
		</select>

		<br><br>

		<input id="cc" type="submit" value="<?= lang('sidebar.search_button')?>" />
	</form>




	<br>


	<!-- Menu déroulant pour le choix des récits -->
	<!-- reprendre ce code -->

	<?php
	if (!empty($pts) && is_array($pts)) {

		$url = site_url() . "recits/" . $pts[0]['id_recit'];
		echo "<a id= 'acc'href=", $url, "><p id='lien'>", $pts[0]['nom_esc'],
		" (", $pts[0]['date_publi'], "), (Voir la fiche récit)</p></a>";
	} else {
		echo "<p id='recit'>" . lang('sidebar.narrative.search_narrative') ."</p>";
		//var_dump($couche);
	}
	?>




	<form action="<?= base_url(); ?>/map/recits" method="post">
		<?= csrf_field() ?>
		<select name="select_recit" id="select">

			<option><?= lang('sidebar.narrative.search_narrative') ?></option>
			<?php
			$nbt = count($points);
			if (!isset($selec) || $selec === null) {
				$selec = '';
			}
			
			foreach ($points as $p) { 
				if($p['id_recit'] == $selec){?>
					<option value=<?php echo $p['id_recit'] ?> selected>

						<?php echo $p['nom_esc'], ' (', $p['date_publi'], ')' ?> </option>

			<?php }else{ ?>
						<option value=<?php echo $p['id_recit'] ?> >

						<?php echo $p['nom_esc'], ' (', $p['date_publi'], ')' ?> </option>
			<?php	}
			}?>

		</select>

		<br><br>


		<input id="cc" type="submit" value="<?= lang('sidebar.search_button')?>" />

	</form>


	<br>
	<section class="legend2">

		<span>
			<p> <?= lang('sidebar.legend.title')?> </p>
		</span>
		<i class="naiss"></i><span><?= lang('sidebar.legend.location_birth')?></span><br>
		<i class="publi"></i><span><?= lang('sidebar.legend.location_publication_narratives')?></span><br>
		<i class="lieuv"></i><span><?= lang('sidebar.legend.location_life')?></span><br>
		<i class="dece"></i><span><?= lang('sidebar.legend.location_death')?></span><br>
		<i class='esclav'></i><span><?= lang('sidebar.legend.location_slavery')?></span><br>

		<i class='naiss_esc legend2_desc'></i><span><?= lang('sidebar.legend.birth_slavery')?></span><br>
		<i class='lieuvie_dec legend2_desc'></i><span><?= lang('sidebar.legend.life_death')?></span><br>
		<i class='esc_vie_dec legend2_desc'></i><span><?= lang('sidebar.legend.slavery_life_death')?></span><br>
		<i class='naiss_esc_vie_dec legend2_desc'></i><span><?= lang('sidebar.legend.birth_slavery_life_death')?></span><br>
		<br>
		<i class='usa'></i><span><?= lang('sidebar.legend.us_borders')?></span><br>
	</section>

</div>