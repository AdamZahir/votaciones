<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="inicioestilo.css">
</head>
<body>
  <main> 
    <div class="contenedor-padre">
      <h1>Inicia sesión</h1>

      <form class="formulario" action="login.php" method="POST">
        <div class="parte-uno"> 
          <label for="email">Correo electrónico:</label>
          <input type="email" id="email" name="email" required>

          <label for="password">Contraseña:</label>
          <input type="password" id="password" name="password" required>

          <!-- Aquí se muestran los errores -->
          <?php
          if (isset($_GET['error'])) {
            echo "<p style='color:red; font-weight:bold;'>" . htmlspecialchars($_GET['error']) . "</p>";
          }
          ?>

          <button class="enviar" type="submit">Entrar</button>

          <p class="registro-texto">
            ¿No tienes cuenta? 
            <a href="index.html">Regístrate aquí</a>
          </p>
        </div>          
      </form>
    </div>
  </main>
</body>
</html>
