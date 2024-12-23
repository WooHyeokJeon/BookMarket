<!--
cart.php는 장바구니에 담긴 도서의 목록을 표시하는 페이지
-->

<!doctype html>
<html class="h-100" >     
<head>
    <title>장바구니 목록</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" ></script>
     <!-- Custom styles for this template -->
</head>
<body class="d-flex flex-column h-100">   
  <?php   
    require "./menu.php";
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
  <?php
      #세션 및 장바구니 ID :
      #세션 아이디를 cartId로
      session_start();
      $cartId = session_id();          
  ?>   
    <div class="col-md-12">
      <div class="p-5">
          <table width="100%">
            <tr>
              <td style="text-align:left">
                <a href="./deleteCart.php?cartId=<?=$cartId?>" class="btn btn-danger">삭제하기</a></td>
              <td style="text-align:right">
                <a href="./shippingInfo.php?cartId=<?=$cartId?>" class="btn btn-success">주문하기</a></td>
            </tr>
          </table>
      </div>
      <div>
      <table class="table table-hover">
      <tr>
        <th>도서</th><th>가격</th><th>수량</th><th>소계</th><th>비고</th>
      </tr>				
      <?php		   
          # $cartList에 세션 변수 $_SESSION["cartlist"]를 저장
          # 장바구니에 데이터가 없다면 $cartList는 null, 그렇지 안흐면 도서 목록 배열

          $sum = 0;
          $cartList = "";
          if(isset($_SESSION["cartlist"]))
            $cartList = $_SESSION["cartlist"];

          if($cartList == null)
            $count = 0;
          else 
            $count = count($cartList);
          
          #next(cartList)는 내부 포인터를 이용해 다음 항목으로 이동
          for($i = 0; $i < $count; $i++, next($cartList)) {
            # key($cartList) : 현재 포인터 위치의 ID 반환
            $id = key($cartList);
            $book = $cartList[$id];
            $total = $book["unitPrice"] * $book["quantity"];
            $sum = $sum + $total;

          #위 포문 동작 방법 :
          # 1. key($cartList)로 현재 도서 ID를 가져옴
          # 2. $cartList[$id]로 해당 ID의 도서 정보를 가져옴
          # 3. unitPrice * quantity로 소계 계산
          # 4. 총합($sum)에 소계를 누적
      ?>
            <!--
              반복문 내부에서 도서 정보를 <table>의 <tr>로 출력
            -->
              <tr>
                <td width="20%"><?=$id ?> = <?=$book["name"]?> </td>
                <td width="10%"><?=$book["unitPrice"]?> </td>
                <td width="10%"><?=$book["quantity"]?> </td>
                <td width="10%"><?=$total?> </td>
                <td width="10%"><a href="./removeCart.php?id=<?=$id?> " class="badge text-bg-danger">삭제</a></td>
              </tr>
      <?php	
        }
      ?>
      <tr>
        <th></th>
        <th></th>
        <th>총액</th>
        <th><?=$sum ?></th>
        <th></th>
      </tr>
    </table>       
    </div>    

    <div class="col-md-2">
      <a href="./books.php" class="btn btn-secondary"> &laquo; 쇼핑 계속하기</a>
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
