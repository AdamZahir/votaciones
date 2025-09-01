<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: iniciosesion.php");
    exit();
}

include "conexion.php";
$usuario = $_SESSION['usuario'];

// Verificar si el usuario ya votó
$stmt = $conexion->prepare("SELECT voto FROM votos WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$res = $stmt->get_result();
$votado = $res->fetch_assoc();
$voto_usuario = $votado['voto'] ?? null;

// Obtener contadores actuales
$contadores = $conexion->query("
    SELECT 
        SUM(voto='itcj') AS itcj,
        SUM(voto='tec') AS tec,
        SUM(voto='urn') AS urn,
        SUM(voto='uacj') AS uacj,
        SUM(voto='uach') AS uach
    FROM votos
")->fetch_assoc();

// Reemplazar posibles NULL por 0
$contadores = array_map(function($v){ return $v ?? 0; }, $contadores);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Encuesta Universidades</title>
<link rel="stylesheet" href="encuestaestilo.css">
</head>
<body>
<div class="portada"> 
    <h1>Torneo Academia Stem</h1>
    <img class="foto" src="academia.png" alt="PortadaAcademia">
</div>

<h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> 🎉</h2>
<a href="logout.php">Cerrar Sesión</a>

<div class="votaciones">
    <div class="titulos">
        <h2>Votos por proyecto</h2>
        <h3>Categoria IOT</h3>
    </div>
    <div class="nombres">
        <p class="contador">ITCJ: <span id="conta1"><?php echo $contadores['itcj']; ?></span></p>
        <p class="contador">TEC: <span id="conta2"><?php echo $contadores['tec']; ?></span></p>
        <p class="contador">URN: <span id="conta3"><?php echo $contadores['urn']; ?></span></p>
        <p class="contador">UACJ: <span id="conta4"><?php echo $contadores['uacj']; ?></span></p>
        <p class="contador">UACH: <span id="conta5"><?php echo $contadores['uach']; ?></span></p>
    </div>

    <div class="escuela">
        <img class="logo" src="ITCJ_LOGO.png" alt="ITCJ">
        <button id="MiBtn1" class="boton" data-opcion="itcj">Votar</button>
    </div>
    <div class="escuela">
        <img class="logo" src="TEC_LOGO.png" alt="TEC">
        <button id="MiBtn2" class="boton" data-opcion="tec">Votar</button>
    </div>
    <div class="escuela">
        <img class="logo" src="URN_LOGO.png" alt="URN">
        <button id="MiBtn3" class="boton" data-opcion="urn">Votar</button>
    </div>
    <div class="escuela">
        <img class="logo" src="UACJ_LOGO.png" alt="UACJ">
        <button id="MiBtn4" class="boton" data-opcion="uacj">Votar</button>
    </div>
    <div class="escuela">
        <img class="logo" src="UACH_LOGO.png" alt="UACH">
        <button id="MiBtn5" class="boton" data-opcion="uach">Votar</button>
    </div>
</div>

<script>
const botones = document.querySelectorAll('.boton');
const usuarioYaVoto = <?php echo json_encode($voto_usuario); ?>;

// Deshabilitar botones si ya votó
if (usuarioYaVoto) {
    botones.forEach(boton => {
        boton.disabled = true;
        if (boton.dataset.opcion === usuarioYaVoto) {
            boton.textContent = 'Votado';
            boton.classList.add('votado');
        }
    });
}

// Función para votar usando fetch
botones.forEach(boton => {
    boton.addEventListener('click', () => {
        const opcion = boton.dataset.opcion;
        fetch('votar.php', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'opcion=' + opcion
        })
        .then(res => res.text())
        .then(res => {
            if (res === 'ok') {
                const span = document.getElementById('conta' + (Array.from(botones).indexOf(boton)+1));
                const valorActual = parseInt(span.textContent) || 0; // <-- CORRECCIÓN
                span.textContent = valorActual + 1;
                botones.forEach(b => b.disabled = true);
                boton.textContent = 'Votado';
                boton.classList.add('votado');
            } else {
                alert(res);
            }
        });
    });
});
</script>

</body>
</html>
