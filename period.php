<?php
    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
		header('Location:Witaj-w-AZET');       
		exit();
    }
    else
    {

        unset($_SESSION['present_month']);
        unset($_SESSION['previous_month']);
        unset($_SESSION['non_standard']);
        unset($_SESSION['present_year']);
        unset($_SESSION['date1']);
        unset($_SESSION['date2']);
        unset($_SESSION['e_date']);

        
        if(!isset($_POST['wybor']))
        {
            $x=2;
        }
        else
        {
            $x =$_POST['wybor'];
        }
  

		$year=date('Y');          
		$month=date('m');
        $day=date('d');  
        $today= date('Y-m-d');
		$first_day="01"; 
        $date1;
        $date2;
		
		// previous month

        if($x=='1')
        {
            $_SESSION['previous_month']=true;
            if($month='01')
            {
                $year=$year-1;
                $month='12';  
                
                $date1=$year."-".$month."-".$first_day;
                $last_day_month=date("Y-m-t", strtotime($date1));

                $date2=$last_day_month;
            }
    
            else if($month<=10)
            {
                $month=$month-1;
                $date1=$year."-0".$month."-".$first_day;
                $last_day_month=date("Y-m-t", strtotime($date1));

                $date2=$last_day_month;
            }
            else{

                $month=$month-1;
                $date1=$year."-".$month."-".$first_day;
                $last_day_month=date("Y-m-t", strtotime($date1));

                $date2=$last_day_month;
            }
        }
        else if($x=='2')
        {
            $date1=$year."-".$month."-".$first_day;
            $date2=$today;
            $_SESSION['present_month']=true;
        }
        else if($x=='3')
        {
            $_SESSION['present_year']=true;
        }
        // non-standard
        else if($x=='4')
        {
            $_SESSION['non_standard']=true;

          //  $_SESSION['non_standard']=true;
            if(isset($_POST['date1']) || isset($_POST['date2']))
            {
                $date1=$_POST['date1'];
                $date2=$_POST['date2'];

                if ($date1 >= $today)
                {
                    $date1=$today;
                }
                if ($date2 >= $today)
                {
                    $date2=$today;
                }

                if($date1>$date2)
                {
                    $temp = $date1;
                    $date1= $date2;
                    $date2 = $temp;
                }

                if (empty($date1) && empty($date2)) 
                {
                $_SESSION['e_date'] = "Wybierz zakres dat!";
                }
            }
            else
            {
                $_SESSION['e_date'] = "Wybierz zakres dat!";
            }

        }
        else
            {
                $_SESSION['e_date'] = "Nie wybrano okresu na bilans! ";

            }
        
        $_SESSION['done']=true;  
        $_SESSION['date1']= $date1;
        $_SESSION['date2']= $date2;  

       header('Location: bilans');
		
    }
?>