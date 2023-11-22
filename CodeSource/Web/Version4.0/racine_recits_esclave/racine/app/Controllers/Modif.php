<?php

namespace App\Controllers;

class Modif extends BaseController
{
    public function modif()
    {
        $session = \Config\Services::session();
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $model2 = model(ModelCouches::class);
        $model3 = model(ModelPolygones::class);
        $model4 = model(ModelRecit_poly::class);

        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs(),
            'polys' => $model3->getPoly(),
            'recitP' => $model4->getRecitPoly()
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            return view('resclaves/header')
                . view('resclaves/modif_recit', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function ModifRecit()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $nomR = $this->request->getPost('nomR');
        $idE = $this->request->getPost('idE');
        $idR = $this->request->getPost('idR');
        $lieuP = $this->request->getPost('lieuP');
        $infoSup = $this->request->getPost('infoSup');
        $dateP = $this->request->getPost('dateP');
        $typeR = $this->request->getPost('typeR');
        $com = $this->request->getPost('com');
        $modeP = $this->request->getPost('modeP');
        $nomS = $this->request->getPost('nomS');
        $lienR = $this->request->getPost('lienR');
        $nb = $this->request->getPost('nb');
        for($i=0; $i<$nb; $i++){
            $type[$i] = $this->request->getPost('type'.$i);
            }
            for($i=0; $i<$nb; $i++){
                $idP[$i] = $this->request->getPost('idP'.$i);
            }
            for($i=0; $i<$nb; $i++){
                $nomP[$i] = $this->request->getPost('nomP'.$i);
            }

        $nomE = '';
        foreach ($data['auteurs'] as $elt) {
            if($elt['id_auteur'] == $idE){
                $nomE = $elt['nom'];
            }
        }  

        $sql = 'UPDATE `tab_recits_v3` SET `nom_esc` = ?, `titre` = ?, `date_publi` = ?, `lieu_publi` = ?, `mode_publi` = ?, `type_recit` = ?, `historiographie` = ?, `id_auteur` = ?, `scribe_editeur` = ?, `lien_recit` = ?, `debut_titre` = ? WHERE `id_recit` = ?';
        $db = db_connect();
        $db->query($sql, [$nomE, $nomR, $dateP, $lieuP, $modeP, $typeR, $com, $idE, $nomS, $lienR, $nomR, $idR]);

        $sql = 'DELETE FROM `recit_poly` WHERE `recit_id` = ?';
        $db = db_connect();
        $db->query($sql, [$idR]);


        for($i=0; $i<$nb; $i++){
            $sql = 'INSERT INTO `recit_poly` (`recit_id`, `poly_id`, `type`) VALUES (?, ?, ?)';
            $db = db_connect();
            $db->query($sql, [$idR, $idP[$i], $type[$i]]);
            }

        return redirect()->to('/recits?search='.$nomR);
    }

    public function ModifPoly_Recit()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $model2 = model(ModelCouches::class);
        $model3 = model(ModelPolygones::class);
        $model4 = model(ModelRecit_poly::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs(),
            'nomR' => $this->request->getPost('nomR'),
            'idE' => $this->request->getPost('idE'),
            'lieuP' => $this->request->getPost('lieuP'),
            'infoSup' => $this->request->getPost('infoSup'),
            'dateP' => $this->request->getPost('dateP'),
            'typeR' => $this->request->getPost('typeR'),
            'com' => $this->request->getPost('com'),
            'modeP' => $this->request->getPost('modeP'),
            'dateN' => $this->request->getPost('dateN'),
            'nomS' => $this->request->getPost('nomS'),
            'lienR' => $this->request->getPost('lienR'),
            'polys' => $this->request->getPost('poly'),
            'polygones' => $model3->getPoly(),
            'recitP' => $model4->getRecitPoly()
        ];

        $idR = $_GET['idR'];

        $idE = $this->request->getPost('idE');

        $nomE = '';
        foreach ($data['auteurs'] as $elt) {
            if($elt['id_auteur'] == $idE){
                $nomE = $elt['nom'];
            }
        } 

        $data += [
            'idR' => $idR,
            'nomE' => $nomE
        ];

        return view('resclaves/header')
        . view('resclaves/modif_poly', $data);
    }

    public function choixModifA()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            return view('resclaves/header')
                . view('resclaves/choix_esclave', $data);
        } else {
            return redirect()->to('/map');
        }
    }

    public function modifA()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);

        $data = [
            'title' => $model->getRecit(),
            'auteur' => $this->request->getPost('idE'),
            'auteurs' => $model1->getAuteurs()
        ];


        $session = \Config\Services::session();

        if ($session->has('is_admin') && $session->get('is_admin') === true) {
            if(isset($_POST['idE'])){
                return view('resclaves/header')
                . view('resclaves/modif_esclave', $data);
            } else {
                return redirect()->to('/choix_esclave');
            }
        } else {
            return redirect()->to('/map');
        }
    }
    
    public function ModifAuteur()
    {
        $model = model(ModelFormulaire::class);
        $model1 = model(ModelGetAuteur::class);
        $data = [
            'title' => $model->getRecit(),
            'auteurs' => $model1->getAuteurs()
        ];

        $nomE = $this->request->getPost('nomE');
        $anneeN = $this->request->getPost('anneeN');
        $lieuN = $this->request->getPost('lieuN');
        $dateD = $this->request->getPost('dateD');
        $lieuD = $this->request->getPost('lieuD');
        $lieuE = $this->request->getPost('lieuE');
        $moy = $this->request->getPost('moy');
        $lieuV = $this->request->getPost('lieuV');
        $origP = $this->request->getPost('origP');
        $mil = $this->request->getPost('mil');
        $part = $this->request->getPost('part');
        $idE = $this->request->getPost('idE');
        $plrs = 'non';
        $opSource = 'non';
        $idR = 0;

        foreach($data['title'] as $elt){
            if($elt['id_auteur'] == $idE){
                $idR = $elt['id_recit'];
                $sql = 'UPDATE `tab_recits_v3` SET `nom_esc` = ? WHERE `id_recit` = ?';
                $db = db_connect();
                $db->query($sql, [$nomE, $idR]);
            }
        }

        $sql = 'UPDATE `tab_auteurs` SET `nom` = ?, `naissance` = ?, `lieu_naissance` = ?, `deces` = ?, `lieu_deces` = ?, `lieu_esclavage` = ?, `moyen_lib` = ?, `lieuvie_ap_lib` = ?, `origine_parents` = ?, `militant_abolitionniste` = ?, `particularites` = ?, `plrs_recits` = ?, `id_auteur` = ?, `op_source` = ? WHERE `id_auteur` = ?';
        $db = db_connect();
        $db->query($sql, [$nomE, $anneeN, $lieuN, $dateD, $lieuD, $lieuE, $moy, $lieuV, $origP, $mil, $part, $plrs, $idE, $opSource, $idE]);

        

        return redirect()->to('/recits');
    }
}

