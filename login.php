<?php
session_start()

//configuracion de la base de datos 
$ervername ="localhost"
$db_usarme = "root";//Cambia esto si es necesario
$db_password ="";//Cambia si es necesario ="login"

// Crear conexión
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Preparar y ejecutar la consulta
$sql = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$sql->bind_param("s", $username);
$sql->execute();
$sql->store_result();
$sql->bind_result($id, $hashed_password);
$sql->fetch();

if ($sql->num_rows > 0 && password_verify($password, $hashed_password)) {
    // Credenciales válidas
    $_SESSION['user_id'] = $id;
    $_SESSION['username'] = $username;
    header("Location: welcome.php"); // Redirigir a la página de bienvenida
    exit();
} else {
    // Credenciales inválidas
    echo "Nombre de usuario o contraseña incorrectos.";
}

$sql->close();
$conn->close();
?>