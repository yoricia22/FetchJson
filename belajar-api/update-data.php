<?php
include 'connection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$id = $data['student_id'];
$name = $data['student_name'];
$class = $data['student_class'];
$no = $data['student_no'];

$sql = mysqli_query($connect, "UPDATE students SET student_name='$name', student_class='$class', student_no='$no' WHERE student_id='$id'");

if ($sql) {
    echo json_encode(["status" => "ok", "message" => "Update berhasil"]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($connect)]);
}