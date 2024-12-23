<?php
$id = $_GET['id'];

require "./dbconn.php";

#SQL 쿼리를 통해 book 테이블에서 b_id가 $id와 일치하는 행을 조회
$sql = "SELECT * FROM book WHERE b_id = '$id'";

$result = mysqli_query($conn, $sql);

#도서 조회
#mysqli_num_rows() : 결과 행의 개수를 반환. 도서가 존재하지 않으면 메시지를 출력
if(mysqli_num_rows($result) <= 0)
    echo "일치하는 도서가 없습니다.";

#도서 삭제
#delete 쿼리를 사용하요 book 테이블에서 b_id가 $id와 일치하는 행을 삭제
else {
    $sql = "DELETE FROM book WHERE b_id = '$id'";
    $result = mysqli_query($conn, $sql);
}
mysqli_close($conn);

#삭제 작업 완료 후 editsBooks.php로 이동하며, URL에 edit=delete를 추가하여 삭제 작업임을 전달.
Header("Location:editsBooks.php?edit=delete");
?>