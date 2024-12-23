<?php

  require "../dbconn.php";
  session_start();
  $sessionID = $_SESSION['sessionID'];
  $sql = "DELETE FROM member WHERE id = '$sessionID'";
  $result = mysqli_query($conn, $sql);

  mysqli_close($conn);
  session_unset();
  Header("Location:resultMember.php?msg=3"); 

?>
