<?php

    require("includes/header.php");

    // Recueils des users

    $reqUsers = $database->prepare("SELECT * FROM users ORDER BY id DESC");
    $reqUsers->execute();
    

    // Recueil des catégories
    

    // Recueils du type de membe


?>

        <!-- Content wrapper scroll start -->
        <div class="content-wrapper-scroll">

          <!-- Content wrapper start -->
          <div class="content-wrapper">

            <div class="row gx-3">

            <h3>Liste des Postulants de la JCI</h3>

              <div class="col-sm-12 col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table nowrap m-0">
                        <thead>
                          <tr>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Prénoms</th>
                            <th>Numéro</th>
                            <th>Email</th>
                            <th>Catégorie</th>
                            <th>Type</th>
                            <th>Profession</th>
                            <th>Age</th>
                            <th>Adresse</th>
                            <th>Sexe</th>
                            <th>Zone</th>
                            <th>Région</th>
                            <th>Organisation Locale</th>
                            <th>Organisation Universitaire</th>
                            <th>Organisation Economique</th>
                            <th>Situation matrimoniale</th>
                            <th>Mentor</th>
                            <th>Date d'inscription</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php

                                while ($dataUsers = $reqUsers->fetch()){

                                    $reqCategorie = $database->prepare("SELECT * FROM categorie WHERE id=:id");
                                    $reqCategorie->bindValue(":id", $dataUsers['categorie']);
                                    $reqCategorie->execute();

                                    // $dataCategorie = $reqCategorie->fetch();

                                    // $categorie = $dataCategorie['name']; //Ligne 69 

                                    if ($reqCategorie->rowCount() > 0) {
                                        $dataCategorie = $reqCategorie->fetch();
                                        $categorie = $dataCategorie['name'];
                                    } else {
                                        $categorie = "Catégorie non définie"; // ou une autre valeur par défaut
                                    }
                                    

                                    // Type Membre

                                    // if ($dataUsers['type_membre'] === 'Pas encore Membre'){
                                    //     $type = "Pas encore Membre";
                                    // }else{
                                    //     $reqType = $database->prepare("SELECT * FROM type_membre WHERE id=:id");
                                    //     $reqType->bindValue(":id", $dataUsers['type_membre']);
                                    //     $reqType->execute();

                                    //     $dataType = $reqType->fetch();

                                    //     $type = $dataType['name'];
                                    // }

                                    $reqType = $database->prepare("SELECT * FROM type_membre WHERE id=:id");
                                    $reqType->bindValue(":id", $dataUsers['type_membre']);
                                    $reqType->execute();
                                    
                                    if ($reqType->rowCount() > 0) {
                                        $dataType = $reqType->fetch();
                                        $type = $dataType['name'];
                                    } else {
                                        $type = "Type de membre non défini"; // ou une autre valeur par défaut
                                    }
                                    
                                    $photo = $dataUsers['profil'];

                                    if ($categorie === "Postulant" ){

                                        ?>
                                        <tr>
                                            <td><a href="uploads/Membre/<?=$photo?>"><img src="uploads/Membre/<?=$photo?>" alt="Photo de profil de <?=$dataUsers['nom']?>" style="width:50px;height:50px;border-radius:50px;"></a></td>
                                            <td><?=$dataUsers['nom']?></td>
                                            <td><?=$dataUsers['prenom']?></td>
                                            <td><?=$dataUsers['numero']?></td>
                                            <td><?=$dataUsers['email']?></td>
                                            <td><?=$categorie?></td>
                                            <td><?=$type?></td>
                                            <td><?=$dataUsers['profession']?></td>
                                            <td><?=$dataUsers['age']?> ans</td>
                                            <td><?=$dataUsers['adresse']?></td>
                                            <td><?=$dataUsers['sexe']?></td>
                                            <td><?=$dataUsers['zone']?></td>
                                            <td><?=$dataUsers['region']?></td>
                                            <td><?=$dataUsers['organi_locale']?></td>
                                            <td><?=$dataUsers['organi_univers']?></td>
                                            <td><?=$dataUsers['organi_econo']?></td>
                                            <td><?=$dataUsers['situa_matri']?></td>
                                            <td><?=$dataUsers['mentor']?></td>
                                            <td><?=$dataUsers['date']?></td>
                                            <td>
                                                <a href="mise-a-jour-postulant?id=<?=$dataUsers['id']?>" class="btn btn-success">Mettre à jour</a>
                                            </td>
                                        </tr>
                                        <?php

                                    }

                                    ?>

                                    
                                    
                                    <?php

                                }

                            ?>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           

            </div>
          <!-- Content wrapper end -->

        </div>
        <!-- Content wrapper scroll end -->


      </div>
      <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

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
  </body>


</html>