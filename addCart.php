<?php
// 세션 시작
session_start();

// 도서 ID 검증
$bookId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
if ($bookId == null || $bookId == "") {
    header("Location:books.php");
    exit();
}

// 도서 조회
require "./model.php";
$book = getBookById($bookId);
if ($book == null) {
    header("Location:exceptionNobookId.php");
    exit();
}

// 장바구니 세션 관리
if (isset($_SESSION['cartlist'])) {
    $goodsList = $_SESSION["cartlist"];
    $cnt = 0;

    foreach ($goodsList as $goodsid => $goods) {
        // 동일한 도서가 있는 경우 수량 증가
        if ($goodsid == $bookId) {
            $cnt++;
            $goods["quantity"] = $goods["quantity"] + 1;
            $_SESSION["cartlist"][$bookId] = $goods;
            break;
        }
    }

    // 새로운 도서 추가
    if ($cnt == 0) {
        $goods = getBookById($bookId);
        $goods["quantity"] = 1;
        $_SESSION["cartlist"][$bookId] = $goods;
    }
} else {
    $book["quantity"] = 1;
    $_SESSION["cartlist"][$bookId] = $book;
}

// 리디렉션
header("Location:book.php?id=" . $bookId);
exit();
?>
