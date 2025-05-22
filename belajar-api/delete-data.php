<?php
include 'connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// CORS preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Ambil student_id dari query string
    parse_str($_SERVER['QUERY_STRING'], $query);
    $student_id = $query['student_id'];

    if (!$student_id) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'student_id tidak ditemukan']);
        exit();
    }

    $sql = mysqli_query($connect, "DELETE FROM students WHERE student_id = '$student_id'");

    if ($sql) {
        echo json_encode(['status' => 'ok', 'message' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($connect)]);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
}