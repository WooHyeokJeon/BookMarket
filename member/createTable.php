<?php  
$host = 'localhost';  
$user = 'root';  
$pass = '';  
$conn = mysqli_connect($host, $user, $pass, "class2");  

if(! $conn )  
{  
  die('데이터베이스 연결이 실패 : ' . mysqli_connect_error());
}  

$sql = "CREATE TABLE if not exists member ( 
    id varchar(10) not null,
    password varchar(10) not null,
    name varchar(10) not null,
    gender varchar(4),
    birth  varchar(10),
    mail  varchar(30),
    phone varchar(20),
    address varchar(90),
    regist_day varchar(50),
    PRIMARY KEY (id)
)"; 

if(mysqli_query($conn, $sql)){
    echo "테이블 생성 성공.";
} else{
    echo "테이블 생성 실패. $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
?>  