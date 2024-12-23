<!doctype html>
<html class="h-100" > 
<head>  
  <title>도서 등록</title>  
    <!-- Bootstrap CSS -->
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- Bootstrap JS -->
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" ></script>

    <!-- 스타일 정의 -->
    <style>
        .error {color: red;}         /* 오류 메시지 색상 */
        .required {color: red;}     /* 필수 입력 필드 표시 색상 */
        .success {color: green;}    /* 성공 메시지 색상 */
    </style>
</head>
<body class="d-flex flex-column h-100">
  <?php      
    require "./menu.php";  // 상단 메뉴 포함
  ?>
<br>
<main>
<div class="container py-5">
    <!-- 페이지 상단 헤더 -->
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">도서 등록</h1>
            <p class="col-md-8 fs-4">Book Addition</p>
        </div>
    </div>
    <div class="row align-items-md-stretch">      
        <div class="col-md-12">
            <div class="h-100 p-5">
                <!-- 도서 등록 폼 -->
                <form name="newBook" action="./processUpdateBook.php" method="post" enctype="multipart/form-data">
                    <!-- 도서 코드 입력 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">도서코드<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                            <input type="text" id="bookId" name="bookId" value="<?= $bookId; ?>" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= $bookIdErr; ?></span> <!-- 도서 코드 오류 메시지 -->
                        </div>
                    </div>
                    <!-- 도서명 입력 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">도서명<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                            <input type="text" id="name" name="name" value="<?= $name; ?>" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= $nameErr; ?></span> <!-- 도서명 오류 메시지 -->
                        </div>
                     </div>
                    <!-- 가격 입력 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">가격<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                             <input type="text" id="unitPrice" value="<?= $unitPrice; ?>" name="unitPrice" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= $unitPriceErr; ?></span> <!-- 가격 오류 메시지 -->
                        </div>
                     </div>
                     <!-- 저자 입력 -->
                     <div class="mb-3 row">
                        <label class="col-sm-2">저자</label>
                        <div class="col-sm-3">
                           <input type="text" name="author" value="<?= $author; ?>" class="form-control">
                        </div>
                     </div>
                     <!-- 상세 정보 입력 -->
                     <div class="mb-3 row">
                        <label class="col-sm-2">상세정보<sup class="required">*</sup></label>
                        <div class="col-sm-5">
                             <textarea name="description" cols="50" rows="2" class="form-control" placeholder="100자 이상 적어주세요"><?= $description; ?></textarea>
                            <span class="error"><?= $descriptionErr; ?></span> <!-- 상세 정보 오류 메시지 -->
                         </div>
                    </div>       
                    <!-- 분류 입력 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">분류</label>
                        <div class="col-sm-3">
                            <input type="text" name="category" value="<?= $category; ?>" class="form-control">
                        </div>
                    </div>
                    <!-- 재고수 입력 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">재고수<sup class="required">*</sup></label>
                        <div class="col-sm-3">
                            <input type="text" name="unitsInStock" value="<?= $unitsInStock; ?>" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <span class="error"><?= $unitsInStockErr; ?></span> <!-- 재고수 오류 메시지 -->
                        </div>
                    </div>
                    <!-- 출판일 입력 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">출판일</label>
                        <div class="col-sm-3">
                            <input type="text" name="releaseDate" value="<?= $releaseDate; ?>" class="form-control">
                        </div>
                    </div>        
                    <!-- 상태 선택 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">상태</label>
                        <div class="col-sm-5">
                            <input type="radio" name="condition" value="New " checked> 신규도서 
                            <input type="radio" name="condition" value="Old" > 중고도서 
                            <input type="radio" name="condition" value="EBook" > E-Book
                        </div>				
                    </div>	
                    <!-- 이미지 업로드 -->
                    <div class="mb-3 row">
                        <label class="col-sm-2">이미지<sup class="required">*</sup></label>
                        <div class="col-sm-5">
                            <input type="file" name="bookImage" class="form-control">
                            <span class="error"><?= $bookImageErr; ?></span> <!-- 이미지 오류 메시지 -->
                        </div>				
                    </div>		
                    <!-- 제출 및 취소 버튼 -->
                    <div class="mb-3 row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" name="submit" value="등록" onclick="CheckAddBook()">
                            <iput type="reset" class="btn btn-secomdary" name="reset" value="취소">
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
?>
</body>
</html>
