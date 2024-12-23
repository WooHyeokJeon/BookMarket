<?php
    #디비연결
    $conn = mysqli_connect("localhost", "root", "", "class2");

    if(!$conn) {
        die("데이터베이스 접근 실패!!".myshell_connect_arror());
    }



    /*
    $conn = new mysqli("localhost", "root", "", "class2");

    if($conn -> connect_error){
        die("데이터 베이스 연겨 실패".$conn ->connect_error);
    }
    echo "데이터 베이스 연결 성공".$conn->host_info;

    $conn -> close();
    */




  
/*
    절차 지향                       객체 지향

서버에 대한 새 연결 수행 : 
mysqli_connect()            mysqli::__construct()
mysqli_real_connect()       mysqli::real_connect()

이전에 열린 데이터 베이스 연결 닫기 : 
mysqli_close()              mysqli::close()

마지막 연결 호출의 오류 코드를 반환 : 
mysqli_connect_errno()
mysqli_connect_error()

연결 유형을 나타내는 문자열을 반환 : 
mysqli_get_host_info()

서버 버전을 나타내는 문자열을 반환 :
mysqi_get_server_info()
*/


?>