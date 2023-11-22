<?php
$session = \Config\Services::session();

$lang = \Config\Services::language();
$lang->setlocale($session->get('locale'));