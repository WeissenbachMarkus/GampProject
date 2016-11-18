<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernickname = filter_var($_POST['Nickname'], FILTER_DEFAULT);
    $userpassword = filter_var($_POST['Passwort'], FILTER_DEFAULT);
}


require_once ('connection.php');


$sql = 'SELECT nickname, passwort FROM m_user where nickname="' . $usernickname . '"';
$result = mysqli_query($conn, $sql);

$datenKorrekt = false;
if (mysqli_num_rows($result)) {

    $row = mysqli_fetch_assoc($result);

    if ($row['passwort'] == hash('sha256', $userpassword)) {

	echo'Du bist eingeloggt!';
	$datenKorrekt = true;
	$_SESSION['User'] = $usernickname;
	$_SESSION['eingeloggt'] = 'ja';
	header('Location: http://localhost/GampAufgabe3/index.php');
    }
    
} else {
    echo "0 results";
}
if (!$datenKorrekt) {
    $_SESSION['eingeloggt'] = 'nein';
    header('Location: http://localhost/GampAufgabe3/index.php?login=1');
    echo'Logindaten sind falsch!';
}

mysqli_close($conn);
