<?php $session = \Config\Services::session(); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/notification.css') ?>">

<br><br>
<div class="container">
<p style="text-align:center; font-size:25px;padding:6px;">  
    <?= lang('view.title') ?></p>

    <div class="rec"><br>
    <p style="text-align:center; font-size:25px; font-style:italic;padding:6px;">

    <?= esc($rec['titre']) ?> </p><br>
</div>

    <br> 
    <div class="rec"><br>
    
        <div class="rec_par">
        <strong><p style="text-align:right;"><?= lang('view.year_publication') ?> :</strong> <?= esc(htmlspecialchars($rec['date_publi'])) ?> </p>
        <strong><p style="text-align:right;"><?= lang('view.method_publication') ?> :</strong> <?= esc(htmlspecialchars($rec['mode_publi'])) ?> </p>
        <strong><p style="text-align:right;"><?= lang('view.several_written_narratives') ?> :</strong> <?= esc(htmlspecialchars($rec['plrs_recits'])) ?> </p>

    <div class='bouton-recit'>
      <?php if ($session->get('is_admin')) : ?>
            <td>
                <p><a href="<?= site_url('/modif_recit?esc='.esc(htmlspecialchars($rec['id_auteur'])).'&idR='.esc(htmlspecialchars($rec['id_recit']))) ?>"><?= lang('recits.modify_button') ?></a></p>
            </td>

            <td>
                <p><a href="<?= site_url('Suppr/SupprRecit?esc='.esc(htmlspecialchars($rec['id_auteur'])).'&idR='.esc(htmlspecialchars($rec['id_recit']))) ?>" onclick="return confirm('<?= lang('recits.delete_confirmation') ?>')"><?= lang('recits.delete_button') ?></a></p>
            </td>
            <td>
              <p><a href="/ajout_link">Ajouter un lien</a></p>
            </td>

        <?php endif; ?>
      </div>

    <strong><p><?= lang('view.name_slave') ?> :</strong> <?= esc(htmlspecialchars($rec['nom_esc'])) ?> </p>
    <strong><p><?= lang('view.type_narrative') ?> :</strong> <?= esc(htmlspecialchars($rec['type_recit'])) ?> </p>

    <strong><p><?= lang('view.date_birth') ?> :</strong> <?= esc(htmlspecialchars($rec['naissance'])) ?> </p>
    <strong><p><?= lang('view.location_publication') ?> :</strong> <?= esc(htmlspecialchars($rec['lieu_publi'])) ?> </p>
    <strong><p><?= lang('view.origins_parents') ?> :</strong> <?= esc(htmlspecialchars($rec['origine_parents'])) ?> </p>
    <strong><p><?= lang('view.name_writer') ?> :</strong> <?= esc(htmlspecialchars($rec['scribe_editeur'])) ?> </p>
    <strong><p><?= lang('view.additional_information') ?> :</strong> <?= esc(htmlspecialchars($rec['particularites'])) ?> </p>
</div>

<div id="notification" class="hidden">
  <div class="notification-text"><?= lang('view.status') ?></div>
  <div class="notification-spinner"></div>
</div>


<br><br>

<div id="comm">
    <p style="text-align:center;">
        Commentaires / Historiographie: <br><br> 
        <?= html_entity_decode($histo) ?>

</p>
</div>

<br>
<p><?= lang('view.link_narrative') ?> : <a href="<?= esc(htmlspecialchars($rec['lien_recit'])) ?>"><?= esc(htmlspecialchars($rec['lien_recit'])) ?></a></p>


<br><br>
<div style="display:flex;">
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."recits" ?>"'><p><?= lang('view.back_narratives_list_button') ?></p></button>
<button class="button_return" onclick='window.location.href = 
"<?= site_url()."map" ?>"'><p><?= lang('view.back_narratives_map_button') ?></p></button>
<br><br>
</div>
<br>
    </div>
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récit</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      var info = <?= json_encode(lang('view.info')) ?>;
      var par = <?= json_encode(lang('view.par')) ?>;
      var de = <?= json_encode(lang('view.de')) ?>; 
      var parue = <?= json_encode(lang('view.parue')) ?>;
      var a = <?= json_encode(lang('view.a')) ?>;
      var ref = <?= json_encode(lang('view.ref')) ?>;
    </script>


</head>
<body>

<script>
function afficherPopup(choix) {
  var apiKey = "E7a5WJBnmii1HdXPtMVRZcG1";
  var userId = "5400206";
  var Apidata = [];
  var arrayselec = null ; // Variable pour stocker l'élément correspondant
    var found = false; // Variable pour indiquer si l'élément correspondant a été trouvé

    // Afficher une notification "Recherche en cours"
    var notification = document.getElementById("notification");
    notification.style.display = "block";

  // Fonction pour effectuer la recherche parmi les éléments dans la bibliothèque Zotero
  function makeSearchRequest(query, start) {
    var url = `https://api.zotero.org/users/${userId}/items?limit=25&start=${start}`;
    //console.log('requete');

    return new Promise(function (resolve, reject) {
      $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {

            for (var i = 0; i < Apidata.length && !found; i++) {
                var data = Apidata[i];
                for (var y = 0; y < data.length && !found; y++) {
                    var elt = data[y];
                    if (elt['data']['shortTitle'] === choix) {
                        //console.log('---------------------');
                        //console.log(choix);
                        //console.log(elt);
                        //console.log('---------------------');
                        arrayselec = elt;
                        found = true; // Définir la variable "found" sur true pour sortir des boucles
                    }
                }
            }
          Apidata.push(response);
          resolve(response);
        },
        error: function (xhr, status, error) {
          console.error("La requête a échoué avec le code de statut : " + xhr.status);
          resolve(null);
        }
      });
    });
  }
  
  // Fonction pour vérifier les données et afficher la pop-up
  function checkData() {
    var titre = info;
    var nom = info;
    var prenom = info;
    var maisonEd = info;
    var date = info;
    var place = info;
    
    if (arrayselec != null) {
      var item = arrayselec;

      if(item.data.title != null){
        titre = item.data.title;
      }
      if(item.data.creators[0].lastName != null){
      nom = item.data.creators[0].lastName;
      }
      if(item.data.creators[0].firstName != null){
      prenom = item.data.creators[0].firstName;
      }
      if(item.data.publisher != null ){
       maisonEd = item.data.publisher;
      }
      if(item.data.date != null ){
        date = item.data.date;
      }
      if(item.data.place != null ){
        place = item.data.place;
      }

    } else {
      for (var i = 0; i < Apidata.length; i++) {
        var items = Apidata[i];
        for (var j = 0; j < items.length; j++) {
          var item = items[j];
          if (item.data.shortTitle === choix) {

            if(item.data.title != null){
              titre = item.data.title;
            }
            if(item.data.creators[0].lastName != null){
            nom = item.data.creators[0].lastName;
            }
            if(item.data.creators[0].firstName != null){
            prenom = item.data.creators[0].firstName;
            }
            if(item.data.publisher != null ){
            maisonEd = item.data.publisher;
            }
            if(item.data.date != null ){
              date = item.data.date;
            }
            if(item.data.place != null ){
              place = item.data.place;
            }

            arrayselec = item;
            break;
          }
        }
      }
    }

    // Vérifier si le titre est vide
    if (titre === info) {
        notification.style.display = "none";
        // Aucune référence trouvée, afficher un message d'erreur
        var popup = window.open('', '', 'width=400,height=200');
        popup.document.write(ref);
    } else {
        notification.style.display = "none";
        // Afficher les détails de la référence
        var contenuPopup = '"'+titre + '"'+ de + nom + ', '+ prenom +','+ parue + date + par +maisonEd + a +place+'.';
        var popup = window.open('', '', 'width=400,height=200');
        popup.document.write(contenuPopup);
    }
  }

  // Fonction récursive pour effectuer des recherches successives
  function recursiveSearch(query, start) {
    makeSearchRequest(query, start)
      .then(function (response) {
        if (arrayselec == null) {
          if (response && response.length > 0) {
            // S'il y a des éléments dans la réponse, continuez la recherche avec le prochain lot de résultats
            start += 25;
            recursiveSearch(query, start);
          } else {
            // S'il n'y a plus de résultats, vérifiez les données et affichez la popup
            //console.log(Apidata); // Afficher les données dans la console
            checkData();
          }
        } else {
          checkData();
        }
      })
      .catch(function (error) {
        console.error("Erreur :", error);
        checkData(); // En cas d'erreur, vérifiez quand même les données
      });
  }

  // Fonction pour afficher une notification
  function afficherNotification(message) {
    // Vérifier si le navigateur prend en charge les notifications
    if ('Notification' in window) {
      // Vérifier l'autorisation de notification
      if (Notification.permission === 'granted') {
        new Notification(message);
      } else if (Notification.permission !== 'denied') {
        Notification.requestPermission().then(function (permission) {
          if (permission === 'granted') {
            new Notification(message);
          }
        });
      }
    }
  }


  // Démarrer la recherche récursive
  var start = 0;
  var query = choix; // Utilisez le choix comme critère de recherche
  recursiveSearch(query, start);
}
</script>
