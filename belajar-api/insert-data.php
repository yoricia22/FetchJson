<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    http_response_code(400);
    echo 'Only POST method is allowed.';
    exit();
}

// ↓ Pindah ke luar dari blok IF
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$no = $data['student_no'];
$name = $data['student_name'];
$class = $data['student_class'];

$sql = mysqli_query($connect, "INSERT INTO students (student_id, student_no, student_name, student_class) VALUES (NULL, '$no', '$name', '$class')");

$insertId = mysqli_insert_id($connect);

header('Content-Type: application/json');
echo json_encode([
    'status' => 'ok',
    'msg'    => 'Data berhasil ditambahkan',
    'inserted_id' =>$insertId
]);