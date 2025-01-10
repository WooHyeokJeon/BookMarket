<!doctype html>
<html class="h-100">
<head>
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">

<?php
    require "./menu.php"; // 상단 메뉴 포함

    // 사용자 환영 메시지와 슬로건
    $greeting = "도서 쇼핑몰에 오신 것을 환영합니다";
    $tagline = "Welcome to Web Market!";
?>

<main>
    <div class="container py-5">
        <!-- 환영 메시지 -->
        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold"><?= htmlspecialchars($greeting); ?></h1>
                <p class="col-md-8 fs-4">BookMarket</p>
            </div>
        </div>

        <!-- 슬로건 및 현재 시간 -->
        <div class="row align-items-md-stretch text-center">
            <div class="col-md-12">
                <div class="h-100 p-5">
                    <h2><?= htmlspecialchars($tagline); ?></h2>
                    <?php
                        date_default_timezone_set("Asia/Seoul"); // 한국 시간대 설정
                        echo "현재 접속 일시: " . date("Y/m/d H:i:s A");
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
    require "./footer.php"; // 하단 푸터 포함
?>
</body>
</html>
