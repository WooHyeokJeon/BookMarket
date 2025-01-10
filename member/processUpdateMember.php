<?php
require "../dbconn.php"; // 데이터베이스 연결

// POST 데이터 가져오기
$id = trim($_POST['id']);
$password = trim($_POST["password"]);
$name = trim($_POST["name"]);
$gender = trim($_POST["gender"]);
$year = trim($_POST["birthyy"]);
$month = trim($_POST["birthmm"]);
$day = trim($_POST["birthdd"]);
$birth = trim($year . "/" . $month . "/" . $day);
$mail1 = trim($_POST["mail1"]);
$mail2 = trim($_POST["mail2"]);
$mail = trim($mail1 . "@" . $mail2);
$phone = trim($_POST["phone"]);
$address = trim($_POST["address"]);

// 현재 날짜와 시간을 저장
$regist_day = date("Y/m/d H:i:s");

try {
    // Prepared Statement를 사용한 SQL 쿼리
    $sql = "UPDATE member 
            SET password = ?, 
                name = ?, 
                gender = ?, 
                birth = ?, 
                mail = ?, 
                phone = ?, 
                address = ?, 
                regist_day = ? 
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception("쿼리 준비 실패: " . mysqli_error($conn));
    }

    // Prepared Statement에 변수 바인딩
    mysqli_stmt_bind_param($stmt, "sssssssss", $password, $name, $gender, $birth, $mail, $phone, $address, $regist_day, $id);

    // 쿼리 실행
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("쿼리 실행 실패: " . mysqli_stmt_error($stmt));
    }

    // 업데이트 성공 시 결과 페이지로 이동
    Header("Location:resultMember.php?msg=0");
} catch (Exception $e) {
    // 오류 발생 시 로그에 기록
    error_log($e->getMessage());
    Header("Location:resultMember.php?msg=error");
} finally {
    // 리소스 정리
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
