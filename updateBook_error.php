<!doctype html>
<html class="h-100">
<head>
    <title>도서 수정</title>
    <!-- Bootstrap CSS -->
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom 스타일 -->
    <style>
        .error {color: red;}         /* 오류 메시지 색상 */
        .required {color: red;}     /* 필수 입력 필드 색상 */
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php require "./menu.php"; ?> <!-- 메뉴 포함 -->
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">도서 수정</h1>
            <p class="col-md-8 fs-4">Book Update</p>
        </div>
    </div>
    <div class="row align-items-md-stretch">
        <div class="col-md-12">
            <div class="h-100 p-5">
                <form name="updateBook" action="./processUpdateBook.php" method="post" enctype="multipart/form-data">
                    <!-- 도서코드 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">도서코드<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                            <input type="text" id="bookId" name="bookId" value="<?= htmlspecialchars($bookId); ?>" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= htmlspecialchars($bookIdErr); ?></span>
                        </div>
                    </div>
                    <!-- 도서명 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">도서명<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name); ?>" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= htmlspecialchars($nameErr); ?></span>
                        </div>
                    </div>
                    <!-- 가격 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">가격<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                            <input type="text" id="unitPrice" name="unitPrice" value="<?= htmlspecialchars($unitPrice); ?>" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= htmlspecialchars($unitPriceErr); ?></span>
                        </div>
                    </div>
                    <!-- 저자 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">저자</label>
                        <div class="col-sm-3">
                            <input type="text" name="author" value="<?= htmlspecialchars($author); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 상세정보 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">상세정보<sup class="required">*</sup></label>
                        <div class="col-sm-5">
                            <textarea name="description" cols="50" rows="2" class="form-control" placeholder="100자 이상 입력"><?= htmlspecialchars($description); ?></textarea>
                            <span class="error"><?= htmlspecialchars($descriptionErr); ?></span>
                        </div>
                    </div>
                    <!-- 분류 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">분류</label>
                        <div class="col-sm-3">
                            <input type="text" name="category" value="<?= htmlspecialchars($category); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 재고수 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">재고수<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                            <input type="text" name="unitsInStock" value="<?= htmlspecialchars($unitsInStock); ?>" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= htmlspecialchars($unitsInStockErr); ?></span>
                        </div>
                    </div>
                    <!-- 출판일 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">출판일</label>
                        <div class="col-sm-3">
                            <input type="text" name="releaseDate" value="<?= htmlspecialchars($releaseDate); ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 상태 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">상태</label>
                        <div class="col-sm-5">
                            <input type="radio" name="condition" value="New" <?= $condition === "New" ? "checked" : ""; ?>> 신규도서
                            <input type="radio" name="condition" value="Old" <?= $condition === "Old" ? "checked" : ""; ?>> 중고도서
                            <input type="radio" name="condition" value="EBook" <?= $condition === "EBook" ? "checked" : ""; ?>> E-Book
                        </div>
                    </div>
                    <!-- 이미지 업로드 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">이미지<sup class="required">*</sup></label>
                        <div class="col-sm-5">
                            <input type="file" name="bookImage" class="form-control">
                            <span class="error"><?= htmlspecialchars($bookImageErr); ?></span>
                        </div>
                    </div>
                    <!-- 버튼 -->
                    <div class="mb-3 row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="수정">
                            <input type="reset" class="btn btn-secondary" value="취소">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<?php require "./footer.php"; ?> <!-- 푸터 포함 -->
</body>
</html>
