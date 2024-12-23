<!doctype html>
<html class="h-100" >   
  <title>도서 정보</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet"> 
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" ></script>  
    <!-- Custom styles for this template -->
     <script>
        function addToCart(){
          if(confirm("도서를 장바구니에 추가하시겠습니까?")){
            document.addForm.submit();
            //document.getElementsByName("addForm")[0].submit();
          } else{
            document.addForm.reset();
          }
        }
      </script>
    </head>
  <body class="d-flex flex-column h-100">
  <?php
    //require "./model.php";    
    require "./menu.php";
    require "./dbconn.php";
    try{
      #URL에서 id 매개변수 가져옴
      $id = $_GET['id'];

      #book 테이블에서 b_id가 $id와 일치하는 행을 조회
      $sql = "SELECT * FROM book WHERE b_id='$id'";

      #결과 집합이 반환
      $result = mysqli_query($conn, $sql);

      #결과가 없으면 예외 발생
      if(mysqli_num_rows($result) <= 0)
        throw new Exception();

      #결과가 있으면 첫 번째 행을 $row 배열로 저장
      else
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
   <?php
         
    ?>
   <div class="row align-items-md-stretch">      
      <div class="col-md-5">
        <img src="./resources/images/<?= $row['b_fileName']; ?>" style="width:70%">
      </div>
      <div class="col-md-6">        
        <!-- <div class="h-100 p-5"> -->
          <h2><?php  echo $row["b_name"]; ?></h2>
          <p><?php  echo $row["b_description"]; ?> 
          <p><b>도서코드 : </b>  <span class="badge text-bg-danger"> <?php echo $id; ?></span>
          <p><b>저자</b> : <?= $row["b_author"]; ?>
          <p><b>출판일</b> : <?= $row["b_releaseDate"]; ?> 
          <p><b>분류</b> : <?= $row["b_category"]; ?> 
          <p><b>재고수</b> : <?= $row["b_unitsInStock"]; ?> 
		      <p><?= $row["b_unitPrice"]; ?>원
          <p>
          <form name = "addForm" action = "./addCart.php?id=<?= $id; ?>" method = "POST">
            <a href="#" class="btn btn-info" onclick="addToCart()"> 도서주문 &raquo;</a> 
            <a href="./cart.php" class="btn btn-warning"> 장바구니 &raquo;</a>
					  <a href="./books.php" class="btn btn-secondary"> 도서목록 &raquo;</a>
          </form>    
        <!-- </div> -->
      </div>    
    </div>

</main>
<?php    
      mysqli_free_result($result);
      mysqli_close($conn);
    }//try
      catch(Exception $e){
        require "./exceptionNoBookId.php";
      }
      require "./footer.php";
?>
</body>
</html>
