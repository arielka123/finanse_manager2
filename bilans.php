<!DOCTYPE HTML>
<html lang="pl"> 
<head> 
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title> AZET - Twój Osobisty Budżet Domowy  </title>
	<meta name="description" content ="Osobisty Budżet Domowy "/>
	<meta name="keywords" content=" oszczędzanie, budżet, domowy budżet, saldo, bilans, wydatek, przychód"/>
	<meta http-equiv="X-UA-Compatible" content  = "IE=edge,chrome =1"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">	<link rel= "stylesheet" href="menu_glowne.css" type="text/css"/>
	
	<link rel="stylesheet" href="css2/fontello.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700&amp;subset=latin-ext" rel="stylesheet">

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Kategoria', 'wydatki(w zł)'],
          ['Kategoria1',  199],
          ['Kategoria2',  786],
          ['Kategoria3', 150],
          ['Kategoria4', 234]
        ]);

      var options = {
        legend: 'none',
        pieSliceText: 'label',
        // title: 'Twoje wydatki w danym okresie',
        pieStartAngle: 100,
      };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>

</head>

<body> 
	<header>
		<nav class="nav topNav1 navbar navbar-dark navbar-expand-lg p-1"> 
			
				<a href="menu_glowne.php" class="navbar-brand">  
					<img src ="img/logo_transparent.png" class="d-inline-block align-bottom" width=200vw height=auto alt="">
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
								<a href = "dodaj-wplyw" class="nav-link">
									<div class="topMenu"><i class = "icon-edit"></i> Dodaj Przychód </div>
								</a>
							</li>
							
							<li class="nav-item px-lg-4 text-sm-left">
								<a href = "bilans" class="nav-link active">
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
									<header>
										<h1 class="h2 font-weight-bold text-uppercase ml-0 mb-4 mt-5 text-center">Podsumowanie Twoich wydatków i przychodów </h1>
									</header>
									
									<div class="row">
										<div id = "wybor" class= "h6 col text-center text-uppercase mb-md-4">
											<fieldset style="border:none;" class="border-bottom border-top pt-3 pb-2">
												<legend class="fw-bolder pb-1"> Wybierz okres na bilans: </legend>	

												<div class="form-check form-check-inline">
													<label for="radioB1"> Poprzedni </label> 
													<input type="radio" name ="wybor" value="1" id="radioB1">
												</div>
												<div class="form-check form-check-inline">
													<label for="radioB2"> Bierzący miesiąc </label>
													<input type="radio" name ="wybor" value="1" id="radioB2">
												</div>
												<div class="form-check form-check-inline">
													<label for="radioB3"> Następny </label>
													<input type="radio" name ="wybor" value="1" id="radioB3">   
												</div>
												<div  class="form-check form-check-inline">
													<label for="radioB4"> Niestandardowy </label>
													<input type="radio" name ="wybor" value="1" id="radioB4"> 
												</div>
											</fieldset>
										</div>
									</div>
								
									<div class="col-lg-6 mt-2 pt-lg-2 table-responsive offset-lg-3 d-block bg-white rounded px-1">
										<div id="piechart" class="col-lg-4 col-md-6 col-6 mb-3 d-block mx-auto"></div>

										<table class="table table-hover my-2">
											<thead>
												<tr>
													<th scope="col">Lp.</th>
													<th scope="col">Kategoria przychodu</th>
													<th scope="col">Kwota</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">1.</th>
													<td>Kategoria1</td>
													<td>xxx zł</td>	
												</tr>
												<tr>
													<th scope="row">2.</th>
													<td>Kategoria2</td>
													<td>xxx zł</td> 
												</tr>
												<tr>
													<th scope="row">3.</th>
													<td>Kategoria3</td>
													<td>xxx zł</td>
												</tr>
												<tr>
													<th scope="row">4.</th>
													<td>Kategoria4</td>
													<td>xxx zł</td>
												</tr>
												<tr class="table-warning fw-bold">
													<td colspan="2" class="text-center text-uppercase">suma przychodów </td>
													<td>xxx zł</td>
												</tr>

											</tbody>
											
										</table>

										<table class="table table-hover my-2">
											<thead>
												<tr>
													<th scope="col">Lp.</th>
													<th scope="col">Kategoria wydatku</th>
													<th scope="col">Kwota</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">1.</th>
													<td>Kategoria1</td>
													<td>xxx zł</td>
												</tr>
												<tr>
													<th scope="row">2.</th>
													<td>Kategoria2</td>
													<td>xxx zł</td>
												</tr>
												<tr>
													<th scope="row">3.</th>
													<td>Kategoria3</td>
													<td>xxx zł</td>
												</tr>
												<tr>
													<th scope="row">4.</th>
													<td>Kategoria4</td>
													<td>xxx zł</td>
												</tr>
												<tr class="table-warning fw-bold">
													<td colspan="2" class="text-center text-uppercase">suma przychodów </td>
													<td>xxx zł</td>
												</tr>
											</tbody>
											
										</table>
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