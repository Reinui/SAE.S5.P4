<?php namespace App\Controllers;

class Language extends BaseController {
    protected $session;
    protected $language;

    public function __construct() {

        $this->session = \Config\Services::session();
    }

    public function changeLanguage($lang) {
        // Vérifiez que la langue est valide
        $supportedLanguages = ['fr', 'en']; // Ajoutez les langues prises en charge
        if (!in_array($lang, $supportedLanguages)) {
            $lang = $this->request->getLocale();
        }

        // Définir la langue dans la session
        $this->session->set('locale', $lang);
        
        // Rediriger vers la page précédente ou une page spécifique
        return redirect()->to(site_url()); // Redirigez vers la page d'accueil ou une autre page
    }

}