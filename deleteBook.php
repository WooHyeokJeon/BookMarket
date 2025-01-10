<?php
// GET 요청에서 도서 ID 가져오기
$id = $_GET['id'] ?? null;

// 도서 ID가 없는 경우 오류 메시지 출력 후 종료
if (!$id) {
    die("도서 ID가 제공되지 않았습니다.");
}

require "./dbconn.php";

try {
    // Prepared Statement로 SQL 인젝션 방지
    $stmt = $conn->prepare("SELECT * FROM book WHERE b_id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // 도서가 존재하지 않을 경우 메시지 출력 후 종료
    if ($result->num_rows <= 0) {
        echo "일치하는 도서가 없습니다.";
    } else {
        // 도서 삭제
        $stmt = $conn->prepare("DELETE FROM book WHERE b_id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    $stmt->close();
} catch (Exception $e) {
    // 에러 메시지 출력
    die("도서 삭제 중 오류 발생: " . $e->getMessage());
} finally {
    // 데이터베이스 연결 닫기
    $conn->close();
}

// 삭제 완료 후 리디렉션
header("Location: editsBooks.php?edit=delete");
exit();
?>
