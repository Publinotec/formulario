<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Validar que el jugador exista antes de intentar la eliminación
    $idQuery = "SELECT id FROM jugadores WHERE id = '$id'";
    $idResult = $conn->query($idQuery);

    if ($idResult->num_rows > 0) {
        $sql = "DELETE FROM jugadores WHERE id = '$id'";

        if ($conn->query($sql) === TRUE) {
            http_response_code(200); // OK
            echo json_encode(["message" => "Jugador eliminado correctamente"]);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode(["error" => "Error al eliminar jugador: " . $conn->error]);
        }
    } else {
        http_response_code(404); // Not Found
        echo json_encode(["error" => "Jugador no encontrado. No se puede eliminar."]);
    }
}

$conn->close();
?>
