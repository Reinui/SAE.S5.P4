<?php

namespace App\Models;

use CodeIgniter\Model;
 
class ModelRecit extends Model
   
{
    protected $table = 'tab_recits_v3';
	protected $allowedFields = ['nom_esc', 'titre','date_publi', 'type_recit'];

    public function get5Recits()
    {
        return $this->asArray()
                    ->orderBy('date_publi')
                    ->findAll();

                    
    }

    public function getIdRec($idrec = false)
    {
        $this->join('tab_auteurs', 'tab_recits_v3.id_auteur = tab_auteurs.id_auteur');

        if ($idrec === false) {
            return $this->findAll();
        }

        return $this->where(['id_recit' => $idrec])->first();
    }

}

class ModelRecitFormulaire extends Model {

    protected $table = 'tab_recits_v3';
    protected $allowedFields = ['id_recit', 'titre'];

    // TOUT LES attribue sont selectionné
    public function getRecit()
    {
        
        return $this->asArray()
        ->findAll();

    }

}
