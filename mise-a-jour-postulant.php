<?php

    require_once('database/database.php');

    $deletePub = $database->prepare('UPDATE users SET categorie=:categorie, type_membre=:type_membre WHERE id=:id');
    $deletePub->bindvalue(':categorie', "1");
    $deletePub->bindvalue(':type_membre', "1");
    $deletePub->bindvalue(':id', $_GET['id']);
    $deletePub->execute();

    echo "<script type=\"text/javascript\">alert('La mise à jour a été faite');document.location.href='list-postulant.php';</script>";