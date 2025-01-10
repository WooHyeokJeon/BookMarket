<?php
session_start();

// URL 매개변수에서 도서 ID를 가져옴
$bookId = $_GET["id"] ?? '';

if (empty($bookId)) {
    header("Location:cart.php");
    exit();
}

require "./model.php";

// 도서 ID로 도서 정보 조회
$book = getBookById($bookId);

if ($book == null) {
    header("Location:exceptionNoBookId.php");
    exit();
}

// 장바구니에서 해당 도서 제거
if (isset($_SESSION["cartlist"][$bookId])) {
    unset($_SESSION["cartlist"][$bookId]);
}

// 제거 후 장바구니 페이지로 리디렉션
header("Location:cart.php");
exit();
?>
