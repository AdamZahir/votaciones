<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "Debes iniciar sesión";
    exit();
}

include "conexion.php";
$usuario = $_SESSION['usuario'];
$opcion = $_POST['opcion'] ?? '';

$opciones_validas = ['itcj','tec','urn','uacj','uach'];
if (!in_array($opcion, $opciones_validas)) {
    echo "Opción inválida";
    exit();
}

// Revisar si ya votó
$stmt = $conexion->prepare("SELECT * FROM votos WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows > 0) {
    echo "Ya votaste";
    exit();
}

// Insertar voto
$stmt = $conexion->prepare("INSERT INTO votos (usuario,voto) VALUES (?, ?)");
$stmt->bind_param("ss", $usuario, $opcion);
$stmt->execute();

echo "ok";
?>
