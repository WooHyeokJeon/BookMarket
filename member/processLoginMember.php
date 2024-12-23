<?php
session_start();
echo $id = $_POST["id"];
echo $password = $_POST["password"];

require "../dbconn.php";

$sql = "SELECT * FROM member where id = '$id' and password = '$password'";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_array($result);   
       
        $_SESSION['sessionID'] = $row['id'];
        $_SESSION['sessionPW'] = $row['password'];
        Header("Location:resultMember.php?msg=2"); 
    }
    else  Header("Location:loginMember.php?error=1");     

?>