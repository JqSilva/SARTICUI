<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventario_hrt";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 
echo "Conexión exitosa a la base de datos.";
