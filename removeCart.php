<?php
    session_start();
    $bookId = $_GET["id"];

    if($bookId == null || $bookId =="") {
        header("Location:books.php");
        return;
    }

    require "./model.php";

    $book = getBookById($bookId);

    if($book == null) {
        header("Location:exceptionNobookId.php");
    }

    #장바구니에서 도서 제거

    #cartlist 세션에서 현재 장바구니 항목들을 가져옴
    #장바구니 항목 수를 $count로 지정
    $count = count($_SESSION["cartlist"]);
    $goodsList = $_SESSION["cartlist"];

    for ($i = 0; $i < $count; $i++) {

        #key(goodsList)를 사용해 현재 항목의 키(goodsid, 즉 도서 ID를 가져옴)
        $goodsid = key($goodsList);
        //$goods = $goodsList[$goodsid];

        #$goodid == $bookId 이면 해당 항목을 장바구니에서 제거
        if($goodsid==$bookId) {
            unset($_SESSION["cartlist"][$bookId]);
        }
        next($goodsList);
    }
    header("Location:cart.php");
?>