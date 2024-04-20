<?php

    require("includes/header.php");

    $reqComDirecteurNational = $database->prepare("SELECT * FROM comitedirecteurnationale ORDER BY id DESC ");
    $reqComDirecteurNational->execute();



?>

<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">

    <!-- Row start -->
    <div class="row gx-3">

        <h3 class="text-danger">Liste des membres du Comité Directeur National</h3>

        <?php

            while ($dataComDirectNational = $reqComDirecteurNational->fetch()){

                $reqDirectNatInfo = $database->prepare("SELECT * FROM users WHERE id=:id_membre");
                $reqDirectNatInfo->bindValue(":id_membre", $dataComDirectNational['id_membre']);
                $reqDirectNatInfo->execute();

                $dataInfoDirectNational = $reqDirectNatInfo->fetch();

                $photo = $dataInfoDirectNational['profil'];
                $nom = $dataInfoDirectNational['nom'];
                $prenom = $dataInfoDirectNational['prenom'];
                $type_membreID = $dataInfoDirectNational['type_membre'];
                $zone = $dataInfoDirectNational['zone'];
                $region = $dataInfoDirectNational['region'];
                $poste = $dataComDirectNational['poste'];

                $reqTypeMembre = $database->prepare("SELECT * FROM type_membre WHERE id=:id");
                $reqTypeMembre->bindValue(":id", $type_membreID);
                $reqTypeMembre->execute();

                $dataTypeMembreName = $reqTypeMembre->fetch();

                $type_membre = $dataTypeMembreName['name'];

                ?>

                <div class="col-sm-4 col-12">
                    <div class="card card-cover rounded-2">
                        <div class="contact-card">
                        
                        <a href="uploads/Membre/<?=$photo?>"><img src="uploads/Membre/<?=$photo?>" alt="Joyce Admin" class="contact-avatar" /></a>
                        <h5><?=strtoupper($nom)?> <?=$prenom?></h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                            <span>Poste : </span><?=$poste?>
                            </li>
                            <li class="list-group-item">
                            <span>Type de membre : </span><?=$type_membre?>
                            </li>
                            <li class="list-group-item">
                            <span>Zone : </span><?=$zone?>
                            </li>
                            <li class="list-group-item">
                                <span>Région : </span><?=$region?>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>

                <?php

            }

        ?>
        

        
    </div>
    <!-- Row end -->

    
    </div>
    <!-- Content wrapper end -->

</div>

<!-- *************
			************ Required JavaScript Files *************
		************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/modernizr.js"></script>
    <script src="assets/js/moment.js"></script>

    <!-- *************
			************ Vendor Js Files *************
		************* -->

    <!-- Overlay Scroll JS -->
    <script src="assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js"></script>
    <script src="assets/vendor/overlay-scroll/custom-scrollbar.js"></script>

    <!-- News ticker -->
    <script src="assets/vendor/newsticker/newsTicker.min.js"></script>
    <script src="assets/vendor/newsticker/custom-newsTicker.js"></script>

    <!-- Main Js Required -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/validations.js"></script>
  </body>


</html>