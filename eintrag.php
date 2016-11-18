<?php
session_start();

$stmt = $conn->prepare("INSERT INTO anmeldung (vorname, nachname,age, email,newsletter) VALUES (?, ?, ?,?,?)");
$stmt->bind_param("sssss", $vorname, $nachname, $age, $email, $newsletter);

// set parameters and execute
$vorname = $_SESSION['Vorname'];
$nachname = $_SESSION['Nachname'];
$email = $_SESSION['Email'];
$age = $_SESSION['Alter'];
$newsletter = $_SESSION['Newsletter'];
$stmt->execute();

if ($stmt->error) {
    
    if (preg_match('/email_UNIQUE/', $stmt->error)) {
	$_SESSION['erfolg'] = 0;
	$_SESSION['Email2'] = 'duplikat';
	header('Location: http://localhost/GampAufgabe3/index.php?aufgabe=3');
	exit();
	
    } else {
	die("Error: " . $stmt->error);
    }
}


$stmt->close();
$conn->close();
