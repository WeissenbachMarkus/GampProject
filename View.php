<?php

include_once 'Datenbank.php';
include_once 'Template2.php';


$tplt=new Template2();


$result = Datenbank::getAllModuls();

while ($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $key => $value) {

        if ($key === 'm_name')
            echo '<br>' . $key . '=' . $value . '<br>';
    }
}