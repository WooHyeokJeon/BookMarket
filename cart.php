<!doctype html>
<html class="h-100">
<head>
    <title>장바구니 목록</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<?php
    require "./menu.php";
    session_start();
    $cartId = session_id();
?>
<br>
<main>
<div class="container py-5">
  <div class="p-5 mb-4 bg-body-tertiary rounded-3">
    <div class="container-fluid py-5">
      <h1 class="display-5 fw-bold">장바구니</h1>
      <p class="col-md-8 fs-4">CartList</p>
    </div>
  </div>

  <div class="row align-items-md-stretch text-center">
    <div class="col-md-12">
      <div class="p-5">
          <table width="100%">
            <tr>
              <td style="text-align:left">
                <a href="./deleteCart.php?cartId=<?= htmlspecialchars($cartId) ?>" class="btn btn-danger">삭제하기</a>
              </td>
              <td style="text-align:right">
                <a href="./shippingInfo.php?cartId=<?= htmlspecialchars($cartId) ?>" class="btn btn-success">주문하기</a>
              </td>
            </tr>
          </table>
      </div>
      <div>
      <table class="table table-hover">
        <tr>
          <th>도서</th>
          <th>가격</th>
          <th>수량</th>
          <th>소계</th>
          <th>비고</th>
        </tr>
      <?php
          $sum = 0;
          $cartList = $_SESSION["cartlist"] ?? null;
          $count = $cartList ? count($cartList) : 0;

          if ($count > 0) {
              foreach ($cartList as $id => $book) {
                  $total = $book["unitPrice"] * $book["quantity"];
                  $sum += $total;
      ?>
              <tr>
                <td width="20%"><?= htmlspecialchars($id) ?> = <?= htmlspecialchars($book["name"]) ?></td>
                <td width="10%"><?= htmlspecialchars($book["unitPrice"]) ?></td>
                <td width="10%"><?= htmlspecialchars($book["quantity"]) ?></td>
                <td width="10%"><?= htmlspecialchars($total) ?></td>
                <td width="10%">
                  <a href="./removeCart.php?id=<?= htmlspecialchars($id) ?>" class="badge text-bg-danger">삭제</a>
                </td>
              </tr>
      <?php
              }
          } else {
              echo '<tr><td colspan="5">장바구니가 비어 있습니다.</td></tr>';
          }
      ?>
        <tr>
          <th></th>
          <th></th>
          <th>총액</th>
          <th><?= htmlspecialchars($sum) ?></th>
          <th></th>
        </tr>
      </table>
      </div>

      <div class="col-md-2">
        <a href="./books.php" class="btn btn-secondary">&laquo; 쇼핑 계속하기</a>
      </div>
    </div>
  </div>
</div>
</main>
<?php
  require "./footer.php";
?>
</body>
</html>
