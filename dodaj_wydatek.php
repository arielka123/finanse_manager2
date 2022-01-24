<?php 

session_start();

if(!isset($_SESSION['zalogowany']))
{	
	header('Location:"Witaj-w-AZET"');
	exit();	
}

?>


<!DOCTYPE HTML>
<html lang="pl"> 
<head> 
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>AZET - Twój Osobisty Budżet Domowy</title>
	<meta name = "description" content ="Osobisty Budżet Domowy "/>
	<meta name= "keywords" content=" oszczędzanie, budżet, domowy budżet, saldo, bilans, wydatek, przychód"/>
	<meta http-equiv ="X-UA-Compatible" content  = "IE=edge,chrome =1"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">	<link rel= "stylesheet" href="menu_glowne.css" type="text/css"/>
	
	<link rel="stylesheet" href="css2/fontello.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700&amp;subset=latin-ext" rel="stylesheet">

	<script src ="present_day.js"></script>

</head>

<body onload="set_today()"> 
	<header>
		<nav class="nav topNav1 navbar navbar-dark navbar-expand-lg p-1"> 
			
				<a href="menu_glowne.php" class="navbar-brand">  
					<img src ="img/logo_transparent.png" class="d-inline-block ps-2 align-bottom" width=200vw height=auto alt="">
				</a>

				<button class="navbar-toggler order-first" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse offset-xl-1" id="mainmenu">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item px-lg-4  text-sm-left">
								<a href = "dodaj-wydatek" class="nav-link active">
									<div class="topMenu"><i class = "icon-edit"></i> Dodaj Wydatek </div>
								</a>
							</li>
							
							<li class="nav-item px-lg-4 text-sm-left">
								<a href = "dodaj-wplyw" class="nav-link">
									<div class="topMenu"><i class = "icon-edit"></i> Dodaj Przychód </div>
								</a>
							</li>
							
							<li class="nav-item px-lg-4 text-sm-left">
								<a href = "bilans" class="nav-link">
									<div class="topMenu"><i class = "icon-chart-bar"></i> Bilans </div>
								</a>
							</li>
							
							<li class="nav-item px-lg-4 text-sm-left">
								<a href = "ustawienia" class="nav-link disabled">
									<div class="topMenu"><i class = "icon-cogs"></i> Ustawienia </div>
								</a>
							</li>
			
							<li class="nav-item px-lg-4 text-sm-left">
								<a href="logout.php" class="nav-link">
									<div class="topMenu"><i class = "icon-power"></i>Wyloguj</div>
								</a>
							</li>
						</ul>
				</div>
		</nav>

	</header>
	
	<main>
			<article>
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12">
							<header>
								<h1 class="h2 font-weight-bold text-uppercase ml-0 mb-4 mt-5 text-center text-md-left">Tutaj możesz dodać swoje wydatki </h1>
							</header>
							<form action="expenses.php" method="post" enctype="multipart/form-data">
								<div class="mt-5 p-4 col-lg-6 offset-lg-3 offset-md-1">

								<?php 

								if(isset($_SESSION['added_expense']))
								{

									echo '<div class="col-12 text-success text-center fw-bolder h5 mb-4"> Dodano nowy wydatek!</div>';
									unset($_SESSION['added_expense']);
									unset($_SESSION['e_amount']);

									//header( "refresh:2;url=dodaj_wydatek.php" );
								}
								?>

									<div class= "form-group row pb-3">
										<label for ="today" class="h6 offset-md-2 text-u col-form-label col-sm-2 ps-2"> Data</label>
										<div class="col col-sm-4">
											<input type="date"  id = "today" class="form-control" name="date" readonly>
										</div>
									</div>	
																		
									<div class = "form-group row pb-3">
										<label for ="kwota" class="h6 offset-md-2 col-form-label col-sm-2 ps-2"> Kwota </label>
										<div class="col col-sm-4">
											<input type="text" class="form-control" name= "amount" id="amount" require> 
										</div>
									</div>
																	
									<div class= "row">
										<fieldset class="mb-5 text-md-center text-left">
											<label class="h5 text-center text-uppercase m-2 pb-2 pt-4 w-100">Wybierz sposób płatności</label>	

											<div class="form-check form-check-inline"> 
												<input class="form-check-input" type="radio" name ="platnosc" id="radioP1" value="1" checked>
												<label class="form-check-label" for="radioP1"> Gotówka </label> 
											</div>

											<div class="form-check form-check-inline"> 
												<input class="form-check-input" type="radio" name ="platnosc" id="radioP2" value="2">
												<label class="form-check-label" for="radioP2"> Karta debetowa</label>
											</div>

											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name ="platnosc" id="radioP3" value="3"> 
												<label class="form-check-label" for="radioP3"> Karta kredytowa </label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" name ="platnosc" id="radioP4" value="1"> 
												<label class="form-check-label" for="radioP4"> Inne </label> 
											</div>
										</fieldset>
									</div>
								</div>

								<div class= "row">
									<div class="col-sm-12 mb-5">
											<label class="h5 text-center text-uppercase pb-2 w-100"> Wybierz kategorie wydatku </label>		
		
											<div class="col_radio col-auto d-md-inline-block  offset-md-2 offset-lg-3 offset-xl-4">
												<div class="form-check">
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW1" value="3" checked>
													<label for="radioW1" class="form-check-label"> Jedzenie  </label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW2" value="4">
													<label for="radioW2" class="form-check-label"> Mieszkanie </label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW3" value="1">
													<label for="radioW3" class="form-check-label"> Transport </label> 
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW4" value="5">
													<label for="radioW4" class="form-check-label"> Telekomunikacja </label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW5" value="6">
													<label for="radioW5" class="form-check-label"> Opieka zdrowotna </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW6" value="7">
													<label for="radioW6" class="form-check-label"> Ubranie </label>
												</div>
											</div>
											
											<div class="col_radio col-auto d-md-inline-block">

												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW7" value="8">
													<label for="radioW7" class="form-check-label"> Higiena </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW8" value="9">
													<label for="radioW8" class="form-check-label"> Dzieci </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW9" value="10">
													<label for="radioW9" class="form-check-label"> Rozrywka </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW10" value="11">
													<label for="radioW10" class="form-check-label"> Wycieczka </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW11" value="17">
													<label for="radioW11" class="form-check-label">  Szkolenia </label>
												</div>
											</div>
											
											<div class="col_radio col-auto d-md-inline-block">
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW12" value="2">
													<label for="radioW12" class="form-check-label"> Książki</label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW13" value="12">
													<label for="radioW13" class="form-check-label"> Oszczędności  </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW14" value="13">
													<label for="radioW14" class="form-check-label"> Na złotą jesień, czyli emeryturę  </label>
												</div>
												<div>
													<input class="form-check-input"  type="radio" name ="wydatek" id="radioW15" value="14">
													<label for="radioW15" class="form-check-label"> Spłata długów </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW16" value="15">
													<label for="radioW16" class="form-check-label"> Darowizna </label>
												</div>
												<div>
													<input class="form-check-input" type="radio" name ="wydatek" id="radioW17" value="16">
													<label for="radioW17" class="form-check-label">Inne wydatki</label>
												</div>
											</div>

									</div>
								</div>					
									
								<div class= "row">
										<textarea class ="col-md-6 col-10 offset-1 offset-md-3" name="komentarz" id="komentarz" rows="4"  maxlength ="30" minlength ="5" placeholder="Dodaj komentarz (opcjonalnie)"></textarea>
								</div>
							
								<div class ="row pt-4">
									<input class="h6 col-auto d-block mx-auto" type="submit" value= "DODAJ"> 
									<input class="h6 col-auto d-block mx-auto" type="reset" value= "ANULUJ"> 
								</div>		
							</form>
						</div>
					</div>
				</div>

			</article>
	</main>
	
	
	<!-- <footer>
		<div class ="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
				<p class="text-dark">Wszelkie prawa zastrzeżone &copy; </p>
		</div>
	</footer> -->
	
 <!-- <script src="jquery-1.11.3.min.js"></script>
	
<script>

	$(document).ready(function() {
	var NavY = $('.nav').offset().top;
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('.nav').addClass('sticky');
	} else {
		$('.nav').removeClass('sticky'); 
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	});
	
</script> -->
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
		
	
</body>
</html>