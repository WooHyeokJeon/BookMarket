<?php
require "../dbconn.php";
session_start();

// 세션에서 사용자 ID 가져오기
if (!isset($_SESSION['sessionID'])) {
    // 세션이 없으면 로그인 페이지로 리디렉션
    Header("Location:loginMember.php?msg=not_logged_in");
    exit();
}

$sessionID = $_SESSION['sessionID'];

// Prepared Statements로 SQL 실행
$sql = "DELETE FROM member WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $sessionID);

    // SQL 실행 및 결과 확인
    if (mysqli_stmt_execute($stmt)) {
        // 세션 종료 및 메시지와 함께 리디렉션
        session_unset();
        session_destroy();
        Header("Location:resultMember.php?msg=3");
    } else {
        // 오류 메시지 출력
        echo "회원 삭제 중 오류가 발생했습니다: " . mysqli_error($conn);
    }

    // Prepared Statement 종료
    mysqli_stmt_close($stmt);
} else {
    // Prepared Statement 준비 실패 시 오류 처리
    echo "SQL 준비 중 오류가 발생했습니다: " . mysqli_error($conn);
}

// 데이터베이스 연결 종료
mysqli_close($conn);
?>
