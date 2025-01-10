<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'class2';

// 데이터베이스 연결
$conn = mysqli_connect($host, $user, $pass, $dbname);

// 연결 확인
if (!$conn) {
    die('데이터베이스 연결 실패: ' . mysqli_connect_error());
}

// member 테이블 생성 쿼리
$sql = "
CREATE TABLE IF NOT EXISTS member (
    id VARCHAR(10) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(50) NOT NULL,
    gender ENUM('남', '여') DEFAULT NULL,
    birth DATE DEFAULT NULL,
    mail VARCHAR(50) DEFAULT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    address VARCHAR(255) DEFAULT NULL,
    regist_day DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";

// 테이블 생성 실행
if (mysqli_query($conn, $sql)) {
    echo "테이블 생성 성공!";
} else {
    echo "테이블 생성 실패: " . mysqli_error($conn);
}

// 데이터베이스 연결 종료
mysqli_close($conn);
?>
