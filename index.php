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
			<div class="text-center my-2 mb-3">
				<img class="img-fluid" width="350px" src ="img/logo_transparent.png"  alt="">
			</div>
	</header>

	<main>
		<div class="container">
			<div class="row">
				
				<div class="col-8 col-sm-7 col-md-5 col-lg-4 login">
					<form class="form-group m-3 pt-4">
						<input class="form-control col-auto " type="text" placeholder= "login" onfocus ="this. placeholder='' " onblur="this.placeholder ='login' " >
					
						<input  class="form-control col-auto mt-2" type="password" placeholder= "hasło" onfocus ="this. placeholder='' " onblur="this.placeholder ='hasło' ">
					</form>	

					<div class="d-grid gap-2 col-md-5 col-6 mx-auto">
						<button  class="btn btn-success p-1 fw-bolder fs-6" type="button">
							Zaloguj się
						</button>
					</div>

					<div id="register" class="mt-2 mb-4 text-center">
						Nowy w AZET ? <a href ="rejestracja.php"> Zarejestruj się </a>
					</div>
				</div>
	
			</div>
		</div>
	</main>	

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>