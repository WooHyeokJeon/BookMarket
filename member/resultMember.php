<!doctype html>
<html class="h-100" >
<head>    
    <title>회원 정보</title>
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">    
   
</head>
<body class="d-flex flex-column h-100">
 
<?php     
    require "../menu.php";
?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
        <?php
    		if(isset( $_GET["msg"]))                
                $msg = $_GET["msg"];

      		if ($msg=="0"|| $msg=="2" || $msg=="3"){
        ?>                
            <h1 class="display-5 fw-bold">회원 정보</h1>
            <p class="col-md-8 fs-4">Membership Info</p>

        <?php
            } else if ($msg=="1"){  
        ?>
            <h1 class="display-5 fw-bold">회원 가입</h1>
            <p class="col-md-8 fs-4">Membership Joining</p>
        <?php
            }
        ?>
        </div>
    </div> 
        
    <div class="row align-items-md-stretch text-center">
        <div class="col-md-12">
            <div class="h-100 p-5">   
            <?php
            if ($msg != null) {
                if ($msg=="0")
                    echo "<h2 class='alert alert-danger'>회원정보가 수정되었습니다.</h2>";

                else if ($msg=="1")
                    echo " <h2 class='alert alert-danger'>회원가입을 축하드립니다.</h2>";
                else if ($msg=="2") {                    
                    $loginId = $_SESSION["sessionID"];
                    echo "  <h2 class='alert alert-danger'>" . $loginId . "님 환영합니다</h2>";
                }
                else if ($msg=="3")
                    echo " <h2 class='alert alert-danger'>회원정보가 삭제되었습니다.</h2>";
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