<?php

session_start();

 if(!isset($_POST['login'])||(!isset($_POST['password'])))
{
    header('Location: index.php');
    exit();
}



require_once "connect.php";

$connection=@new mysqli($host, $db_user, $db_password, $db_name);


if($connection->connect_errno!=0)
{
    echo "Error: ".$connection->connect_errno;
}
else 
{
    $login=$_POST['login'];
    $password=$_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

   if($result = @$connection->query(
       sprintf("SELECT * FROM users WHERE username='%s'",
                mysqli_real_escape_string($connection,$login))))
                
   {
       $how_many_users = $result->num_rows;
       if($how_many_users>0)
       {
            $row = $result->fetch_assoc();

            if(password_verify($password, $row['password']))
            {
                $_SESSION['zalogowany']=true;
                $_SESSION['userId']=$row['id'];
                $_SESSION['username']=$row['username'];

                unset($_SESSION['blad']);
                $result->free_result();
                header('Location: strona-glowna');
            } 
            else
            {
                
                $_SESSION['blad']='<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                echo $_SESSION['blad'];
                header('Location: Witaj-w-AZET');
            }

        } 
        else
        {
            $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
            echo $_SESSION['blad'];
            header('Location: Witaj-w-AZET');
        }
    
    }

    $connection->close();
}

?>

