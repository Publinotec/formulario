<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura la ID ingresada manualmente desde el formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $equipo = $_POST["equipo"];
    $posicion = $_POST["posicion"];
    $categoria = $_POST["categoria"];
    $edad = $_POST["edad"];
    $numero = $_POST["numero"];

    // Validar que no haya duplicados en la columna 'id'
    $idQuery = "SELECT id FROM jugadores WHERE id = '$id'";
    $idResult = $conn->query($idQuery);

    if ($idResult->num_rows > 0) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "La ID ya existe. Debe ser única."]);
    } else {
        $sql = "INSERT INTO jugadores (id, nombre, equipo, posicion, categoria, edad, numero)
                VALUES ('$id', '$nombre', '$equipo', '$posicion', '$categoria', $edad, $numero)";

        if ($conn->query($sql) === TRUE) {
            http_response_code(201); // Created
            echo json_encode(["message" => "Jugador agregado correctamente"]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => "Error al agregar jugador: " . $conn->error]);
        }
    }
}

$conn->close();
?>
