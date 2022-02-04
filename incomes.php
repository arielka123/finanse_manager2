<?php 

session_start();

if(!isset($_SESSION['zalogowany']))
{	
	header('Location:"index.php"');
	exit();	
}

if(!isset($_POST['amount']))
{
    header('Location: "dodaj_wplyw.php"');
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
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$id_income_category =$_POST['wplyw'];
		$comment = $_POST['comment'];
		$id= $_SESSION['userId'];

		// weryfikuje podaną kwotę
		
		$amount =trim($amount);

		$amount = str_replace(",",".",$amount);

		if (is_numeric($amount)!=1)
		{
			$_SESSION['e_amount']="Wprowadzono niepoprawny format kwoty!";
			header('Location: dodaj_wplyw.php');
			exit();
		}

		if($amount<=0)
		{
			$_SESSION['e_amount']="Wprowadź kwotę większą od zera!";
			header('Location: dodaj_wplyw.php');
			exit();
		}
		
		//veryfy comment

		$comment= htmlentities($comment, ENT_QUOTES, "UTF-8");

		//pobiera dane i zapisuje do tabeli sql

		$connection->query("INSERT INTO incomes 
					VALUES(null, '$id', '$id_income_category', '$amount', '$date', '$comment')");

		$_SESSION['added_income']=true;

		header('Location: dodaj_wplyw.php');

	$connection->close();
}

?>