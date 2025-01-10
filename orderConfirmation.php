<!doctype html>
<html class="h-100">
<head>
    <title>주문 정보</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<?php
    require "./menu.php";

    // 쿠키 데이터를 읽어 배송 정보 설정
    $shipping_cartId = $_COOKIE["Shipping_cartId"] ?? null;
    $shipping_name = $_COOKIE["Shipping_name"] ?? "정보 없음";
    $shipping_shippingDate = $_COOKIE["Shipping_shippingDate"] ?? "정보 없음";
    $shipping_country = $_COOKIE["Shipping_country"] ?? "정보 없음";
    $shipping_zipCode = $_COOKIE["Shipping_zipCode"] ?? "정보 없음";
    $shipping_addressName = $_COOKIE["Shipping_addressName"] ?? "정보 없음";

    session_start();
?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">주문 정보</h1>
            <p class="col-md-8 fs-4">Order Info</p>
        </div>
    </div>

    <div class="row align-items-md-stretch alert alert-info text-center">
        <div class="col-md-12">
            <div class="p-5">
                <h1>영수증</h1>
                <div class="row justify-content-between">
                    <div class="col-4 text-start">
                        <strong>배송 주소</strong><br>
                        성명 : <?= htmlspecialchars($shipping_name) ?><br>
                        우편번호 : <?= htmlspecialchars($shipping_zipCode) ?><br>
                        주소 : <?= htmlspecialchars($shipping_addressName) ?> (<?= htmlspecialchars($shipping_country) ?>)<br>
                    </div>
                    <div class="col-4 text-end">
                        <em>배송일: <?= htmlspecialchars($shipping_shippingDate) ?></em>
                    </div>
                </div>
            </div>

            <table class="table table-hover">
                <tr>
                    <th>도서</th>
                    <th>#</th>
                    <th>가격</th>
                    <th>소계</th>
                </tr>

                <?php
                $sum = 0;
                $cartList = $_SESSION["cartlist"] ?? [];
                foreach ($cartList as $id => $book) {
                    $total = $book["unitPrice"] * $book["quantity"];
                    $sum += $total;
                ?>
                <tr>
                    <td class="text-center"><em><?= htmlspecialchars($book["name"]) ?></em></td>
                    <td class="text-center"><?= htmlspecialchars($book["quantity"]) ?></td>
                    <td class="text-center"><?= htmlspecialchars($book["unitPrice"]) ?> 원</td>
                    <td class="text-center"><?= htmlspecialchars($total) ?> 원</td>
                </tr>
                <?php } ?>
                <tr>
                    <th></th>
                    <th></th>
                    <th><strong>총액: </strong></th>
                    <th><strong><?= htmlspecialchars($sum) ?> 원</strong></th>
                </tr>
            </table>

            <div class="mt-3">
                <a href="./ShippingInfo.php?cartId=<?= htmlspecialchars($shipping_cartId) ?>" class="btn btn-secondary">이전</a>
                <a href="./thankCustomer.php" class="btn btn-success">주문 완료</a>
                <a href="./checkOutCancelled.php" class="btn btn-danger">취소</a>
            </div>
        </div>
    </div>
</div>
</main>
<?php require "./footer.php"; ?>
</body>
</html>
