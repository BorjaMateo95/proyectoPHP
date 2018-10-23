<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$servername = "localhost";
$dbname = "bd_almacen_bml";
$password = "root";
$username = "root";


@ $conn = new mysqli($servername, $username, "", $dbname);
$error = $conn->connect_errno;

if ($error != null) {
    echo "<p>Error $error conectando a la base de datos:
    $conn->connect_error</p>";
    exit();
}

