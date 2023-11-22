

<div class="container"><br>
<?php $session = \Config\Services::session(); ?>
<p style="text-align:center"> 
<?= lang('recits.page_title') ?></p><br>


<form action="<?= base_url('recits') ?>" method="get">
    <input class="input-search" type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder=<?= lang('recits.search') ?>>
    <input class="button-search" type="submit" value=<?= lang('recits.search_button') ?>>
</form></br>

<form action="<?= base_url('recits') ?>" method="get">
    <input class="button-tri" type="submit" value="Trier">
    <select class="input-tri" name="tri" id="tri">
    <?php
    if (isset($_GET['tri'])){
        if($_GET['tri'] == 'nomAZ'){
            echo '<option value="nomAZ" selected>'.lang('recits.nomAZ').'</option>
            <option value="nomZA" >'.lang('recits.nomZA').'</option>
            <option value="anneeAZ">'.lang('recits.anneeAZ').'</option>
            <option value="anneeZA">'.lang('recits.anneeZA').'</option>
            <option value="titreAZ">'.lang('recits.titreAZ').'</option>
            <option value="titreZA">'.lang('recits.titreZA').'</option>';
        }
        elseif($_GET['tri'] == 'nomZA'){
            echo '<option value="nomAZ">'.lang('recits.nomAZ').'</option>
            <option value="nomZA" selected>'.lang('recits.nomZA').'</option>
            <option value="anneeAZ">'.lang('recits.anneeAZ').'</option>
            <option value="anneeZA">'.lang('recits.anneeZA').'</option>
            <option value="titreAZ">'.lang('recits.titreAZ').'</option>
            <option value="titreZA">'.lang('recits.titreZA').'</option>';
        }
        elseif($_GET['tri'] == 'anneeAZ'){
            echo '<option value="nomAZ">'.lang('recits.nomAZ').'</option>
            <option value="nomZA" >'.lang('recits.nomZA').'</option>
            <option value="anneeAZ" selected>'.lang('recits.anneeAZ').'</option>
            <option value="anneeZA">'.lang('recits.anneeZA').'</option>
            <option value="titreAZ">'.lang('recits.titreAZ').'</option>
            <option value="titreZA">'.lang('recits.titreZA').'</option>';
        }
        elseif($_GET['tri'] == 'anneeZA'){
            echo '<option value="nomAZ">'.lang('recits.nomAZ').'</option>
            <option value="nomZA" >'.lang('recits.nomZA').'</option>
            <option value="anneeAZ">'.lang('recits.anneeAZ').'</option>
            <option value="anneeZA" selected>'.lang('recits.anneeZA').'</option>
            <option value="titreAZ">'.lang('recits.titreAZ').'</option>
            <option value="titreZA">'.lang('recits.titreZA').'</option>';
        }
        elseif($_GET['tri'] == 'titreAZ'){
            echo '<option value="nomAZ">'.lang('recits.nomAZ').'</option>
            <option value="nomZA" >'.lang('recits.nomZA').'</option>
            <option value="anneeAZ">'.lang('recits.anneeAZ').'</option>
            <option value="anneeZA">'.lang('recits.anneeZA').'</option>
            <option value="titreAZ" selected>'.lang('recits.titreAZ').'</option>
            <option value="titreZA">'.lang('recits.titreZA').'</option>';
        }
        elseif($_GET['tri'] == 'titreZA'){
            echo '<option value="nomAZ">'.lang('recits.nomAZ').'</option>
            <option value="nomZA" >'.lang('recits.nomZA').'</option>
            <option value="anneeAZ">'.lang('recits.anneeAZ').'</option>
            <option value="anneeZA">'.lang('recits.anneeZA').'</option>
            <option value="titreAZ">'.lang('recits.titreAZ').'</option>
            <option value="titreZA" selected>'.lang('recits.titreZA').'</option>';
        }
    } else {
        echo '<option value="nomAZ">'.lang('recits.nomAZ').'</option>
        <option value="nomZA" >'.lang('recits.nomZA').'</option>
        <option value="anneeAZ">'.lang('recits.anneeAZ').'</option>
        <option value="anneeZA">'.lang('recits.anneeZA').'</option>
        <option value="titreAZ">'.lang('recits.titreAZ').'</option>
        <option value="titreZA">'.lang('recits.titreZA').'</option>';
    }
    ?>
    </select>
</form></br>

<!--
<style>
    .sortable-header {
        position: relative;
    }

    .sortable-header a {
        position: absolute;
        top: 0;
    }

    .arrow-up {
        right: 10px; 
    }

    .arrow-down {
        right: 0;
    }
    
</style>
-->

<?php if (! empty($recits) && is_array($recits)): ?>
    <table id="exa" class="display" style="width:100%; margin-top:1%">
    <thead>
        
    <TR>
            <th style="position: relative;" class="sortable-header">
                <?= lang('recits.name_slave') ?>
            </th>
            <th style="position: relative;" class="sortable-header">
                <?= lang('recits.date_publication') ?>
            </th>
            <th style="position: relative;" class="sortable-header">
                <?= lang('recits.title') ?>
            </th>
        <?php if ($session->get('is_admin')) : ?>
            <TH> <?= lang('recits.modification') ?> </TH>
            <TH> <?= lang('recits.delete') ?> </TH>
        <?php endif; ?>
	</TR>

    </thead>



<tbody>
    <?php if(isset($recitsT) && is_array($recitsT)):
     foreach ($recits as $r): ?>
  
<tr>

    <td>
        <p><a href="<?= site_url()."recits/".esc($r['id_recit'], 'url') ?>"><?php echo htmlspecialchars($r['nom_esc']);?></a></p>
    </td>

    <td>
        <p><?php echo htmlspecialchars($r['date_publi']);?></p>
    </td>

    <td>
        <p><?php echo htmlspecialchars($r['titre']);?></p>
    </td>

        <?php if ($session->get('is_admin')) : ?>
            <td>
                <p><a href="<?= site_url('/modif_recit?esc='.esc(htmlspecialchars($r['id_auteur'])).'&idR='.esc(htmlspecialchars($r['id_recit']))) ?>"><?= lang('recits.modify_button') ?></a></p>
             </td>

            <td>
                <p><a href="<?= site_url('Suppr/SupprRecit?esc='.esc(htmlspecialchars($r['id_auteur'])).'&idR='.esc(htmlspecialchars($r['id_recit']))) ?>" onclick="return confirm('<?= lang('recits.delete_confirmation') ?>')"><?= lang('recits.delete_button') ?></a></p>
            </td>
        <?php endif; ?>

</tr>

    <?php endforeach ?>
    </tbody>
    </table>
    <?php else : ?>
        <?php foreach ($recits as $r): ?>
  
  <tr>
  
      <td>
          <p><a href="<?= site_url()."recits/".esc($r['id_recit'], 'url') ?>"><?php echo $r['nom_esc'];?></a></p>
      </td>
  
      <td>
          <p><?php echo $r['date_publi'];?></p>
      </td>
  
      <td>
          <p><?php echo $r['titre'];?></p>
      </td>
  
          <?php if ($session->get('is_admin')) : ?>
              <td>
                  <p><a href="<?= site_url('/modif_recit?esc='.esc($r['id_auteur']).'&idR='.esc($r['id_recit'])) ?>"><?= lang('recits.modify_button') ?></a></p>
               </td>
  
              <td>
                  <p><a href="<?= site_url('Suppr/SupprRecit?esc='.esc($r['id_auteur']).'&idR='.esc($r['id_recit'])) ?>" onclick="return confirm('<?= lang('recits.delete_confirmation') ?>')"><?= lang('recits.delete_button') ?></a></p>
              </td>
          <?php endif; ?>
  
  </tr>
  
      <?php endforeach ?>
      </tbody>
    </table>
    <?php endif; ?>

    <script>

        $(document).ready(function () {
    $('#exa').DataTable();
});

    </script>

    <?php else: ?>

<h3>Pas de récit</h3>
<p>Aucun récit n'a été trouvé</p>

<?php endif ?>

<br><br><br>






    </div>

