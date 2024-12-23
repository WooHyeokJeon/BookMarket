<?php
    #도서를 장바구니에 추가하는 로직

    #도서 ID 검증 : 
    #URL에서 ID를 가져오고, 값이 없으면 book.php 리디렉션
    $bookId = $_GET["id"];
    if($bookId == null || $bookId =="") {
        header("Location:books.php");
        return;
    }

    #도서 조회 :
    #model.php를 통해 getBookById($bookId) 함수로 도서 정보를 가져옴
    require "./model.php";
    $book = getBookById($bookId);
    if($book == null) {
        header("Location:exceptionNobookId.php");
    }

    #장바구니 세션 관리 :
    #세션 시작 -> cartlist 세션이 설정되어 있는지 확인
    session_start();
    if(isset($_SESSION['cartlist'])) {
        $count = count($_SESSION["cartlist"]);
        $goodsList = $_SESSION["cartlist"];

        $cnt = 0;
        $goodsQnt="";
        for($i = 0; $i < $count; $i++) {
            $goodsid = key($goodsList);
            $goods = $goodsList[$goodsid];

            #장바구니 업데이트 :
            #동일한 도서가 이미 장바구니에 있을 경우 -> 수량을 증가시킴
            if($goodsid==$bookId) {
                $cnt++;
                $goods["quantity"]= $goods["quantity"] + 1;
                $_SESSION["cartlist"][$bookId] = $goods;

                break;
            }
            next($goodsList);
        }

        #새로운 도서를 추가하는 경우 :
        if($cnt ==0) {
            $goods = getBookById($bookId);
            $goods["quantity"] = 1;
            $_SESSION["cartlist"][$bookId] = $goods;
        }
    }
    else {
        $book = getBookById($bookId);
        $book["quantity"] = 1;
        $_SESSION["cartlist"][$bookId] = $book;
    }
    header("Location:book.php?id=".$bookId);
?>