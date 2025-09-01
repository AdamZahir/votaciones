<?php
session_start();

$servername = "fdb1034.awardspace.net";
$username = "4667282_votacionespagina";
$password = "tn9mDRYxtEeSKG!";
$dbname = "4667282_votacionespagina";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$correo = $_POST['email'];
$contrasena = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE correo='$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if (password_verify($contrasena, $row['contrasena'])) {
    $_SESSION['usuario'] = $row['nombre'];
    header("Location: encuesta.php");
  } else {
    echo "❌ Contraseña incorrecta";
  }
} else {
  echo "❌ No existe el usuario";
}
$conn->close();
?>
