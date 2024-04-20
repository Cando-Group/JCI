<?php

    require("includes/header.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' AND (isset($_POST['search']))){

        if (!empty($_POST['recherche'])){
            $prenomSearch = $_POST['recherche'];
            $categorie = "1";

            $reqMot = $database->prepare('SELECT * FROM users WHERE prenom LIKE "%'.$prenomSearch.'%" OR categorie LIKE "%'.$categorie.'%" ORDER BY id DESC');
            // Ajouter la condition de si MEMBRE et si non ajouter au comité
            $reqMot->execute();

            $countDirecteurNationale = $reqMot->rowCount();

            // Vérification Ajout au comité

        }

        
    }

    // Backend d'ajout de poste de Comité Directeur National)

    if (isset($_POST['update'])){

        if (!empty($_POST['poste'])){

            // Vérifier si il est déja mis dans le service

            $reqComiteDirecteurNational = $database->prepare("SELECT * FROM comitedirecteurnationale WHERE id_membre=:id_membre");
            $reqComiteDirecteurNational->bindValue(":id_membre", $_POST['idmembre']);
            $reqComiteDirecteurNational->execute();

            $countComiteDirecteurNational = $reqComiteDirecteurNational->rowCount();

            if ($countComiteDirecteurNational === 0){

                $updateDirecteurNationale = $database->prepare("INSERT INTO comitedirecteurnationale(id_membre, poste, service) VALUES(:id_membre, :poste, :service)");
                $updateDirecteurNationale->bindValue(":id_membre", $_POST['idmembre']); // Ligne 26
                $updateDirecteurNationale->bindValue(":poste", $_POST['poste']);
                $updateDirecteurNationale->bindValue(":service", "Comité Directeur Nationale");
                $updateDirecteurNationale->execute(); // Ligne 29

                ?>
                <script>
                    swal("Succès", "Mise à jour faite avec succès", "success")
                </script>
                <?php

            }else{
                
                ?>
                <script>
                    swal("Oups", "Ce membre a déjà été actualisé", "error")
                </script>
                <?php
            }

        }else{
            ?>
            <script>
                swal("Oups", "Veuillez choisir un poste", "error")
            </script>
            <?php
        }

    }


?>

<div class="content-wrapper-scroll">
    
    <div class="content-wrapper">
    <h2 class="text-danger">COMITE DIRECTEUR NATIONAL</h2>
        <?php

            if ($countDirecteurNationale != 0){
                $dataFind = $reqMot->fetch();

                // echo $dataFind['id'];

                $photo = $dataFind['profil'];

                // Type Membre

                $reqTypeMembre = $database->prepare("SELECT * FROM type_membre WHERE id=:id");
                $reqTypeMembre->bindValue(":id", $dataFind['type_membre']);
                $reqTypeMembre->execute();

                $dataTypeMembre = $reqTypeMembre->fetch();

                $type_membre = $dataTypeMembre['name'];

                $reqAjout = $database->prepare("SELECT * FROM comitedirecteurnationale WHERE id_membre=:id_membre");
                $reqAjout->bindValue(":id_membre", $dataFind['id']);
                $reqAjout->execute();

                $countAjout = $reqAjout->rowCount();

                if ($countAjout != 1){
                    ?>
                        <div class="container">
                            <div class="row gx-3">

                                <div class="col-md-12">
                                    <div class="card" style="border:0.1px solid black;">
                                        <p class="text-center mt-2">
                                            <img src="uploads/Membre/<?=$photo?>" alt="Photo" width="250" style="border-radius:20px;">
                                        </p>

                                        <div class="row">

                                            <div class="col-md-6"style="border:1px solid transparent; border-right-color:black;">
                                                <p>Nom : <span class="text-success fs-5"><?=strtoupper($dataFind['nom'])?></span></p>
                                                <p>Prénoms : <span class="text-success fs-5<?=$dataFind['nom']?>"><?=$dataFind['prenom']?></span></p>
                                                <p>Numéro : <span class="text-success fs-5"><?=$dataFind['numero']?></span></p>
                                                <p>Email : <span class="text-success fs-5"><?=$dataFind['email']?></span></p>
                                                <p>Type de membre : <span class="text-success fs-5"><?=$type_membre?></span></p>
                                                <p>Profession : <span class="text-success fs-6"><?=$dataFind['profession']?></span></p>
                                                <p>Age : <span class="text-success fs-6"><?=$dataFind['age']?> ans</span></p>
                                                <p>Adresse : <span class="text-success fs-6"><?=$dataFind['adresse']?></span></p>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <p>Sexe : <span class="text-success fs-6"><?=$dataFind['sexe']?></span></p>
                                                <p>Zone : <span class="text-success fs-6"><?=$dataFind['zone']?></span></p>
                                                <p>Région : <span class="text-success fs-6"><?=$dataFind['region']?></span></p>
                                                <p>Organisation Locale : <span class="text-success fs-6"><?=$dataFind['organi_locale']?></span></p>
                                                <p>Organisation Universitaire : <span class="text-success fs-6"><?=$dataFind['organi_univers']?></span></p>
                                                <p>Organisation Economique : <span class="text-success fs-6"><?=$dataFind['organi_econo']?></span></p>
                                                <p>Situation matrimoniale : <span class="text-success fs-6"><?=$dataFind['situa_matri']?></span></p>
                                                <p>Mentor : <span class="text-success fs-6"><?=$dataFind['mentor']?></span></p>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <!-- Formulaire de mise à jour de poste et de service -->
                                <div class="col-md-12">

                                    <form method="post">

                                        <label for="">Poste</label>
                                        <select name="poste" id="" class="form-control" required>
                                            <option value="">Sélectionner un poste</option>
                                            <option value="Président National - PN">Président National - PN</option>
                                            <option value="Immédiat Past Président - IPP">Immédiat Past Président - IPP</option>
                                            <option value="Vice-Président Exécutif National Zone A  - VPEN Zone A">Vice-Président Exécutif National Zone A  - VPEN Zone A </option>
                                            <option value="Vice-Président Exécutif National Zone B  - VPEN Zone B">Vice-Président Exécutif National Zone B  - VPEN Zone B </option>
                                            <option value="Secrétaire Général National  - SGN">Secrétaire Général National  - SGN</option>
                                            <option value="Conseiller Juridique Général  - CJG">Conseiller Juridique Général  - CJG</option>
                                            <option value="Trésorier Général National  - TGN">Trésorier Général National  - TGN</option>
                                        </select>
                                        <input type="hidden" name="idmembre" class="form-control" value="<?=$dataFind['id']?>">

                                        <button type="submit" class="btn btn-success mt-2" name="update">Attribuer le poste</button>

                                    </form>

                                </div>

                            </div>
                        </div>
                    <?php
                }else{
                    ?>
                    <script>
                        swal("Oups", "Ce membre a déjà été attribué", "error");
                    </script>
                    <?php
                }

                
            }else{

            }

        ?>

        <p class="btn btn-primary mt-3">Recherche des membres</p>

        <p>Veuillez faire une recherche avec le ou les prénoms du membre</p>

        <form method="post">
            <div class="form-group row d-flex">
                <div class="col-md-6">
                    <input type="search" name="recherche" id="" class="form-control" placeholder="Recheche avec le prénom du membre" required="">
                </div>
                <button type="submit" class="btn btn-success col-md-6" name="search">Rechercher</button>
            </div>
        </form>

    
    </div>
</div>

<!-- Faire le formulaire de recherche ici.

LOrsque la recherche est faite, les informations sont affichés dans une autre page si le membre a été trouvé dans la base de donnée avec pour nom ajoutdirecteurnationale.php où les informations sont affichés suivi d'un formulaire d'ajout de poste  -->

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