<?php
    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
		header('Location:"Witaj-w-AZET"');       
		exit();
	
	}

	if(!isset($_SESSION['done']))
    {
		header('Location:period.php'); 
		
	}

	$user_id= $_SESSION['userId'];

	$date1=$_SESSION['date1'];
    $date2=$_SESSION['date2'];
	$year=date('Y');       
	
	// $file= fopen("sql_query_income_month.txt", "r") or die("Unable to open file!");

	// $sql_income1= fread($file,filesize("sql_query_income_month.txt"));
	// fclose($file);


	$sql_income1="SELECT name, SUM(amount) as amount FROM incomes as i
			Join incomes_category_assigned_to_users as x ON i.income_category_assigned_to_user_id=x.id
			WHERE i.user_id='$user_id' AND 
			i.date_of_income BETWEEN '$date1' AND '$date2'
			GROUP BY name 
			ORDER BY amount DESC;";

	$sql_expense1="SELECT name, SUM(amount) as amount FROM expenses as e
			Join expenses_category_assigned_to_users as x ON e.expense_category_assigned_to_user_id=x.id
			WHERE e.user_id='$user_id' AND 
			e.date_of_expense BETWEEN '$date1' AND '$date2'
			GROUP BY name 
			ORDER BY amount DESC;";

	$sql_income_year="SELECT name, SUM(amount) as amount FROM incomes as i
	        Join incomes_category_assigned_to_users as x ON i.income_category_assigned_to_user_id=x.id
	        WHERE i.user_id='$user_id' AND 
	        i.date_of_income LIKE '%$year%'
	        GROUP BY name 
	        ORDER BY amount DESC;";

	$sql_expense_year="SELECT name, SUM(amount) as amount FROM expenses as e
	        Join expenses_category_assigned_to_users as x ON e.expense_category_assigned_to_user_id=x.id
	        WHERE e.user_id='$user_id' AND 
	        e.date_of_expense LIKE '%$year%'
	        GROUP BY name 
	        ORDER BY amount DESC;";


require_once "connect.php";

$connection=@new mysqli($host, $db_user, $db_password, $db_name);

if($connection->connect_errno!=0)
{
	echo "Error: ".$connection->connect_errno;
}

else{


	if(isset($_SESSION['present_month']) ||isset($_SESSION['previous_month'])||isset($_SESSION['non_standard']) )
	{
		$result_income = $connection->query("$sql_income1");
		$result_expense = $connection->query("$sql_expense1");
		$result_expense_pie=$connection->query("$sql_expense1");
	}
	else if(isset($_SESSION['present_year']))
	{
		$result_income = $connection->query("$sql_income_year");
		$result_expense = $connection->query("$sql_expense_year");
		$result_expense_pie=$connection->query("$sql_expense_year");
	}
	else 
	{
		$_SESSION['present_month']=true;
	}

}
 
 $connection->close();

?>

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

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Kategoria', 'Suma wydatków'],
        //  ['Work',     11],
          <?php

			while($chart = mysqli_fetch_assoc($result_expense_pie))
			{
				echo "['".$chart['name']."',".$chart['amount']."],";

			}
			
		  ?>
        ]);

        var options = {
         // title: 'Moje wydatki'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</head>

<body class="d-flex flex-column min-vh-100"> 
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
						
						<form action="period.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<div id = "wybor" class= "h6 col text-center text-uppercase mb-md-4 mt-5">
									
										<legend class="fw-bolder pb-2 d-block"> Wybierz okres na bilans: </legend>	
	  									
										<?php
												if(isset($_SESSION['e_date']))
													{
														echo '<div class="col-12 text-danger text-center h6 p-2 mt-4">'.$_SESSION['e_date'].'</div>';
														unset($_SESSION['e_date']);
													}
										?>

										<div class="form-check form-check-inline mt-2">
											<label  for="radioB1"> Poprzedni miesiąc </label> 
												<?php
													if(isset($_SESSION['previous_month']))
													{
														echo '<input  class="form-check-input" type="radio" name ="wybor" value="1" id="radioB1" checked>';
													}
													else {
														echo '<input  class="form-check-input" type="radio" name ="wybor" value="1" id="radioB1">';
													}
												?>
											
										</div>
										<div class="form-check form-check-inline mt-2">
											<label for="radioB2"> Bieżący miesiąc </label>
												<?php
													if(isset($_SESSION['present_month']))
													{
														echo '<input class="form-check-input" type="radio" name ="wybor" value="2" id="radioB2" checked>';
													}
													else {
														echo '<input class="form-check-input" type="radio" name ="wybor" value="2" id="radioB2">';
													}
												?>
										</div>

										<div class="form-check form-check-inline mt-2 ">
											<label for="radioB3"> Bieżący rok </label>
												<?php
													if(isset($_SESSION['present_year']))
													{
														echo '<input class="form-check-input" type="radio" name ="wybor" value="3" id="radioB3" checked>';
													}
													else {
														echo '<input class="form-check-input" type="radio" name ="wybor" value="3" id="radioB3">';
													}
												?>


										</div>

										<div   class=" col-2 form-check form-check-block pt-3 d-sm-block mx-sm-auto ms-3">
											<label for="radioB4" class="pb-2 "> Niestandardowy </label>
										
												<?php
													if(isset($_SESSION['non_standard']))
													{
														echo '<input class="form-check-input" type="radio" name ="wybor" value="4" id="radioB4" >';
													}
													else {
														echo '<input class="form-check-input" type="radio" name ="wybor" value="4" id="radioB4">';
													}

												?>

												<div class="d-block mt-2">
														<input type="date"  id = "date1" class="form-control" name="date1">
													
												</div>

												<div class="d-block mt-2">
														<input type="date"  id = "date2" class="form-control" name="date2">
														
												</div>
		
										</div>
									
								</div>
								<div class="mt-2 d-block">
									<input class="h6 col-md-auto col-10 px-5 py-3 d-block mx-auto " type="submit" value= "OK">  
								</div>
							</div>
						</form>
				
						<div class="col-lg-6 mt-2 pt-lg-2 table-responsive offset-lg-3 d-block bg-white rounded px-1 mb-5 mt-5">

							<div class="col-auto">
								<div class="card m-auto">
									<div class="card-header">
										<h5 class="py-2 text-center fw-bolder" style="letter-spacing: 2px;"> <?php

											if(isset($_SESSION['done']))
											{
												unset($_SESSION['done']);

												if(isset($_SESSION['present_year']))
												{
													echo 'PODSUMOWANIE MOICH WYDATKÓW W '.$year;

												}
												else
												{
													echo 'PODSUMOWANIE MOICH WYDATKÓW OD '.$date1." DO ".$date2;
												}

											}
											?>
										</h5>
									</div>
									<div class="card-body">

										<div id="piechart" class="col-auto max-width: 900px" style="height:300px;"></div>

									</div>

								</div>
						
							</div>

							<table class="table table-hover my-2">
								<thead>
									<tr>
										<th scope="col">Lp.</th>
										<th scope="col">Kategoria przychodu</th>
										<th scope="col">Kwota przychodu</th>
									</tr>
								</thead>
								<tbody>

									<?php	
										$i=0;
										$suma1=0;
								
										while($row = mysqli_fetch_array($result_income))
										{

										$suma1 = $suma1 + $row['amount'];
										$i = $i+1;
										$name = $row['name'];
										$amount = $row['amount'];

										echo<<<END
										<tr>
										<th scope="row">$i.</th>
										<td>$name</td>
										<td>$amount zł</td>
										</tr>
										
										END;
										}
										
									
										echo '<tr class="table-warning fw-bold">
										<td colspan="2" class="text-center text-uppercase">suma przychodów</td>';
										echo "<td>".$suma1." zł</td>";
										echo "</tr>";

									?>
									
								</tbody>
								
							</table>

							<table class="table table-hover mt-5 mb-2">
								<thead>
									<tr>
										<th scope="col">Lp.</th>
										<th scope="col">Kategoria wydatku</th>
										<th scope="col">Kwota wydatku</th>
									</tr>
								</thead>
								<tbody>
								
									<?php

										$i=0;
										$suma2=0;
										

										while($row = mysqli_fetch_array($result_expense))
										{

										$suma2 = $suma2 + $row['amount'];
										$i = $i+1;
										$name = $row['name'];
										$amount = $row['amount'];

										echo<<<END
										<tr>
										<th scope="row">$i.</th>
										<td>$name</td>
										<td>$amount zł</td>
										</tr>
										
										END;
										}
										
										echo '<tr class="table-warning fw-bold">
										<td colspan="2" class="text-center text-uppercase">suma wydatków </td>';
										echo "<td>".$suma2." zł</td>";
										echo "</tr>";

									?>

								</tbody>										
							</table>

							<?php
								if($suma1>$suma2) echo '<div class= "bg-success text-light text-center fw-bold p-2 mt-3">'."ZAOSZCZĘDZONO: ".$suma1-$suma2." zł".'</div>';
								else  echo '<div class= "bg-danger text-light text-center fw-bold p-2 mt-3">'."TWÓJ DEBET WYNOSI: ".$suma2-$suma1." zł".'</div>';						
							
							?>

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