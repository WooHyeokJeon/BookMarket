<?php
// 장바구니 ID 확인
$cartId = $_GET["cartId"] ?? null;

// cartId가 비어 있으면 에러 페이지로 리디렉션
if (!$cartId) {
    header("Location:exceptionNoPage.php");
    exit();
}

// 쿠키 만료 시간 설정 (24시간)
$cookieExpire = time() + 24 * 60 * 60;

// 쿠키 설정
$fields = [
    "Shipping_cartId" => $_POST["cartId"] ?? "",
    "Shipping_name" => $_POST["name"] ?? "",
    "Shipping_shippingDate" => $_POST["shippingDate"] ?? "",
    "Shipping_country" => $_POST["country"] ?? "",
    "Shipping_zipCode" => $_POST["zipCode"] ?? "",
    "Shipping_addressName" => $_POST["addressName"] ?? ""
];

foreach ($fields as $key => $value) {
    setcookie($key, htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), $cookieExpire);
}

// 주문 확인 페이지로 리디렉션
header("Location:orderConfirmation.php");
exit();
?>
