<?php

namespace App\Controllers;
 
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Libraries\DatabaseUtils;
 
class Recits extends BaseController
{
    public function index()
    {

        $model = model(ModelRecit::class);

        $search = $this->request->getGet('search');
        $tri = $this->request->getGet('tri');
        $order = $this->request->getGet('tri');

        switch($tri){
            case "nomAZ":
                $tri = "nom_esc";
                $order = "ASC";
                break;
            case "nomZA":
                $tri = "nom_esc";
                $order = "DESC";
                break;
            case "anneeAZ":
                $tri = "date_publi";
                $order = "ASC";
                break;
            case "anneeZA":
                $tri = "date_publi";
                $order = "DESC";
                break;
            case "titreAZ":
                $tri = "titre";
                $order = "ASC";
                break;
            case "titreZA":
                $tri = "titre";
                $order = "DESC";
                break;
            default:
        }
 
        $data = [
        'recits'  => $model->getRecits($search),
        'recitsT'  => $model->getTriRecits($tri, $order)
        ];

        if((!empty($search) && !empty($search)) || (!empty($tri) && !empty($tri))){
            DatabaseUtils::insertVisit('recits');
        }

        return view ('resclaves/header')
        . view ('resclaves/recits',$data)
        . view ('templates/footer_resc');
    }



    public function view($idrec = null){
        
    $model = model(ModelRecit::class);
    $texteArray = $model->getIdRec($idrec);
    $textehisto = $texteArray["historiographie"];

    // Tableau pour stocker les valeurs extraites
    $apiValues = array();

    // Extrait les informations entre parenthèses
    $pattern = '/\(([^)]+)\)/';
    preg_match_all($pattern, $textehisto, $matches);

    // Parcourt les correspondances et les traite
    foreach ($matches[1] as $match) {
        // Divise le texte en segments en utilisant la virgule
        $segments = explode(',', $match);

        // Vérifie qu'il y a au moins trois segments (auteur, titre, année)
        if (count($segments) >= 3) {
            $auteur = trim($segments[0]);
            $titre = trim($segments[1]);
            $annee = (int) trim($segments[2]);

            // Génère le lien avec l'appel JavaScript
            $lien = "<a href='javascript:void(0);' onclick=\"afficherPopup('$titre')\">($auteur, $titre, $annee)</a>";

            // Remplace le texte entre parenthèses par le lien
            $textehisto = str_replace("($match)", $lien, $textehisto);
        }
        if(count($segments) == 2){
            $titre = trim($segments[0]);
            $annee = (int) trim($segments[1]);

            // Génère le lien avec l'appel JavaScript
            $lien = "<a href='javascript:void(0);' onclick=\"afficherPopup('$titre')\">($titre, $annee)</a>";

            // Remplace le texte entre parenthèses par le lien
            $textehisto = str_replace("($match)", $lien, $textehisto);
        }
        if(count($segments) == 1){
            $titre = trim($segments[0]);
            $sql = 'SELECT * FROM `link` WHERE reference = ?';
            $db = db_connect();
            $result = $db->query($sql, [$titre]);

            if ($result) {
                $row = $result->getRow(); // Obtenez la première ligne de résultat
                if ($row) {
                    $reference = $row->reference;
                    $link = $row->link;
                    $lien = "<a href='$link'>($reference)</a>";
                } else {
                    // Aucun résultat trouvé pour le titre donné
                    $lien = "<a >($titre)</a>";
                }
            } else {
                // Gérez les erreurs de requête ici, par exemple :
                die("Erreur de requête SQL : " . $db->error());
            }
            $textehisto = str_replace("($match)", $lien, $textehisto);
        }
    }
            

            // Assigner le tableau $apiValues à $data['api']
            $data['api'] = $apiValues;

            $data['rec'] = $texteArray;
            $data['histo'] = $textehisto;

            if (empty($data['rec'])) {
                throw new PageNotFoundException('Cannot find the news item: ' . $idre);
            }

            DatabaseUtils::insertVisit('fiche_recit');
            return view('resclaves/header')
                . view('resclaves/view', $data)
                . view('templates/footer_resc');
        }
}
