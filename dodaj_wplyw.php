<?php 

session_start();

if(!isset($_SESSION['zalogowany']))
{	
	header('Location:"-AZET"');
	exit();	
}

require_once "connect.php";

$connection=@new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno!=0)
{
	echo "Error: ".$connection->connect_errno;
}

else{

$user_id= $_SESSION['userId'];


$sql_query_category_income="SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id='$user_id'";

$result_category_income = $connection->query("$sql_query_category_income");

$connection->close();
}

?>

<!DOCTYPE HTML>
<html lang="pl"> 
<head> 
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>AZET - Twój Osobisty Budżet Domowy</title>
	<meta name= "description" content ="Osobisty Budżet Domowy "/>
	<meta name= "keywords" content=" oszczędzanie, budżet, domowy budżet, saldo, bilans, wydatek, przychód"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome =1"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">	<link rel= "stylesheet" href="menu_glowne.css" type="text/css"/>
	
	<link rel="stylesheet" href="css2/fontello.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700&amp;subset=latin-ext" rel="stylesheet">

	<script src ="present_day.js"></script>

</head>

<body onload="set_today()"  class="d-flex flex-column min-vh-100"> 
	<header>
		<nav class="nav topNav1 navbar navbar-dark navbar-expand-lg p-1"> 
			
				<a href="strona-glowna" class="navbar-brand">  
					<img src ="img/logo_transparent.png" class="d-inline-block ps-2 align-bottom" width=200vw height=auto alt="">
				</a>

				<button class="navbar-toggler order-first" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse offset-xl-1" id="mainmenu">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item px-lg-4  text-sm-left">
								<a href = "dodaj-wydatek" class="nav-link">
									<div class="topMenu"><i class = "icon-edit"></i> Dodaj Wydatek </div>
								</a>
							</li>
							
							<li class="nav-item px-lg-4 text-sm-left">
								<a href = "dodaj-wplyw" class="nav-link active">
									<div class="topMenu"><i class = "icon-edit"></i> Dodaj Przychód </div>
								</a>
							</li>
							
							<li class="nav-item px-lg-4 text-sm-left">
								<a href = "bilans" class="nav-link">
									<div class="topMenu"><i class = "icon-chart-bar"></i> Bilans </div>
								</a>
							</li>
							
							<li class="nav-item px-lg-4 text-sm-left">
								<a href = "ustawienia.php" class="nav-link disabled">
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
						<div class="col-12">
							<header>
								<h1 class="h2 font-weight-bold text-uppercase ml-0 mb-4 mt-5 text-center text-md-left">Tutaj możesz dodać swoje przychody </h1>
							</header>
							<div class="mt-5 p-4 col-lg-6 offset-lg-3 offset-md-1">

								<form action="incomes.php" method="post">	
									
									<?php 

									if(isset($_SESSION['added_income']))
									{

										echo '<div class="col-12 text-success text-center fw-bolder h5 mb-4"> Dodano nowy przychód!</div>';
										unset($_SESSION['added_income']);

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
											<input type="text" class="form-control" name= "amount" id="amount"> 
										</div>
										
									</div>

									
									<?php
										if(isset($_SESSION['e_amount'])) 
										{
										echo  '<div class="col-md-10 col-8 text-danger text-center mb-2">'.$_SESSION['e_amount'].'</div>';
										unset($_SESSION['added_income']);
										unset($_SESSION['e_amount']);
										}
										
									?>
									

																	
									<div class= "row">
										<fieldset class="mb-5 text-center">
												<label class="h5 text-center text-uppercase m-2 pb-2 pt-4 w-100"> Wybierz kategorie przychodu </label>	


												<?php											
										
												while($row = mysqli_fetch_array($result_category_income))
												{
													$name = $row['name'];
													$id = $row['id'];

													
													echo '<div class="form-check form-check-inline"> 
													<input class="form-check-input" type="radio" name ="wplyw" id="radio'.$id.'" value='.$id.' checked>
													<label class="form-check-label" for="radio'.$id.'">'.$name.'</label> 
											   		</div>';
												}																		
												?>
										</fieldset>
									</div>							
									
									<div class= "row">
										<textarea class ="col-12" name="comment" id="comment" rows="4"  maxlength ="30" minlength ="5" placeholder="Dodaj komentarz (opcjonalnie)"></textarea>
									</div>
					
									<div class ="row pt-4">
										<input class="h6 col-auto d-block mx-auto" type="reset" value= "ANULUJ" >	
										<input class="h6 col-auto d-block mx-auto" type="submit" value= "DODAJ" > 
										  
									</div>
									
								</form>
								
							</div>


						</div>
					</div>
				</div>

			</article>
	</main>
	
	<footer class="mt-auto">
		<div class="card">
		 <div class ="card-footer text-center text-muted pt-3">  
					<p>Wszelkie prawa zastrzeżone &copy; </p>
			</div>
		</div>
	</footer>
	
	
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