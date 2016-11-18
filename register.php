<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $vorname = filter_var($_GET['Vorname'], FILTER_DEFAULT);
    $email = filter_var($_GET['Email'], FILTER_VALIDATE_EMAIL);
    $nachname = filter_var($_GET['Nachname'], FILTER_DEFAULT);
    $alter = filter_var($_GET['Alter'], FILTER_DEFAULT);
    $checkbox = filter_var($_GET['Newsletter'], FILTER_DEFAULT);
}


function alterTest($datum)
{
    if ($datum == '')
    {
        return false;
    }

    $geburtstag = new DateTime($datum);
    $heute = new DateTime(date('Y-m-d'));
    $differenz = $geburtstag->diff($heute);


    return $differenz->format('%y') > 11;
}

echo $alter;

function überprüfung()
{
    global $alter,$checkbox,$email,$nachname,$vorname;
     
            
    $_SESSION['Vorname'] = $vorname != '' ? $vorname : false;
    $_SESSION['Nachname'] = $nachname != '' ? $nachname : false;
    $_SESSION['Alter'] = alterTest($alter)==true ? $alter : false;
    $_SESSION['Email'] = $email != '' ? $email : false;
    $_SESSION['Newsletter'] = $checkbox != '' ? $checkbox : 'Nein';

    
   if ($_SESSION['Vorname'] &&
            $_SESSION['Nachname'] &&
            $_SESSION['Alter'] &&
            $_SESSION['Email'])
    {
       
       require_once ('../connection/connection.php');
       require_once ('eintrag.php');
        
        $_SESSION['erfolg'] = 1;
      header('Location: http://localhost/GampAufgabe3/index.php');
	 
    } else
    {
        $_SESSION['erfolg'] = 0;
        header('Location: http://localhost/GampAufgabe3/index.php?aufgabe=3');    
    }
}

überprüfung();



