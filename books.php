<!doctype html>
<html class="h-100" >   
<head>
  <title>도서 목록</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet"> 
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js" ></script>   
    <!-- Custom styles for this template -->
</head>
<body class="d-flex flex-column h-100">
<?php
    //require "./model.php";     
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
      /*
      $listOfBooks = getAllBooks();
      for ($i = 0; $i < count($listOfBooks); $i++) {
        $id = key($listOfBooks);
        $book = $listOfBooks[$id];    
 	      next($listOfBooks);  
        */

        #book 테이블의 모든 데이터를 조회하는 SQL 구조
        $sql = "SELECT * FROM book";

        #mysqli_query는 데이터 베이스에 쿼리를 실행하기 위해 사용되는 함수
        $result = mysqli_query($conn,$sql);

        #mysqli_fetch_array()는 데이터 베이스에서 가져온 결과 집합의 한 행을 배열 형태로 반환한다
        while($row = mysqli_fetch_array($result)){    
  ?>

    <!--
    페이지에 이미지 불러오는 법
    b_???은 데이터 베이스의 테이블 열 이름을 나타낸 거
    이름은 테이블 설계 시 정해진 거
    php에서 mysql 쿼리의 결과를 가져올때 사용

    
    -->
    <div class="col-md-4">
      <div class="h-100 p-5">
        <img src="./resources/images/<?= $row['b_fileName']; ?>" style="width:100%">
        <h2><?php echo $row["b_name"]; ?></h2>
        <p><?php  echo $row["b_author"]. " | ".$row["b_releaseDate"]; ?> 		 
        <p><?php  echo mb_substr($row["b_description"], 0, 90, 'utf-8')."..."; ?> 
        <p><?php  echo $row["b_unitPrice"]; ?>원   
        <p> <a href="./book.php?id=<?= $row["b_id"]; ?>"><button class="btn btn-outline-secondary" type="button">상세 정보</button></a>       
      </div>
    </div>
    
  <?php
    }
    #mysqli_free_result()는 php에서 mysql 데이터 베이스의 쿼리 실행 결과로 생성된 메모리를 해제하는 함수
    mysqli_free_result($result);

    #mysqli_close()는 php에서 mysql 데이터베이스 연결을 종료하는 함수
    mysqli_close($conn);
   ?>     
    </div>

</main>
<?php     
    require "./footer.php";
?>
</body>
</html>
