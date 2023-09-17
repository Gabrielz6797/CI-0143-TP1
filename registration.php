<?php
// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validar que se han proporcionado datos
    if (empty($username) || empty($password)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Hashear la contraseña utilizando SHA-256
        $hashedPassword = hash("sha256", $password);

        // Abrir el archivo CSV para añadir el nuevo usuario
        $csvFile = fopen("usuarios.csv", "a");

        // Escribir los datos del usuario en el archivo CSV
        fputcsv($csvFile, array($username, $hashedPassword));

        // Cerrar el archivo CSV
        fclose($csvFile);

        echo "Registro exitoso. ¡Bienvenido, $username!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Usuario</title>
</head>

<body>
    <h2>Registro de Usuario</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Registrarse">
    </form>
</body>

</html>