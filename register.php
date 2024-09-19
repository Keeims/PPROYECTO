<?php
// Configuración de la base de datos
$servername = "localhost";
$db_username = "root"; // Cambia esto si es necesario
$db_password = ""; // Cambia esto si es necesario
$dbname = "login1";

// Crear conexión
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Hashear la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Preparar y ejecutar la consulta
$sql = $conn->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
$sql->bind_param("ss", $username, $hashed_password);

if ($sql->execute()) {
    echo "Registro exitoso. <a href='login.html'>Iniciar sesión</a>";
} else {
    echo "Error: " . $sql->error;
}

$sql->close();
$conn->close();
?>
