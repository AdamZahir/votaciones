<?php
$servername = "fdb1034.awardspace.net";
$username = "4667282_votacionespagina";
$password = "tn9mDRYxtEeSKG!";
$dbname = "4667282_votacionespagina";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$correo = $_POST['email'];
$contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT);

$browser = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];

$sql = "INSERT INTO usuario (nombre, correo, contrasena, browser, ip)
        VALUES ('$nombre','$correo','$contrasena','$browser','$ip')";

if ($conn->query($sql) === TRUE) {
  header("Location: iniciosesion.php");
} else {
  echo "Error: " . $conn->error;
}
$conn->close();
?>
