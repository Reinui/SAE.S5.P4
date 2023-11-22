<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />


    <!-- jQuery (ajax) -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Librairie datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.js"></script>

    <!--Fichier de style CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/style.css" media="screen">

</head>

<body>


    <!--Modification de la couleur du fond directement dans le code, non fonctionnel-->
    <style>
    body {
        background-color: #FAEBD7;
    }
    </style>
    <?php
  // Démarrer la session
  $session = \Config\Services::session();
  ?>

    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="<?= site_url() . "map" ?>">Accueil</a>
        <a class="navbar-brand" href="<?= site_url() . "recits" ?>">Liste des récits</a>
    </nav>

    <h1 class=tprinc> Slave narratives <?= $session->get('is_admin') ? '(Connecter)' : '' ?> </h1>
    <h3> Every voice needs to be heard </h3>