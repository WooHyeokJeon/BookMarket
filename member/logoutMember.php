<?php
session_start();

// 세션 데이터 삭제
session_unset();

// 세션 완전 종료
session_destroy();

// 로그아웃 성공 메시지 전달
header("Location: loginMember.php?message=logged_out");
exit();
?>
