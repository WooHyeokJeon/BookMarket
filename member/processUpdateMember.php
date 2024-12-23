<?php

   require "../dbconn.php";

    $id = $_POST['id'];
    $password = trim($_POST["password"]);
    $name = trim($_POST["name"]);
    $gender = trim($_POST["gender"]);
    $year = trim($_POST["birthyy"]);
    $month = trim($_POST["birthmm"]);
    $day = trim($_POST["birthdd"]);
    $birth = trim($year . "/" .$month . "/" . $day); 
    $mail1 = trim($_POST["mail1"]);  
    $mail2 = trim($_POST["mail2"]);  
    $mail =  trim($mail1. "@" .$mail2);
    $phone = trim($_POST["phone"]);   
    $address = trim($_POST["address"]);   

    $regist_day = date("Y/m/d  h:i:s");

    $sql = "UPDATE member SET password='$password', name='$name', gender='$gender' , birth ='$birth', mail='$mail',  phone= '$phone' , address='$address' , regist_day='$regist_day' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql))
        Header("Location:resultMember.php?msg=0"); 

    mysqli_free_result($result);
    mysqli_close($conn);
  
?>
