<?php
session_start();

if(isset($_POST['username']))
{
	$all_ok=true;
	$username=$_POST['username'];

	//verify login

	if(strlen($username)<3 || strlen($username)>20)
	{
		$all_ok=false;
		$_SESSION['e_username']="Login musi posiadac od 3 do 20 znaków!";
	}

	if(ctype_alnum($username)==false)
		{
			$all_ok=false;
			$_SESSION['e_username']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}

	//verify password
	$password = $_POST['password'];

	if((strlen($password)<8)||(strlen($password)>20))
		{
			$all_ok=false;
			$_SESSION['e_password']="Haslo musi posiadac od 8 do 20 znaków!";
		}
	$password_hash = password_hash($password, PASSWORD_DEFAULT);
		
	//verify email
	$email= $_POST['email'];

	$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);

	if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
	{
		$all_ok=false;
		$_SESSION['e_email']="Podaj poprawny adres e-mail!";
	}
	
	//remember

	$_SESSION['fr_username']=$username;
	$_SESSION['fr_email']=$email;
	$_SESSION['fr_password']=$password;

	//connect to database

	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);


	 try
		{
			$connection=@new mysqli($host, $db_user, $db_password, $db_name);		

			if($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno()); 
			}
			else 
			{
				//czy email istnieje?

				$result = $connection->query("SELECT id FROM users WHERE email='$email'");

				if(!$result)throw new Exception($connection->error);

				$how_many_emails = $result->num_rows;
				if($how_many_emails>0)
				{
					$all_ok=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu email!";
				}

				// czy nick istnieje
				$result = $connection->query("SELECT id FROM users WHERE username='$username'");

				if(!$result)throw new Exception($connection->error);

				$how_many_usernames= $result->num_rows;
				if($how_many_usernames>0)
				{
					$all_ok=false;
					$_SESSION['e_username']="Istnieje już gracz o takim loginie! Wybierz inny!";
				}

				if($all_ok==true)
				{
					//hurra, wszystkie testy zaliczone

					if($connection->query("INSERT INTO users VALUES (NULL, '$username','$password_hash','$email')"))
					{
						$_SESSION['udanarejestracja']=true;

						$connection->query("INSERT INTO incomes_category_assigned_to_users (id, name, user_id)
					                SELECT null, def.name, u.id
									FROM incomes_category_default as def
									JOIN users as u on u.username = '$username'");

						$connection->query("INSERT INTO expenses_category_assigned_to_users (id, name, user_id)
									SELECT null, def.name, u.id
									FROM expenses_category_default as def
									JOIN users as u on u.username = '$username'");

						$connection->query("INSERT INTO payment_methods_assigned_to_users (id, name, user_id)
									SELECT null, def.name, u.id
									FROM payment_methods_default as def
									JOIN users as u on u.username = '$username'");
									
									
						header('Location:Witaj-w-AZET');				
					}
					else 
					{
						throw new Exception($connection->error);
					}
				}

				$connection->close();
			}
		}
		catch(Exception $e)   
		{
			echo '<span style="color:red;">Błąd serwera! przepraszamy za niedogodnosci  i prosimy o rejestrację w innym terminie!</span>';
			echo '<br/>Informacja developerska: '.$e;
		}
}
?>

<!DOCTYPE HTML>
<html lang="pl"> 
<head> 
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Rejestracja w AZET</title>
	<meta name="description" content =" "/>
	<meta name="keywords" content=" "/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome =1"/>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" href="rejestracja.css" type="text/css"/>

	<style>
		.error
		{
			color:red;
			font-size: 14px;
			margin-top:10px;
			margin-bottom:10px;
		}
	</style>
	
</head>

<body> 

	<header>
			<div  class="text-center mt-5 mb-3">
				<h1 class="text-uppercase">Rejestracja</h1>
			</div>

	</header>
	
	<main>
		<div class="container">
			<div class="row">
				<div class=" col-xl-6 col-md-8 col-sm-11 col-10 d-grid mx-auto mt-md-5">
					<form method="post">
							<div class="form-group row my-2" >	
								<label class="col-form-label col-sm-2 me-3"> Login </label> 
								<div class="col-sm-8">
									<input class="form-control" type="text" name= "username" value="<?php
									if(isset($_SESSION['fr_username']))
									{
										echo $_SESSION['fr_username'];
										unset($_SESSION['fr_username']);
									}
									?>"/> 	
									
									<?php

									if(isset($_SESSION['e_username']))
									{
										echo '<div class="error">'.$_SESSION['e_username'].'</div>';
										unset($_SESSION['e_username']);

									}
									?>
								</div>
							</div>

							<div class = "form-group row my-2" >
								<label class="col-form-label col-sm-2 me-3">Hasło</label>
								<div class="col-sm-8">
									<input class="form-control" type="password" name= "password" value="<?php
									if(isset($_SESSION['fr_password']))
									{
										echo $_SESSION['fr_password'];
										unset($_SESSION['fr_password']);
									}
									?>"/> 
									
									<?php

									if(isset($_SESSION['e_password']))
									{
										echo '<div class="error">'.$_SESSION['e_password'].'</div>';
										unset($_SESSION['e_password']);
									}
									?>
									
								</div>
							</div>
							
							<div class = "form-group row my-2" >
								<label class="col-form-label col-sm-2 me-3"> Email </label> 
								<div class="col-sm-8">
									<input class="form-control" type="email" name="email" value="<?php
									if(isset($_SESSION['fr_email']))
									{
										echo $_SESSION['fr_email'];
										unset($_SESSION['fr_email']);
									}
									?>"/>

									<?php

									if(isset($_SESSION['e_email']))
									{
										echo '<div class="error">'.$_SESSION['e_email'].'</div>';
										unset($_SESSION['e_email']);
									}
									 
									?>

								</div>	
							</div>
					
							<div class="d-grid col-md-6 col-10 mx-auto mt-4 pb-3">
									<input class="btn btn-secondary fw-bolder fs-5" type="submit" value="Zarejestruj się"/>
							</div>

					</form>
				</div>
			</div>
		</div>
	</main>
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>