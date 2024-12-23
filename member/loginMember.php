<!doctype html>
<html class="h-100" >
<head>    
    <title>Welcome</title>
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
            <h1 class="display-5 fw-bold">회원 로그인</h1>
            <p class="col-md-8 fs-4">Membership Login</p>
        </div>
    </div> 
        
    <div class="container text-align-center">
        <div class="col-md-6">
            <div class="h-100 p-5">    
                <h3 class="form-signin-heading">Please sign in</h3>              
                <?php    
                    $error ="";
                    if(isset($_GET["error"])) $error = $_GET["error"];
                    if ($error != null) {
                        echo ("<div class='alert alert-danger'>");
                        echo("아이디와 비밀번호를 확인해 주세요");
                        echo("</div>");
                    }             
                ?>    
               
                <form class="form-signin" action="processLoginMember.php" method="post">
        
                    <div class="form-floating mb-3 row">     
                        <input type="text" class="form-control" name='id' placeholder="ID" required autofocus>
                        <label for="floatingInput">ID</label>      
                    </div>
                    <div class="form-floating  mb-3 row">     
                        <input type="password" class="form-control" name='password' placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>   
                    <button class="btn btn btn-lg btn-success btn-block" type="submit">로그인</button>   				
                </form>
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