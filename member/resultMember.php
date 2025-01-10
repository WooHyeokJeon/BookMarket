<!doctype html>
<html class="h-100">
<head>    
    <title>회원 정보</title>
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">    
</head>
<body class="d-flex flex-column h-100">

<?php     
    require "../menu.php";
    session_start(); // 세션 시작
?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
        <?php
            // 메시지 값 확인
            $msg = isset($_GET["msg"]) ? $_GET["msg"] : null;

            // 메시지에 따른 헤더 출력
            switch ($msg) {
                case "0":
                case "2":
                case "3":
                    echo '<h1 class="display-5 fw-bold">회원 정보</h1>';
                    echo '<p class="col-md-8 fs-4">Membership Info</p>';
                    break;
                case "1":
                    echo '<h1 class="display-5 fw-bold">회원 가입</h1>';
                    echo '<p class="col-md-8 fs-4">Membership Joining</p>';
                    break;
                default:
                    echo '<h1 class="display-5 fw-bold">알 수 없는 요청</h1>';
                    echo '<p class="col-md-8 fs-4">Unknown Request</p>';
                    break;
            }
        ?>
        </div>
    </div> 
        
    <div class="row align-items-md-stretch text-center">
        <div class="col-md-12">
            <div class="h-100 p-5">
            <?php
                // 메시지에 따른 내용 출력
                if ($msg !== null) {
                    switch ($msg) {
                        case "0":
                            echo "<h2 class='alert alert-success'>회원정보가 수정되었습니다.</h2>";
                            break;
                        case "1":
                            echo "<h2 class='alert alert-success'>회원가입을 축하드립니다.</h2>";
                            break;
                        case "2":
                            $loginId = isset($_SESSION["sessionID"]) ? $_SESSION["sessionID"] : "회원";
                            echo "<h2 class='alert alert-success'>{$loginId}님 환영합니다.</h2>";
                            break;
                        case "3":
                            echo "<h2 class='alert alert-success'>회원정보가 삭제되었습니다.</h2>";
                            break;
                        default:
                            echo "<h2 class='alert alert-warning'>잘못된 요청입니다.</h2>";
                            break;
                    }
                }
            ?>
            </div>                
        </div> 
    </div>
</div>
</main>

<?php     
    require "../footer.php";
?>
</body>
</html>
