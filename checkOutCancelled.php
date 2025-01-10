<!doctype html>
<html class="h-100">
<head>
    <title>주문 취소</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<?php 
    require "./menu.php";
?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-5 fw-bold">주문 취소</h1>
            <p class="col-md-8 fs-4">Order Cancellation</p>
        </div>
    </div>

    <div class="row align-items-md-stretch text-center">
        <h2 class="alert alert-danger">주문이 취소되었습니다.</h2>
    </div>
    <div class="container text-center mt-4">
        <a href="./books.php" class="btn btn-secondary">&laquo; 도서 목록</a>
    </div>
</div>
</main>
<?php     
    require "./footer.php";
?>
</body>
</html>
