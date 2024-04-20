<?php

    require("includes/header.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' AND (isset($_POST['search']))){

        if (!empty($_POST['recherche'])){
            $prenomSearch = $_POST['recherche'];

            $reqMot = $database->prepare('SELECT * FROM users WHERE prenom LIKE "%'.$prenomSearch.'%" ORDER BY id DESC');
            $reqMot->execute();

            $countDirecteurNationale = $reqMot->rowCount();
        }

        
    }

    // Backend d'ajout de poste de Comité Directeur Locale)

    if (isset($_POST['update'])){

        if (!empty($_POST['poste'])){

            // Vérifier si il est déja mis dans le service

            $reqComiteDirecteurNational = $database->prepare("SELECT * FROM institutionnationale WHERE id_membre=:id_membre");
            $reqComiteDirecteurNational->bindValue(":id_membre", $_POST['idmembre']);
            $reqComiteDirecteurNational->execute();

            $countComiteDirecteurNational = $reqComiteDirecteurNational->rowCount();

            if ($countComiteDirecteurNational === 0){

                $updateDirecteurNationale = $database->prepare("INSERT INTO institutionnationale(id_membre, entite, poste, service) VALUES(:id_membre, :entite, :poste, :service)");
                $updateDirecteurNationale->bindValue(":entite", $_POST['entite']); // Ligne 26
                $updateDirecteurNationale->bindValue(":id_membre", $_POST['idmembre']); // Ligne 26
                $updateDirecteurNationale->bindValue(":poste", $_POST['poste']);
                $updateDirecteurNationale->bindValue(":service", "Comité Directeur Local");
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
    <h2 class="text-danger">INSTITUTION NATIONALE</h2>
        <?php

            if ($countDirecteurNationale != 0){
                $dataFind = $reqMot->fetch();

                // echo $dataFind['id'];

                $photo = $dataFind['profil'];

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
                                            <p>Type de membre : <span class="text-success fs-5"><?=$dataFind['type_membre']?></span></p>
                                            <p>Profession : <span class="text-success fs-6"><?=$dataFind['profession']?></span></p>
                                            <p>Age : <span class="text-success fs-6"><?=$dataFind['age']?></span></p>
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

                                <label for="">Entité</label>
                                <select name="entite" id="" class="form-control" required>
                                    <option value="">Sélectionner une entité</option>
                                    <option value="Sécrétariat permanent">Sécrétariat permanent</option>
                                    <option value="Administrateur">Administrateur</option>
                                    <option value="Auditeur">Auditeur </option>
                                    <option value="Cabinet du président">Cabinet du président</option>
                                    <option value="Cabinet du président national">Cabinet du président national</option>
                                    <option value="Institution de Formation JCI Bénin">Institution de Formation JCI Bénin</option>
                                    <option value="Fondation JCI Bénin">Fondation JCI Bénin</option>

                                    <option value="Direction nationale de la communication et des relations publiques">Direction nationale de la communication et des relations publiques</option>
                                    <option value="Direction des manifestations officielles">Direction des manifestations officielles</option>

                                </select>
                                <label for="">Poste</label>
                                <input type="text" class="form-control" required name="poste"> 
                                <input type="hidden" name="idmembre" class="form-control" value="<?=$dataFind['id']?>">

                                <button type="submit" class="btn btn-success mt-2" name="update">Attribuer le poste</button>

                                </form>


                            </div>

                        </div>
                    </div>
                <?php
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