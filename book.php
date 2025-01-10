<!doctype html>
<html class="h-100">   
<head>
  <title>도서 정보</title>
  <link href="./resources/css/bootstrap.min.css" rel="stylesheet"> 
  <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>  
  <script>
    function addToCart() {
      if (confirm("도서를 장바구니에 추가하시겠습니까?")) {
        document.addForm.submit();
      } else {
        document.addForm.reset();
      }
    }
  </script>
</head>
<body class="d-flex flex-column h-100">
  <?php
    require "./menu.php";
    require "./dbconn.php";

    try {
      // URL에서 id 매개변수 가져오기 및 SQL Injection 방지
      if (!isset($_GET['id']) || empty($_GET['id'])) {
        throw new Exception("도서 ID가 유효하지 않습니다.");
      }

      $id = mysqli_real_escape_string($conn, $_GET['id']);

      // 도서 정보 조회
      $sql = "SELECT * FROM book WHERE b_id='$id'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) <= 0) {
        throw new Exception("해당 도서를 찾을 수 없습니다.");
      }

      // 도서 정보 저장
      $row = mysqli_fetch_array($result);
  ?>
  <br>
  <main>
    <div class="container py-5">
      <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">도서 정보</h1>
          <p class="col-md-8 fs-4">BookInfo</p>
        </div>
      </div>
      <div class="row align-items-md-stretch">      
        <div class="col-md-5">
          <img src="./resources/images/<?= htmlspecialchars($row['b_fileName']); ?>" style="width:70%">
        </div>
        <div class="col-md-6">        
          <h2><?= htmlspecialchars($row["b_name"]); ?></h2>
          <p><?= htmlspecialchars($row["b_description"]); ?></p>
          <p><b>도서코드:</b> <span class="badge text-bg-danger"><?= htmlspecialchars($id); ?></span></p>
          <p><b>저자:</b> <?= htmlspecialchars($row["b_author"]); ?></p>
          <p><b>출판일:</b> <?= htmlspecialchars($row["b_releaseDate"]); ?></p>
          <p><b>분류:</b> <?= htmlspecialchars($row["b_category"]); ?></p>
          <p><b>재고수:</b> <?= htmlspecialchars($row["b_unitsInStock"]); ?></p>
          <p><?= htmlspecialchars($row["b_unitPrice"]); ?>원</p>
          <p>
            <form name="addForm" action="./addCart.php?id=<?= htmlspecialchars($id); ?>" method="POST">
              <a href="#" class="btn btn-info" onclick="addToCart()">도서주문 &raquo;</a> 
              <a href="./cart.php" class="btn btn-warning">장바구니 &raquo;</a>
              <a href="./books.php" class="btn btn-secondary">도서목록 &raquo;</a>
            </form>
          </p>
        </div>    
      </div>
    </div>
  </main>
  <?php
      mysqli_free_result($result);
      mysqli_close($conn);
    } catch (Exception $e) {
      // 오류 발생 시 처리
      echo "<div class='container py-5'><div class='alert alert-danger'>".$e->getMessage()."</div></div>";
    }
    require "./footer.php";
  ?>
</body>
</html>
