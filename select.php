<?php

$sql = "SELECT id, vorname, nachname, age, email, newsletter FROM anmeldung";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo ' <div class="output" style="border:solid black 1px; padding:3px; margin:2px;">' . "- Name: " . $row['vorname'] . " Nachname: " . $row['nachname'] .
        " Alter: " . $row['age'] . " Email: " . $row['email'] . " Newsletter: " . $row['newsletter'] . "</div>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
