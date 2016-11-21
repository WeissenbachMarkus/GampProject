<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author weiss
 */
class Datenbank {

    public static function connect() {
        $servername = "192.168.159.128";
        $username = "gamp_db_user";
        $password = "gamp_db_user";
        $dbname = "gamp_dp";

        $db = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";

        return $db;
    }

    public static function getAllModuls() {
        $db = self::connect();
        $sql = "SELECT * from tbl_modul;";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
           mysqli_close($db);
           return $result;
            
        } else {
          return null;
        }
       
    }
    
    

}
