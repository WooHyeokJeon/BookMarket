<!doctype html>
<html class="h-100">
<head>
    <title>도서 수정</title>
    <!-- Bootstrap CSS -->
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Validation Script -->
    <script type="text/javascript" src="./resources/js/validation.js"></script>
</head>
<body class="d-flex flex-column h-100">
<?php
    require "./menu.php"; // 상단 메뉴 포함
    require "./dbconn.php"; // 데이터베이스 연결

    // GET 매개변수로 전달받은 도서 ID
    $id = $_GET["id"];

    // 데이터베이스에서 도서 정보 조회
    $sql = "SELECT * FROM book WHERE b_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result); // 조회 결과를 배열로 저장
?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">도서 수정</h1>
            <p class="col-md-8 fs-4">Book Modification</p>
        </div>
    </div>
    <div class="row align-items-md-stretch">
        <!-- 도서 이미지 -->
        <div class="col-md-5">
            <img src="./resources/images/<?= htmlspecialchars($row['b_fileName']); ?>" style="width:70%">
        </div>
        <!-- 수정 가능한 도서 정보 -->
        <div class="col-md-7">
            <div class="h-100 p-5">
                <form name="updateBook" action="./processUpdateBook.php" method="post" enctype="multipart/form-data">
                    <!-- 도서코드 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">도서코드</label>
                        <div class="col-sm-3">
                            <input type="hidden" id="bookId" name="bookId" value="<?= htmlspecialchars($row['b_id']); ?>" class="form-control">
                            <span class="badge text-bg-danger"><?= htmlspecialchars($row['b_id']); ?></span>
                        </div>
                    </div>
                    <!-- 도서명 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">도서명</label>
                        <div class="col-sm-3">
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($row['b_name']); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 가격 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">가격</label>
                        <div class="col-sm-3">
                            <input type="text" id="unitPrice" name="unitPrice" value="<?= htmlspecialchars($row['b_unitPrice']); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 저자 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">저자</label>
                        <div class="col-sm-3">
                            <input type="text" name="author" value="<?= htmlspecialchars($row['b_author']); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 상세정보 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">상세정보</label>
                        <div class="col-sm-5">
                            <textarea name="description" cols="50" rows="2" class="form-control"><?= htmlspecialchars($row['b_description']); ?></textarea>
                        </div>
                    </div>
                    <!-- 분류 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">분류</label>
                        <div class="col-sm-3">
                            <input type="text" name="category" value="<?= htmlspecialchars($row['b_category']); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 재고수 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">재고수</label>
                        <div class="col-sm-3">
                            <input type="text" name="unitsInStock" value="<?= htmlspecialchars($row['b_unitsInStock']); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 출판일 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">출판일</label>
                        <div class="col-sm-3">
                            <input type="text" name="releaseDate" value="<?= htmlspecialchars($row['b_releaseDate']); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 상태 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">상태</label>
                        <div class="col-sm-5">
                            <input type="radio" name="condition" value="New" <?= $row['b_condition'] === "New" ? "checked" : ""; ?>> 신규도서
                            <input type="radio" name="condition" value="Old" <?= $row['b_condition'] === "Old" ? "checked" : ""; ?>> 중고도서
                            <input type="radio" name="condition" value="EBook" <?= $row['b_condition'] === "EBook" ? "checked" : ""; ?>> E-Book
                        </div>
                    </div>
                    <!-- 이미지 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">이미지</label>
                        <div class="col-sm-5">
                            <input type="file" name="bookImage" class="form-control">
                        </div>
                    </div>
                    <!-- 등록 버튼 -->
                    <div class="mb-3 row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="수정">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<?php
    require "./footer.php"; // 하단 푸터 포함
    mysqli_free_result($result); // 결과 메모리 해제
    mysqli_close($conn); // 데이터베이스 연결 종료
?>
</body>
</html>
