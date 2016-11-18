<?php

session_start();
require_once ('connection.php');

$usernickname = filter_var($_POST['Nickname'], FILTER_DEFAULT);
$userpassword = filter_var($_POST['Passwort'], FILTER_DEFAULT);

$userpassword2 = filter_var($_POST['Passwort2'], FILTER_DEFAULT);

if($userpassword!=$userpassword2)
{
    header('Location: http://localhost/GampAufgabe3/index.php?register=1&stimmtNichtÜberein=1');
    exit();
}

$stmt = $conn->prepare("INSERT INTO m_user (nickname,passwort) VALUES (?,?)");
$stmt->bind_param("ss",  $usernickname, hash('sha256', $userpassword));

$stmt->execute();

if (!$stmt->error) {
    $_SESSION['erfolg'] = 1;
    header('Location: http://localhost/GampAufgabe3/index.php');
    echo 'Succsess';
} else {
    if (preg_match('/Duplicate/', $stmt->error)) {
	header('Location: http://localhost/GampAufgabe3/index.php?register=1&duplikat=1');
    }
    die("Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
exit();



