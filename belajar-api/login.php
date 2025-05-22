<?php
// Header CORS wajib ada di awal
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Tangani preflight (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200); // Penting: beri status 200
    exit(0);
}

// Baru koneksi ke DB setelah lolos dari OPTIONS
$connect = mysqli_connect('localhost', 'root', '', 'db_belajar');
if (!$connect) {
    http_response_code(500);
    echo json_encode(['status' => 'fail', 'msg' => 'Database connection failed']);
    exit();
}

// Validasi method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'fail', 'msg' => 'Only POST method is allowed']);
    exit();
}

// Proses login
$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$username = $data['username'] ?? '';
$password = sha1($data['password'] ?? '');

$sql = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
$numRows = mysqli_num_rows($sql);

if ($numRows > 0) {
    $row = mysqli_fetch_assoc($sql);
    echo json_encode([
        'status' => 'success',
        'msg' => 'user found',
        'user' => $row
    ]);
} else {
    echo json_encode([
        'status' => 'fail',
        'msg' => 'user not found',
        'user' => []
    ]);
}
?>