<?php
// 데이터베이스 연결
$conn = mysqli_connect("localhost", "root", "", "class2");

// 연결 실패 시 에러 메시지 출력 후 종료
if (!$conn) {
    die("데이터베이스 연결 실패: " . mysqli_connect_error());
}

// 필요 시 디버깅용 메시지 출력 가능 (주석 처리로 유지)
// echo "데이터베이스 연결 성공";
?>
