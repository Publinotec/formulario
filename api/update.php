<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $equipo = $_POST["equipo"];
    $posicion = $_POST["posicion"];
    $categoria = $_POST["categoria"];
    $edad = $_POST["edad"];
    $numero = $_POST["numero"];

    // Validar que el jugador exista antes de intentar la actualización
    $idQuery = "SELECT id FROM jugadores WHERE id = '$id'";
    $idResult = $conn->query($idQuery);

    if ($idResult->num_rows > 0) {
        $sql = "UPDATE jugadores
                SET nombre='$nombre', equipo='$equipo', posicion='$posicion', categoria='$categoria', edad=$edad, numero=$numero
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            http_response_code(200); // OK
            echo json_encode(["message" => "Jugador actualizado correctamente"]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => "Error al actualizar jugador: " . $conn->error]);
        }
    } else {
        http_response_code(404); // Not Found
        echo json_encode(["error" => "Jugador no encontrado. No se puede actualizar."]);
    }
}

$conn->close();
?>
