<?php
$host = "DB_HOST";  
$user = "DB_USER";        
$pass = "DB_PASSWORD";  
$dbname = "DB_NAME";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("데이터베이스 연결 실패: " . mysqli_connect_error());
}

// 한글 깨짐 방지 설정
mysqli_set_charset($conn, "utf8mb4");
?>
