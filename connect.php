<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "baza"; 
$port=3307;


$conn = mysqli_connect($servername, $username, $password, $database, $port);


if (!$conn) {
    die("Neuspjelo spajanje na bazu: " . mysqli_connect_error());
         } else {
             //echo //"Uspješno spojeni na bazu!";
    }

?>