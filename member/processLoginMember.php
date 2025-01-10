<?php
session_start(); // 세션 시작

// POST 데이터 가져오기
$id = trim($_POST["id"]);
$password = trim($_POST["password"]);

// 데이터베이스 연결 파일 포함
require "../dbconn.php";

try {
    // SQL 쿼리 작성 (Prepared Statement 사용)
    $sql = "SELECT * FROM member WHERE id = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception("쿼리 준비 실패: " . mysqli_error($conn));
    }

    // Prepared Statement에 변수 바인딩
    mysqli_stmt_bind_param($stmt, "ss", $id, $password);

    // 쿼리 실행
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("쿼리 실행 실패: " . mysqli_stmt_error($stmt));
    }

    // 결과 가져오기
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // 세션에 사용자 정보 저장
        $_SESSION['sessionID'] = $row['id'];
        $_SESSION['sessionPW'] = $row['password'];

        // 로그인 성공 시 리다이렉트
        Header("Location:resultMember.php?msg=2");
    } else {
        // 로그인 실패 시 리다이렉트
        Header("Location:loginMember.php?error=1");
    }
} catch (Exception $e) {
    // 오류 발생 시 로그에 기록
    error_log($e->getMessage());
    Header("Location:loginMember.php?error=1");
} finally {
    // 리소스 정리
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
