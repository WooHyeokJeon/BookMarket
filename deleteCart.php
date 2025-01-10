<?php
// 세션 시작
session_start();

// URL을 통해 cartId 값을 가져옴
$cartId = $_GET["cartId"] ?? null;

// cartId가 비어 있거나 null인 경우 cart.php로 리디렉션
if (!$cartId) {
    header("Location: cart.php");
    exit();
}

// 장바구니 데이터만 삭제하도록 변경
if (isset($_SESSION["cartlist"])) {
    unset($_SESSION["cartlist"]); // 장바구니 데이터 삭제
}

// 장바구니 삭제 후 cart.php로 리디렉션
header("Location: cart.php");
exit();
?>
