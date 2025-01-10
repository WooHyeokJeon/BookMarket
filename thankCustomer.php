<!doctype html>
<html class="h-100">
<head>
    <title>주문 완료</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom styles for this template -->
</head>
<body class="d-flex flex-column h-100">
<?php 
    require "./menu.php";

    // 쿠키 데이터 읽기 및 검증
    $shipping_cartId = $_COOKIE["Shipping_cartId"] ?? "알 수 없음";
    $shipping_name = $_COOKIE["Shipping_name"] ?? "알 수 없음";
    $shipping_shippingDate = $_COOKIE["Shipping_shippingDate"] ?? "알 수 없음";
    $shipping_country = $_COOKIE["Shipping_country"] ?? "알 수 없음";
    $shipping_zipCode = $_COOKIE["Shipping_zipCode"] ?? "알 수 없음";
    $shipping_addressName = $_COOKIE["Shipping_addressName"] ?? "알 수 없음";

    // 세션 시작
    session_start();
?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">주문 완료</h1>
            <p class="col-md-8 fs-4">Order Completed</p>
        </div>
    </div>

    <div class="row align-items-md-stretch text-center">
        <h2 class="alert alert-success">주문해주셔서 감사합니다!</h2>
        <p>주문은 <strong><?= htmlspecialchars($shipping_shippingDate) ?></strong>에 배송될 예정입니다.</p>
        <p>주문번호: <strong><?= htmlspecialchars($shipping_cartId) ?></strong></p>
    </div>

    <div class="container text-center">
        <a href="./books.php" class="btn btn-secondary">&laquo; 도서 목록</a>
    </div>
</div>
</main>
<?php
    // 세션 초기화
    session_unset();

    // 쿠키 초기화
    setcookie("Shipping_cartId", "", time() - 3600);
    setcookie("Shipping_name", "", time() - 3600);
    setcookie("Shipping_shippingDate", "", time() - 3600);
    setcookie("Shipping_country", "", time() - 3600);
    setcookie("Shipping_zipCode", "", time() - 3600);
    setcookie("Shipping_addressName", "", time() - 3600);
?>
<?php     
    require "./footer.php";
?>
</body>
</html>
