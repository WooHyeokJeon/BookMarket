<?php
    $cartId = $_GET["cartId"];

    #setcookie 함수는 php에서 사용자 브라우저에 쿠키를 설정하기 위해 사용
    #쿠키는 클라이언트 측에 저장, 이후 요청 시 서버에 자동으로 전송

    #매개 변수 :    
    #Shipping_cartId : 쿠키 이름. 브라우저에서 쿠키 식별하기 위해 사용
    #$_POST["cartId"] : 쿠키에 저장할 값. 폼에서 post 방식으로 전송한 값들 넣기 (name에 있는 거?)
    #time()+24*60*60 : 24시간 후에 만료 되도록
    
    setcookie("Shipping_cartId", $_POST["cartId"], time()+24*60*60);
    setcookie("Shipping_name", $_POST["name"], time()+24*60*60);
    setcookie("Shipping_shippingDate", $_POST["shippingDate"], time()+24*60*60);
    setcookie("Shipping_country", $_POST["country"], time()+24*60*60);
    setcookie("Shipping_zipCode", $_POST["zipCode"], time()+24*60*60);
    setcookie("Shipping_addressName", $_POST["addressName"], time()+24*60*60);

    header("Location:orderConfirmation.php");
?>