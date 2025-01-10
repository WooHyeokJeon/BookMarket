<!doctype html>
<html class="h-100">
<head>
    <title>도서 조회 오류</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<br>
<main>
    <div class="container py-5">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-5">
                <h1 class="alert alert-danger">해당 도서가 존재하지 않습니다.</h1>
            </div>
        </div>

        <?php
        // 현재 URL 생성 및 출력
        $http_host = htmlspecialchars($_SERVER['HTTP_HOST'], ENT_QUOTES, 'UTF-8');
        $request_uri = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');
        $url = 'http://' . $http_host . $request_uri;
        ?>

        <div class="row align-items-md-stretch">
            <div class="col-md-12">
                <div class="h-100 p-5">
                    <p>현재 접속 URL: <strong><?php echo $url; ?></strong></p>
                    <p><a href="books.php" class="btn btn-secondary">도서 목록 &raquo;</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
