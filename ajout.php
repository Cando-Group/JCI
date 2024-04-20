<?php

    require("includes/header.php");

    // Recup valeur en GET

    if (isset($_GET['id']) && $_GET['type'] === "modif"){
        $idModif = $_GET['id'];
    }

    // Insertion Process

    if (isset($_POST['submit'])){

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $numero = $_POST['numero'];
        $email = $_POST['email'];
        $categorie = $_POST['categorie'];
        $type = $_POST['type'];
        // $poste = $_POST['poste'];
        $profession = $_POST['profession'];
        $age = $_POST['age'];
        $sexe = $_POST['sexe'];
        $zone = $_POST['zone'];
        $adresse = $_POST['adresse'];
        $region = $_POST['region'];
        $organilocale = $_POST['organilocale'];
        $organiunivers = $_POST['organiunivers'];
        $organiecono = $_POST['organiecono'];
        $situamatri = $_POST['situamatri'];
        $mentor = $_POST['mentor'];
        $photo = $_FILES['photo'];

        if (!empty($nom) && !empty($prenom) && !empty($numero) && !empty($email) && !empty($categorie) && !empty($type) && !empty($profession) && !empty($age) && !empty($sexe) && !empty($zone) && !empty($region) && !empty($situamatri) && !empty($mentor) && !empty($photo)){

            if ($categorie === 2 && $type === 6){
                // A REVOIR A CET NIVEAUU
                ?>
                <script>
                    swal("Erreur", "Vous n'êtes pas encore un membre de la JCI", "error")
                </script>
                <?php
            }else{

                // Calcule de l'âge

                $date_naissance_obj = new DateTime($age);
                $date_actuelle = new DateTime();
                $différence = $date_actuelle->diff($date_naissance_obj);
                $age_vrai = $différence->y;

                if ($age_vrai >= 18 && $age_vrai <= 40){
                    
                    $reqUsers = $database->prepare("SELECT * FROM users WHERE nom=:nom AND prenom=:prenom AND statut=:statut");
                    $reqUsers->bindValue(":nom", $nom);
                    $reqUsers->bindValue(":prenom", $prenom);
                    $reqUsers->bindValue(":statut", 1);
                    $reqUsers->execute();

                    $countUsers = $reqUsers->rowCount();

                    if ($countUsers){

                        ?>
                        <script>
                            swal("Oups", "Ce membre figure déjà dans la base de donnée", "error")
                        </script>
                        <?php

                    }else{

                        // ID à Générer

                        function token_random_string($leng=40){

                            $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $token = '';
                            for ($i=0;$i<$leng;$i++){
                                $token.=$str[rand(0, strlen($str)-1)];
                            }
                            return $token;
                        }

                        $token = token_random_string(10);

                        // 1. Nom de l'img
                        $name_image = $_FILES['photo']['name'];
                                
                        //2. Le dossier où se trouve l'img
                        $temporaire = $_FILES['photo']['tmp_name'];
                    
                        //3. extension de notre image
                        $extens =strrchr($name_image, '.');
                    
                        //4.Extension autoriser
                        $autoriser = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG', '.webp', '.WEBP');
                    
                        //5.dossier de destination
                        $destination = 'uploads/Membre/'.$name_image;

                        if (in_array($extens, $autoriser)){

                            if (move_uploaded_file($temporaire, $destination)){

                                // Enfin !

                                $insertUsers = $database->prepare("INSERT INTO users (unique_id, nom, prenom, numero, email, categorie, type_membre, profession, age, sexe, zone, adresse, region, organi_locale, organi_univers, organi_econo, mentor, situa_matri, profil, statut) VALUES(:unique_id, :nom, :prenom, :numero, :email, :categorie, :type_membre, :profession, :age, :sexe, :zone, :adresse, :region, :organi_locale, :organi_univers, :organi_econo, :mentor, :situa_matri, :profil, :statut)");
                                $insertUsers->bindValue(":unique_id", $token);
                                $insertUsers->bindValue(":nom", $nom);
                                $insertUsers->bindValue(":prenom", $prenom);
                                $insertUsers->bindValue(":numero", $numero);
                                $insertUsers->bindValue(":email", $email);
                                $insertUsers->bindValue(":categorie", $categorie);
                                $insertUsers->bindValue(":type_membre", $type);
                                $insertUsers->bindValue(":profession", $profession);
                                $insertUsers->bindValue(":age", $age_vrai);
                                $insertUsers->bindValue(":sexe", $sexe);
                                $insertUsers->bindValue(":zone", $zone);
                                $insertUsers->bindValue(":adresse", $adresse);
                                $insertUsers->bindValue(":region", $region);
                                $insertUsers->bindValue(":organi_locale", $organilocale);
                                $insertUsers->bindValue(":organi_univers", $organiunivers);
                                $insertUsers->bindValue(":organi_econo", $organiecono);
                                $insertUsers->bindValue(":mentor", $mentor);
                                $insertUsers->bindValue(":situa_matri", $situamatri);
                                $insertUsers->bindValue(":profil", $name_image);
                                $insertUsers->bindValue(":statut", 1); // Demander confirmation pour le statut
                                $insertUsers->execute();

                                ?>
                                <script>
                                    swal("BRAVO", "Membre enrégistrer avec succès!", "success");
                                </script>
                                <?php

                                

                            }

                        }

                        

                    }

                }else{
                    ?>
                    <script>
                        swal("Oups", "Votre âge doit être compris entre 18 et 40 ans", "error")
                    </script>
                    <?php
                }


            }

            

        }else{
            ?>
            <script>
                swal("Oups", "Veuillez remplir tous les champs", "error");
            </script>
            <?php
        }

    }

    if (isset($_POST['updateUsers'])){

        $categorie = $_POST['categorie'];
        $type = $_POST['type'];
        // $poste = $_POST['poste'];
        $profession = $_POST['profession'];
        $adresse = $_POST['adresse'];
        $situamatri = $_POST['situamatri'];
        $photo = $_FILES['photo'];

        if (!empty($categorie) && !empty($type) && !empty($profession) && !empty($adresse) && !empty($situamatri) && !empty($photo)){

            // 1. Nom de l'img
            $name_image = $_FILES['photo']['name'];
                        
            //2. Le dossier où se trouve l'img
            $temporaire = $_FILES['photo']['tmp_name'];
        
            //3. extension de notre image
            $extens =strrchr($name_image, '.');
        
            //4.Extension autoriser
            $autoriser = array('.png', '.PNG', '.jpg', '.JPG', '.jpeg', '.JPEG', '.webp', '.WEBP');
        
            //5.dossier de destination
            $destination = 'uploads/Membre/'.$name_image;

            if (in_array($extens, $autoriser)){

                if (move_uploaded_file($temporaire, $destination)){

                    // Enfin !

                    $insertUsers = $database->prepare("
                    UPDATE users 
                    SET 
                        categorie = :categorie, 
                        type_membre = :type_membre, 
                        profession = :profession,  
                        adresse = :adresse, 
                        situa_matri = :situa_matri, 
                        profil = :profil, 
                        statut = :statut
                    WHERE id = :id");
                    $insertUsers->bindValue(":categorie", $categorie);
                    $insertUsers->bindValue(":type_membre", $type);
                    $insertUsers->bindValue(":profession", $profession);
                    $insertUsers->bindValue(":adresse", $adresse);
                    $insertUsers->bindValue(":situa_matri", $situamatri);
                    $insertUsers->bindValue(":profil", $name_image);
                    $insertUsers->bindValue(":statut", 1); // Demander confirmation pour le statut
                    $insertUsers->bindValue(":id", $idModif);
                    $insertUsers->execute();

                    ?>
                    <script>
                        swal("BRAVO", "Membre mise à jour avec succès!", "success");
                    </script>
                    <?php

                    

                }

            }

        }else{
            ?>
            <script>
                swal("Oups", "Veuillez remplir tous les champs", "error");
            </script>
            <?php
        }

    }

?>

        <!-- Content wrapper scroll start -->
        <div class="content-wrapper-scroll">


          <!-- Content wrapper start -->
          <div class="content-wrapper">

            <?php

                if (isset($_GET['id']) && $_GET['type'] === "modif"){

                    $idModif = $_GET['id'];

                    $reqUsersModify = $database->prepare("SELECT * FROM users WHERE id=:id");
                    $reqUsersModify->bindValue(":id", $idModif);
                    $reqUsersModify->execute();

                    $dataModifyUsers = $reqUsersModify->fetch();

                    ?>
                    <form method="post" enctype="multipart/form-data">

                        <!-- Row start -->
                        <div class="row gx-3">

                            <?php

                                $reqCategorie = $database->prepare("SELECT * FROM categorie");
                                $reqCategorie->execute();

                            ?>

                            <!-- Catégorie -->
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Catégorie</label>
                                    <select class="form-select" id="validationCustom04" required="" name="categorie">
                                        <option selected="" disabled="" value="">
                                        Choisir  une catégorie
                                        </option>
                                        <option value="1" selected="">Membre</option>
                                        <?php
                                            while ($dataCAtegorie = $reqCategorie->fetch()){
                                                ?>
                                                <option value="<?=$dataCAtegorie['id']?>"><?=$dataCAtegorie['name']?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Chosissez une catégorie
                                    </div>
                                    <div class="valid-feedback">
                                        Catégorie Validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <?php

                                $reqtype = $database->prepare("SELECT * FROM type_membre");
                                $reqtype->execute();

                            ?>

                            <!-- Type de membre -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Type de membre</label>
                                    <select class="form-select" id="validationCustom04" required="" name="type">
                                        <option selected="" disabled="" value="">
                                        Choisir  un type de membre
                                        </option>
                                        <option value="Pas encore membre">Pas encore Membre</option>
                                        <?php
                                            while ($dataType = $reqtype->fetch()){
                                                ?>
                                                <option value="<?=$dataType['id']?>"><?=$dataType['name']?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Chosissez un type de membre
                                    </div>
                                    <div class="valid-feedback">
                                        Type de membre Validé
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <?php

                                $reqposte = $database->prepare("SELECT * FROM poste");
                                $reqposte->execute();

                            ?>

                            <!-- Profession -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                        <label for="validationCustom01" class="form-label">Profession</label>
                                        <input type="text" class="form-control" id="validationCustom01" required="" name="profession" value="<?=$dataModifyUsers['profession']?>"/>
                                        <div class="valid-feedback">Profession validée</div>
                                        <div class="invalid-feedback">
                                            Entrez votre profession
                                        </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" required="" name="adresse" value="<?=$dataModifyUsers['adresse']?>">
                                    <div class="invalid-feedback">
                                        Définissez une adresse
                                    </div>
                                    <div class="valid-feedback">
                                        Adresse validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Situation matrimoniale -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Situation matrimoniale</label>
                                    <select class="form-select" id="validationCustom04" required="" name="situamatri">
                                        <option selected="" disabled="" value="">
                                        Choisir une option
                                        </option>
                                        <option value="<?=$dataModifyUsers['situa_matri']?>" selected=""><?=$dataModifyUsers['situa_matri']?></option>
                                        <option value="Célibataire sans enfant">Célibataire sans enfant</option>
                                        <option value="Célibataire avec enfant">Célibataire avec enfant</option>
                                        <option value="Marier sans enfant">Marier sans enfant</option>
                                        <option value="Marier avec enfant">Marier avec enfant</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Faïtes un choix
                                    </div>
                                    <div class="valid-feedback">
                                        Situation matrimoniale validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>


                            <!-- Photo de profil -->

                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <input type="file" class="form-control" aria-label="file example" required="" name="photo"/>
                                    <div class="invalid-feedback">
                                        Chosissez une photo de profil
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Submit -->

                            <hr />
                            <!-- Row start -->
                            <div class="row gx-3">
                                <div class="col-sm-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="reset" class="btn btn-outline-secondary">
                                        Retour
                                        </button>
                                        <button type="submit" name="updateUsers" class="btn btn-success">
                                        Mettre à jour
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->


                        </div>
                        <!-- Row end -->

                        </form>
                    <?php
// Ajout simple
                }else{
                    ?>
                    <form method="post" enctype="multipart/form-data">

                        <!-- Row start -->
                        <div class="row gx-3">

                            <!-- Nom -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom01" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="validationCustom01" required="" name="nom" />
                                    <div class="valid-feedback">Nom validé</div>
                                        <div class="invalid-feedback">
                                            Entrez un nom
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Prénoms -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div>
                                    <div class="was-validated">
                                        <label for="validationCustom02" class="form-label">Prénoms</label>
                                        <input type="text" class="form-control" id="validationCustom02" required="" name="prenom"/>
                                        <div class="valid-feedback">Prénoms validé</div>
                                        <div class="invalid-feedback">
                                        Entrez vos prénoms
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Numéro -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div>
                                    <div class="was-validated">
                                        <label for="validationCustom02" class="form-label">Numéro</label>
                                        <input type="tel" class="form-control" id="validationCustom02" required="" name="numero" />
                                        <div class="valid-feedback">Numéro validé</div>
                                        <div class="invalid-feedback">
                                        Entrez votre numéro
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Email -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div>
                                    <div class="was-validated">
                                        <label for="validationCustom02" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="validationCustom02" required="" name="email"/>
                                        <div class="valid-feedback">Email validé</div>
                                        <div class="invalid-feedback">
                                        Entrez votre email
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <?php

                                $reqCategorie = $database->prepare("SELECT * FROM categorie");
                                $reqCategorie->execute();

                            ?>

                            <!-- Catégorie -->
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Catégorie</label>
                                    <select class="form-select" id="validationCustom04" required="" name="categorie">
                                        <option selected="" disabled="" value="">
                                        Choisir  une catégorie
                                        </option>
                                        <?php
                                            while ($dataCAtegorie = $reqCategorie->fetch()){
                                                ?>
                                                <option value="<?=$dataCAtegorie['id']?>"><?=$dataCAtegorie['name']?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Chosissez une catégorie
                                    </div>
                                    <div class="valid-feedback">
                                        Catégorie Validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <?php

                                $reqtype = $database->prepare("SELECT * FROM type_membre");
                                $reqtype->execute();

                            ?>

                            <!-- Type de membre -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Type de membre</label>
                                    <select class="form-select" id="validationCustom04" required="" name="type">
                                        <option selected="" disabled="" value="">
                                        Choisir  un type de membre
                                        </option>
                                        <?php
                                            while ($dataType = $reqtype->fetch()){
                                                ?>
                                                <option value="<?=$dataType['id']?>"><?=$dataType['name']?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Chosissez un type de membre
                                    </div>
                                    <div class="valid-feedback">
                                        Type de membre Validé
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <?php

                                $reqposte = $database->prepare("SELECT * FROM poste");
                                $reqposte->execute();

                            ?>

                            <!-- Profession -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                        <label for="validationCustom01" class="form-label">Profession</label>
                                        <input type="text" class="form-control" id="validationCustom01" required="" name="profession"/>
                                        <div class="valid-feedback">Profession validée</div>
                                        <div class="invalid-feedback">
                                            Entrez votre profession
                                        </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Age -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                        <label for="validationCustom01" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control" id="validationCustom01" required="" name="age" min="18" max="40"/>
                                        
                                        <div class="invalid-feedback">
                                            Entrez votre date de naissance
                                        </div>
                                        <div class="valid-feedback">
                                            Date de naissance validée
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Sexe -->
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Sexe</label>
                                    <select class="form-select" id="validationCustom04" required="" name="sexe">
                                        <option selected="" disabled="" value="">
                                        Choisir  un sexe
                                        </option>
                                        <option value="Masculin">Masculin</option>
                                        <option value="Féminin">Féminin</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Chosissez un sexe
                                    </div>
                                    <div class="valid-feedback">
                                        Choix du sexe validé
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Zone  -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Zone</label>
                                    <select class="form-select" id="validationCustom04" required="" name="zone">
                                        <option selected="" disabled="" value="">
                                        Choisir  une zone
                                        </option>
                                        <option value="Zone A">Zone A</option>
                                        <option value="Zone B">Zone B</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Chosissez une zone
                                    </div>
                                    <div class="valid-feedback">
                                        Choix de la zone validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Région -->
                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Région</label>
                                    <select class="form-select" id="validationCustom04" required="" name="region">
                                        <option selected="" disabled="" value="">
                                        Choisir  une région
                                        </option>
                                        <option value="Région 1">Région 1</option>
                                        <option value="Région 2">Région 2</option>
                                        <option value="Région 3">Région 3</option>
                                        <option value="Région 4">Région 4</option>
                                        <option value="Région 5">Région 5</option>
                                        <option value="Région 6">Région 6</option>
                                        <option value="Région 7">Région 7</option>
                                        <option value="Région 8">Région 8</option>
                                        <option value="Région 9">Région 9</option>
                                        <option value="Région 10">Région 10</option>
                                        <option value="Région 11">Région 11</option>
                                        <option value="Région 12">Région 12</option>
                                        <option value="Région 13">Région 13</option>
                                        <option value="Région 14">Région 14</option>
                                        <option value="Région 15">Région 15</option>
                                        <option value="Région 16">Région 16</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Chosissez une région
                                    </div>
                                    <div class="valid-feedback">
                                        Choix de la région validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- Adresse -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" required="" name="adresse">
                                    <div class="invalid-feedback">
                                        Définissez une adresse
                                    </div>
                                    <div class="valid-feedback">
                                        Adresse validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Organisation locale -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                        <label for="validationCustom01" class="form-label">Organisation locale</label>
                                        <input type="text" class="form-control" id="validationCustom01"  name="organilocale"/>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                        <label for="validationCustom01" class="form-label">Organisation Universitaire</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="organiunivers"/>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                        <label for="validationCustom01" class="form-label">Organisation Economique</label>
                                        <input type="text" class="form-control" id="validationCustom01"  name="organiecono"/>
                                        
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Situation matrimoniale -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <label for="validationCustom04" class="form-label">Situation matrimoniale</label>
                                    <select class="form-select" id="validationCustom04" required="" name="situamatri">
                                        <option selected="" disabled="" value="">
                                        Choisir une option
                                        </option>
                                        <option value="Célibataire sans enfant">Célibataire sans enfant</option>
                                        <option value="Célibataire avec enfant">Célibataire avec enfant</option>
                                        <option value="Marier sans enfant">Marier sans enfant</option>
                                        <option value="Marier avec enfant">Marier avec enfant</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Faïtes un choix
                                    </div>
                                    <div class="valid-feedback">
                                        Situation matrimoniale validée
                                    </div>

                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Mentor -->

                            <div class="col-xl-4 col-sm-6 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                        <label for="validationCustom01" class="form-label">Nom et prénom du Mentor</label>
                                        <input type="text" class="form-control" id="validationCustom01" required="" name="mentor"/>
                                        
                                        <div class="invalid-feedback">
                                            Entrez le nom et prénom du mentor
                                        </div>
                                        <div class="valid-feedback">
                                            Nom et prénom du Mentor
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Photo de profil -->

                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="was-validated">
                                    <input type="file" class="form-control" aria-label="file example" required="" name="photo"/>
                                    <div class="invalid-feedback">
                                        Chosissez une photo de profil
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Submit -->

                            <hr />
                            <!-- Row start -->
                            <div class="row gx-3">
                                <div class="col-sm-12">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="reset" class="btn btn-outline-secondary">
                                        Retour
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-success">
                                        Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Row end -->


                        </div>
                        <!-- Row end -->

                        </form>
                    <?php
                }

            ?>

          </div>
          <!-- Content wrapper end -->

        </div>
        <!-- Content wrapper scroll end -->

        <!-- App Footer start -->
        <!-- <div class="app-footer">
          <span>© Bootstrap Gallery 2024</span>
        </div> -->
        <!-- App footer end -->

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
    <script src="assets/js/validations.js"></script>
  </body>


</html>