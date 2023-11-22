<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCouches extends Model
{
    protected $table = 'map3';
	protected $allowedFields = ['id', 'ville', 'id_recit','geoj', 'nom_esc', 'label', 'category'];

 
    public function search_adv($data)
	{
		$idr = $this->db->escapeLikeString($data['id_recit']);

        return $this->asArray()
        ->join('tab_recits_v3', 'map3.id_recit = tab_recits_v3.id_recit')
        ->Where(['map3.id_recit' => $idr])
        ->findAll(100);
	}

}

class ModelRoyAfr extends Model
{
    protected $table = 'roy_afr';
	protected $allowedFields = ['id','noms','geoj'];

    public function getRoyAfr()
	{
        return $this->asArray()
        ->findAll(20);
	}
}

 
class ModelAiresAut extends Model
{
    protected $table = 'autoch2';
	protected $allowedFields = ['id','id_style','geoj'];

    public function getAiresAut()
	{
        return $this->asArray()
        ->findAll(40);
	}
}

class ModelPoints extends Model
{
    protected $table = 'points';
	protected $allowedFields = ['id','type','geoj','id_recit', 'nom_esc', 'lien_recit'];

    public function search_pts($data)
	{
		$idr2 = $this->db->escapeLikeString($data['id_recit']);

        return $this->asArray()
        ->join('tab_recits_v3', 'points.id_recit = tab_recits_v3.id_recit')
        ->Where(['points.id_recit'=> $idr2])
        ->findAll();
	}
 


    public function search_place($data)
    {

		$type = $this->db->escapeLikeString($data['type']);

        return $this->asArray()
        ->join('tab_recits_v3', 'points.id_recit = tab_recits_v3.id_recit')
        ->like(['points.type'=> $type])
        ->findAll();

    }




}





class ModelPolygones extends Model
{
    protected $table = 'polygone';
    protected $allowedFields = ['name', 'label', 'category', 'state', 'geoj'];

    public function search_poly($results)
    {
        $resultat = [];

        foreach ($results as $elt) {
            $query2 = $this->db->table('polygone')
                ->where('id', $elt['poly_id'])
                ->get();

            $rows = $query2->getResultArray(); // Utilisez getResultArray() pour obtenir un tableau associatif

            if (!empty($rows)) {
                $row = $rows[0]; // Prenez le premier résultat du tableau (s'il y en a plusieurs)

                $resultat[] = [
                    'poly_id' => $elt['poly_id'],
                    'recit_id' => $elt['recit_id'],
                    'type' => $elt['type'],
                    'name' => $row['name'],
                    'label' => $row['label'],
                    'category' => $row['category'],
                    'state' => $row['state'],
                    'geoj' => $row['geoj']
                ];
            }
        }

        return $resultat;
    }

    public function getPoly()
    {
        return $this->asArray()
        ->findAll();
    }
}




class ModelRecit_poly extends Model
{
    protected $table = 'recit_poly';
    protected $allowedFields = ['recit_id', 'poly_id', 'type'];

    public function search_recit_poly($data)
    {
        $idr = $this->db->escapeLikeString($data['id_recit']);

        return $this->asArray()
            ->where('recit_id', $idr)
            ->like(['recit_poly.recit_id'=> $idr])
            ->findAll();
    }

    public function getRecitPoly()
    {
        return $this->asArray()
        ->findAll();
    }
}

















