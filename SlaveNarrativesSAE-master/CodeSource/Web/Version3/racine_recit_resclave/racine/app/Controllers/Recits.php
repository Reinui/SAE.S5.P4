<?php

namespace App\Controllers;
 
use CodeIgniter\Exceptions\PageNotFoundException;
 
class Recits extends BaseController
{
    public function index()
    {

        $model = model(ModelRecit::class);
 
        $data = [
        'recits'  => $model->get5Recits(),
        ];

        return view ('resclaves/header_recit')
        . view ('resclaves/recits',$data)
        . view ('templates/footer_resc');
    }

    public function view($idrec = null)
    {
        $model = model(ModelRecit::class);

        $data['rec'] = $model->getIdRec($idrec);

		if (empty($data['rec'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $idre);
        }

        return view('resclaves/header_recit')
            . view('resclaves/view',$data)
            . view('templates/footer_resc');
    }

}
