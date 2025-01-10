<?php
// 데이터베이스 연결 파일 포함
require "../dbconn.php";

// 입력 데이터 트림 처리 및 변수 할당
$id = trim($_POST["id"]);
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
$regist_day = date("Y/m/d H:i:s");

try {
    // SQL 쿼리 작성
    $sql = "INSERT INTO member (id, password, name, gender, birth, mail, phone, address, regist_day) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepared Statement 생성
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        throw new Exception("쿼리 준비 실패: " . mysqli_error($conn));
    }

    // Prepared Statement에 변수 바인딩
    mysqli_stmt_bind_param($stmt, "sssssssss", $id, $password, $name, $gender, $birth, $mail, $phone, $address, $regist_day);

    // 쿼리 실행
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("쿼리 실행 실패: " . mysqli_stmt_error($stmt));
    }

    // 회원가입 성공 시 리다이렉트
    Header("Location:resultMember.php?msg=1");
} catch (Exception $e) {
    // 오류 발생 시 처리
    error_log($e->getMessage()); // 오류를 로그에 기록
    Header("Location:resultMember.php?msg=0"); // 실패 메시지로 리다이렉트
} finally {
    // 리소스 정리
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>
