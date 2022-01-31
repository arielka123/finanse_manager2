<?php
    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
		header('Location:"Witaj-w-AZET"');       
		exit();
    }
    else
    {

        if(!isset($_POST['wybor']))
        {
            $x=2;
        }
        else
        {
            $x =$_POST['wybor'];
            unset($_SESSION['present_month']);
            unset($_SESSION['previous_month']);
            unset($_SESSION['non_standard']);
            unset($_SESSION['present_year']);
            unset($_SESSION['date1']);
            unset($_SESSION['date2']);
        }
  

		$year=date('Y');          
		$month=date('m');          
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
            $date2=date('Y-m-d');
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
            if(isset($_POST['date1'])&& isset($_POST['date1']))
            {
                $date1=$_POST['date1'];
                $date2=$_POST['date2'];

                $_SESSION['fr_date1']= $date1;
                $_SESSION['fr_date2']= $date2;
            }
            else $_SESSION['e_date']="Wybierz zakres dat!";
        }else
        {
            $date1=$year."-".$month."-".$first_day;
            $date2=date('Y-m-d');
            $_SESSION['present_month']=true;
        }
        

        $_SESSION['done']=true;  
        $_SESSION['date1']= $date1;
        $_SESSION['date2']= $date2;  
        
            
        header('Location: bilans');
		
    }
?>