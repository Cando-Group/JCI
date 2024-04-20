<?php

	require_once("database/database.php");

	if (isset($_POST['connect'])){

		if (!empty($_POST['username']) && !empty($_POST['password'])){

			$username = $_POST['username'];
			$password = $_POST['password'];

			$reqAdmin = $database->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
			$reqAdmin->bindValue(":username", $username);
			$reqAdmin->bindValue(":password", sha1($password));
			$reqAdmin->execute();

			$countAdmin = $reqAdmin->rowCount();

			if ($countAdmin != 1){
				$error = "Identifiants incorrect";
			}else{
				session_start();
				$_SESSION['username'] = "admin";
				header("Location:ajout");
			}
		}

	}

// echo sha1("password");

?>

<!DOCTYPE html>
<html lang="fr">


<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Meta -->
		<meta name="description" content="Bloom - Responsive Bootstrap 5 Dashboard Template" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="shortcut icon" href="assets/images/favicon.svg" />

		<!-- Title -->
		<title>Connexion - JCI Bénin Center</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

		<!-- Bootstrap font icons css -->
		<link rel="stylesheet" href="assets/fonts/bootstrap/bootstrap-icons.css" />

		<!-- Main css -->
		<link rel="stylesheet" href="assets/css/main.min.css" />

		<!-- Login css -->
		<link rel="stylesheet" href="assets/css/login.html" />

		<!-- Inclure SweetAlert via un lien CDN -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	</head>

	<body class="login-container">
		<!-- Login box start -->

		<?php

			if (isset($error)){
				?>
				<script>
					swal("Oups", "<?=$error?>", "error");
				</script>
				<?php
			}

		?>

		<div class="container">
			<form method="post">
				<div class="login-box rounded-2 p-5">
					<div class="login-form">
						<a href="index" class="login-logo mb-3">
							<img src="assets/images/logo.png" alt="Crowdnub Admin" />
						</a>
						<h5 class="fw-light mb-5">Entrez vos accès pour une connexion au dashboard</h5>
						<div class="mb-3">
							<label class="form-label">Nom d'utilisateur</label>
							<input type="text" class="form-control" placeholder="Entrer votre nom d'utilisateur" name="username" autocomplete="off"/>
						</div>
						<div class="mb-3">
							<label class="form-label">Mot de passe</label>
							<input type="password" class="form-control" placeholder="Entrer votre mot de passe" name="password"/>
						</div>

						<div class="d-grid py-3">
							<button type="submit" name="connect" class="btn btn-lg btn-primary">
								Se connecter
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- Login box end -->
	</body>


</html>