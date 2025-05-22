<?php
include 'connection.php'; 

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'GET') {
    http_response_code(400);
    echo 'Only GET method is allowed';
    exit();
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan id di-cast ke integer untuk menghindari SQL Injection
    $sql = mysqli_query($connect, "SELECT * FROM students WHERE student_id = $id");
    
    $response = [];
    if ($row = mysqli_fetch_object($sql)) {
        $response = $row;
    }
} else {
    $sql = mysqli_query($connect, "SELECT * FROM students");

    while ($result = mysqli_fetch_object($sql)) {
        $response[] = $result; 
    }
}

header('Content-Type: application/json');
echo json_encode($response); 
?>