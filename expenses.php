<?php 

session_start();

if(!isset($_SESSION['zalogowany']))
{	
	header('Location:"Witaj-w-AZET"');
	exit();	
}

if(!isset($_POST['amount']))
{
    header('Location: dodaj-wydatek');
    exit();
}

unset($_SESSION['added_income']);
unset($_SESSION['e_amount']);

require_once "connect.php";

$connection=@new mysqli($host, $db_user, $db_password, $db_name);


if($connection->connect_errno!=0)
{
    echo "Error: ".$connection->connect_errno;
}
else 
{

	if($result = @$connection->query(
		sprintf("SELECT * FROM users WHERE id='%s'",
				 mysqli_real_escape_string($connection,$_SESSION['id']))))
	{
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$id_expense_category =$_POST['wydatek'];
		$payment_method_assigned_to_user=$_POST['platnosc'];
		$comment = $_POST['komentarz'];
		$id= $_SESSION['userId'];


		//veryfy amount
		$amount =trim($amount);

		$amount = str_replace(",",".",$amount);

		if (is_numeric($amount)!=1)
		{
			$_SESSION['e_amount']="Wprowadzono niepoprawny format kwoty!";
			header('Location: dodaj-wplyw');
			exit();
		}

		if($amount<=0)
		{
			$_SESSION['e_amount']="Wprowadź kwotę większą od zera!";
			header('Location: dodaj-wplyw');
			exit();
		}
		
		//veryfy comment

		$comment= htmlentities($comment, ENT_QUOTES, "UTF-8");


		//pobiera dane i zapisuje do tabeli sql

		$connection->query("INSERT INTO expenses 
					VALUES(null, '$id', '$id_expense_category','$payment_method_assigned_to_user', '$amount', '$date', '$comment')");

		$_SESSION['added_expense']=true;

		header('Location: dodaj-wydatek');

	}


	$connection->close();
}

?>