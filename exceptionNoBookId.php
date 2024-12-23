<!--
특정 도서가 데이터베이스에서 조회되지 않을 때, 사용자에게 알림을 제공하고 도서 목록 페이지로 돌아갈 수 있도록 해줌
-->
<br>
 <main>
    <div class="container py-5">
      <div class="p-5 mb-4 bg-body-tertiary rounded -3">
        <div class="container-fluid py-5">
          <h1 class ="alert alert-danger"> 해당 도서가 존재하지 않습니다.</h1>
        </div>
      </div>


    <?php
      #사용자가 방문 중인 페이지의 URL을 생성해 호출

      #현재 서버의 호스트 이름
      $http_host = $_SERVER['HTTP_HOST'];

      #현재 요청된 URI
      $request_uri = $_SERVER['REQUEST_URI'];
      $url = 'http://'.$http_host.$request_uri;
    ?>

    <div class = "row align-items-md-stretch">
      <div class="col-md-12">
        <div class="h-100 p-5">
          <p><?php echo $url;?>
          <p><a href = "books.php" class="btn btn-secondary"> 도서 목록 &raquo;</a>
        </div>
      </div>
    </div>
  </div>
</main>


