<!--
주문 확인 페이지
세션(cartlist)와 쿠키(Shipping_XXX) 데이터를 사용해 정보 표시
-->
<!doctype html>
<html class="h-100" >   
<head>
    <title>주문 정보</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" ></script>
     <!-- Custom styles for this template -->
</head>
<body class="d-flex flex-column h-100">   
  <?php  
    require "./menu.php";   
    
    #쿠키 데이터를 읽어 배송 정보 표시
    $shipping_cartId = $_COOKIE["Shipping_cartId"];
    $shipping_name = $_COOKIE["Shipping_name"];
    $shipping_shippingDate = $_COOKIE["Shipping_shippingDate"];
    $shipping_country = $_COOKIE["Shipping_country"];
    $shipping_zipCode = $_COOKIE["Shipping_zipCode"];
    $shipping_addressName = $_COOKIE["Shipping_addressName"];

  ?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">주문 정보</h1>
        <p class="col-md-8 fs-4">Order Info</p>
      </div>
    </div> 
   
    <div class="row align-items-md-stretch alert alert-info text-center">
      <div class="col-md-12">
        <div class="p-5">
          <div >
                <h1>영수증</h1>
          </div>

          <div class="row justify-content-between">
			      <div class="col-4" style="text-align:left">
				      <strong>배송 주소</strong> <br> 성명 : <?= $shipping_name?><br> 
				      우편번호 : <?= $shipping_zipCode?><br> 
				      주소 : <?= $shipping_addressName?>(<?= $shipping_country?>)<br>
			      </div>
            <div class="col-4" style="text-align:right">
				      <p>	<em>배송일: <?= $shipping_shippingDate?></em>
			      </div>
		      </div>		
        </div>

			  <table class="table table-hover">
          <tr>
            <th>도서</th>
            <th>#</th>
            <th>가격</th>
            <th>소계</th>				
          </tr>
				
          <?php
          #장바구니 데이터 출력

          #세션 $_SESSION["cartlist"]에서 장바구니 데이터를 가져옴
          #장바구니가 비어있으면 $count = 0, 아니면 데이터 개수를 $count에 저장
          session_start();
          $sum = 0;
          $cartList = "";

          if(isset($_SESSION["cartlist"]))
              $cartList = $_SESSION["cartlist"];

          if($cartList == null)
              $count = 0;
          else $count = count($cartList);


          
          for($i = 0; $i < $count; $i++, next($cartList)) {
            $id = key($cartList);
            $book = $cartList[$id];
            $total = $book["unitPrice"] * $book["quantity"];
            $sum = $sum + $total;
          ?>

          <tr>
            <td class="text-center"><em><?=$book["name"]?></em></td>
            <td class="text-center"><?=$book["quantity"]?> </td>
            <td class="text-center"><?=$book["unitPrice"]?> 원</td>
            <td class="text-center"><?=$total ?> 원</td>
			    </tr>
          <?php
              }
          ?>
          <tr>
            <th></th>
            <th></th>
            <th><strong>총액: </strong></th>
            <th><strong><?=$sum?> </strong></th>            
          </tr>
			  </table>
			
        <a href="./ShippingInfo.php?cartId=<?=$shipping_cartId?>"class="btn btn-secondary" role="button"> 이전 </a>
				<a href="./thankCustomer.php"  class="btn btn-success" role="button"> 주문 완료 </a>
				<a href="./checkOutCancelled.php" class="btn btn-secondary"	role="button"> 취소 </a>	
      </div>
    </div>
</div> 
</main>
<?php     
    require "./footer.php";
?>
</body>
</html>
