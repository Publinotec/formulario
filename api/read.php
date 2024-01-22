<?php
include '../config/config.php';

$sql = "SELECT * FROM jugadores";
$result = $conn->query($sql);

$jugadores = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jugadores[] = $row;
    }
    http_response_code(200); // OK
    echo json_encode($jugadores);
} else {
    http_response_code(404); // Not Found
    echo json_encode(["error" => "No se encontraron jugadores"]);
}

$conn->close();
?>
