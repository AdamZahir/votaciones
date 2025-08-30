<?php
include 'base.php'; // Cambiado de conexion.php a base.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['email'];
    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registro exitoso'); window.location.href='encuesta.html';</script>";
        exit;
    } else {
        echo "<script>alert('Error al registrarse: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="indexestilo.css">
</head>
<body>
<main> 
    <div class="contenedor-padre">
        <h1>Registrate </h1>

        <form class="formulario" method="POST" action="">
            <div class="parte-uno"> 
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>  

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <br><br>

                <button class="enviar" type="submit">Registrarse</button>

                <p class="registro-texto">
                    ¿Ya tienes cuenta? 
                    <a href="iniciosesion.html">Inicia sesión aquí</a>
                </p>
            </div>          
        </form>
    </div>
</main>

<script>
  // Validación de correo antes de enviar
  document.querySelector(".formulario").addEventListener("submit", function(e) {
    const email = document.getElementById("email").value.trim();
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailValido.test(email)) {
      e.preventDefault();
      alert("Por favor, ingresa un correo electrónico válido.");
    }
  });
</script>

</body>
</html>
