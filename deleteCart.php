<?php
    #세션에 저장된 장바구니 데이터를 완전히 삭제하는 기능을 담당

    #기존 세션 데이터 불러옴
    session_start();

    #URL을 통해 cartId 값을 가져옴 -> cartId가 비어 있거나 null이면 cart.php로 리디렉션
    $cartId = $_GET["cartId"];
    if($cartId == null || $cartId ==""){
        header("Location:cart.php");
        return;
    }

    #현재 세션을 완전히 종료하고, 세션에 저장된 모든 데이터를 삭제
    #아마도 : 장바구니뿐 아니라 해당 세션에 저장된 정보 모두 삭제됨. (로그인도 !)
    #회원가입 정보가 사라지는게 아니라 로그아웃이 되어버림

    /*
    // 장바구니 데이터 확인 및 삭제
        if (isset($_SESSION["cartlist"])) {
            unset($_SESSION["cartlist"]); // 장바구니 데이터만 삭제
        }
    이렇게 바꾸면 책만 삭제
    */
    
    session_destroy();
    header("Location:cart.php");
?>