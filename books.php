<!doctype html>
<html class="h-100">   
<head>
  <title>도서 목록</title>
  <link href="./resources/css/bootstrap.min.css" rel="stylesheet"> 
  <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>   
</head>
<body class="d-flex flex-column h-100">
<?php
    require "./menu.php";
    require "./dbconn.php";
?> 
<br>
<main>
  <div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">도서 목록</h1>
        <p class="col-md-8 fs-4">BookList</p>
      </div>
    </div>
 
    <div class="row align-items-md-stretch text-center">
      <?php
        // 도서 데이터 조회
        $sql = "SELECT * FROM book";
        $result = mysqli_query($conn, $sql);

        // 각 도서 정보를 반복 출력
        while ($row = mysqli_fetch_array($result)) {    
      ?>
      <div class="col-md-4">
        <div class="h-100 p-5">
          <img src="./resources/images/<?= htmlspecialchars($row['b_fileName']); ?>" style="width:100%">
          <h2><?= htmlspecialchars($row["b_name"]); ?></h2>
          <p><?= htmlspecialchars($row["b_author"])." | ".htmlspecialchars($row["b_releaseDate"]); ?></p>
          <p><?= htmlspecialchars(mb_substr($row["b_description"], 0, 90, 'utf-8'))."..."; ?></p>
          <p><?= htmlspecialchars($row["b_unitPrice"]); ?>원</p>
          <p>
            <a href="./book.php?id=<?= htmlspecialchars($row["b_id"]); ?>">
              <button class="btn btn-outline-secondary" type="button">상세 정보</button>
            </a>
          </p>
        </div>
      </div>
      <?php
        }
        // 메모리 해제 및 연결 종료
        mysqli_free_result($result);
        mysqli_close($conn);
      ?>     
    </div>
  </div>
</main>
<?php     
    require "./footer.php";
?>
</body>
</html>
