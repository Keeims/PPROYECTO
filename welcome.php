<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirigir al login si no está autenticado
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset= "UTF-8">
    <title>Bienvenidos</title>
</head>
<body>
    <h2>Bienvenidos, <?php echo
    htmlspecialchars($_SESION['username']); 
    ?>!</H2>
    <p><<a href="logout.php">Cerrar
        sesion</a></p>
</body>
</html>