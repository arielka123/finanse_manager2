<?php
	session_start();

	if(isset($_SESSION['zalogowany']))
	{	
		unset($_SESSION['blad']);
		header('Location:"menu_glowne.php"');
		exit();	
	}
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Logowanie w AZET </title>
	<meta name="description" content="Osobisty Budżet Domowy"/>
	<meta name="keywords" content="oszczędzanie, budżet, osobisty"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		
	<link rel="stylesheet" href="logowanie.css" type="text/css"/>
	
</head>

<body>

	<header>
			<div class="text-center my-2 mb-4">
				<img class="img-fluid" width="500px" src ="img/logo_transparent.png"  alt="">
			</div>
	</header>

	<main>
		<div class="container">
			<div class="row">
				
				<div class="col-9 col-md-8 col-lg-5 login">

					<?php
						if(isset($_SESSION['blad'])) 
						{
							echo '<div class="col-12 text-danger text-center h5 mt-4">'.$_SESSION['blad'].'</div>';
							unset($_SESSION['blad']);
						}

						if(isset($_SESSION['udanarejestracja']))
						{	
							echo '<div class="col-12 text-success text-center fw-bolder h5 mt-4">Dziękujemy za rejestrację w serwisie!</div>';
							unset($_SESSION['udanarejestracja']);
						}

						if(isset($_SESSION['fr_username'])) unset($_SESSION['fr_username']);
						if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
						if(isset($_SESSION['fr_password'])) unset($_SESSION['fr_password']);

						//usuwamy błędów rejestracyjnych

						if(isset($_SESSION['e_username'])) unset($_SESSION['e_username']);
						if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
						if(isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
					?>

					<form action="login.php" method="post">
						<div class="form-group m-3 pt-4">

							<input class="form-control col-auto " type="text" name="login" placeholder= "login" onfocus ="this. placeholder='' " onblur="this.placeholder ='login' " >
						
							<input  class="form-control col-auto mt-2" type="password" name="password" placeholder= "hasło" onfocus ="this. placeholder='' " onblur="this.placeholder ='hasło' ">
							
							<input  class="btn btn-success  fw-bolder fs-6 d-grid gap-2  mx-auto my-3 p-2" type="submit" value="Zaloguj się"/>
						</div>
					</form>

					<div id="register" class="col-12 mt-2 mb-4 text-center">
						Nowy w AZET ? <a href ="rejestracja.php"> Zarejestruj się </a>
					</div>
				</div>
	
			</div>
		</div>
	</main>	

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

	    
<?php
	if(isset($_SESSION['blad'])) 
	{
		echo $_SESSION['blad'];
		unset($_SESSION['blad']);
	}
?>

</body>
</html>