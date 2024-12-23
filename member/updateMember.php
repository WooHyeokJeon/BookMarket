<!doctype html>
<html class="h-100" >   
<title>회원 수정</title>
<head> 
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">    
    <script type="text/javascript">
	function checkForm() {		
		if (!document.newMember.password.value) {
			alert("비밀번호를 입력하세요.");
			return false;
		}
		if (document.newMember.password.value != document.newMember.password_confirm.value) {
			alert("비밀번호를 동일하게 입력하세요.");
			return false;
		}
        document.newMember.submit();
	}

   
    function deleteConfirm() {
        if (confirm("회원을 탈퇴합니다!!") == true)
            location.href = "./deleteMember.php";
        else
            return;
    }
    </script> 
</head>
<body class="d-flex flex-column h-100">   
    <?php 
    require "../menu.php";
    require "../dbconn.php";
    
    $sessionID = $_SESSION["sessionID"];
    $sessionPW = $_SESSION["sessionPW"];

    $sql = "SELECT * FROM member where id = '$sessionID' and password = '$sessionPW'";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0) 
        $row = mysqli_fetch_array($result);   

    ?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">회원 수정</h1>
            <p class="col-md-8 fs-4">Membership Updating</p>
        </div>
    </div>
    
    <div class="row align-items-md-stretch">      
        <div class="col-md-12">
        <div class="h-100 p-5">
            <form name="newMember" action="./processUpdateMember.php" method ="post"  onsubmit="return checkForm()">	
                <input name="id" type="hidden" class="form-control" value="<?=$row['id']?>"	>	 		
                <div class="mb-3 row">
                    <label class="col-sm-2">아이디</label>
                    <div class="col-sm-3">
                        <input type="text" name="id" value="<?php echo $row['id']; ?>" disabled  class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2">비밀번호</label>
                    <div class="col-sm-3">
                        <input type="password" name="password" value="<?php echo $row['password']; ?>" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2">비밀번호확인</label>
                    <div class="col-sm-3">
                        <input type="password" name="password_confirm" class="form-control" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2">성명</label>
                    <div class="col-sm-3">
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2">성별</label>
                    <div class="col-sm-5">
                        <input name="gender" type="radio" value="남" <?php if ( $row['gender']=="남") echo "checked"; ?>/> 남 
                        <input name="gender" type="radio" value="여" <?php if ( $row['gender']=="여") echo "checked"; ?>/> 여
                    </div>
                </div>
                <?php
                    $birth =  explode("/", $row['birth']);
                    $year=$birth[0];
                    $month=$birth[1];
                    $day=$birth[2];
                ?>

                <div class="mb-3 row">
                    <label class="col-sm-2">생일</label>           
                    <div class="col-sm-10  ">
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="text" name="birthyy"  value="<?php echo $year; ?>" maxlength="4"  class="form-control" placeholder="년(4자)" size="6"> 
                            </div>
                            <div class="col-sm-2">
                                <select name="birthmm" class="form-select">
                                    <option value="">월</option>
                                    <option value="01" <?php if($month=="1") echo "selected"; ?>> 1</option>
                                    <option value="02" <?php if($month=="2") echo "selected"; ?>>2</option>
                                    <option value="03" <?php if($month=="3") echo "selected"; ?>>3</option>
                                    <option value="04" <?php if($month=="4") echo "selected"; ?>>4</option>
                                    <option value="05" <?php if($month=="5") echo "selected"; ?>>5</option>
                                    <option value="06" <?php if($month=="6") echo "selected"; ?>>6</option>
                                    <option value="07" <?php if($month=="7") echo "selected"; ?>>7</option>
                                    <option value="08" <?php if($month=="8") echo "selected"; ?>>8</option>
                                    <option value="09" <?php if($month=="9") echo "selected"; ?>>9</option>
                                    <option value="10" <?php if($month=="10") echo "selected"; ?>>10</option>
                                    <option value="11" <?php if($month=="11") echo "selected"; ?>>11</option>
                                    <option value="12" <?php if($month=="12") echo "selected"; ?>>12</option>
                                </select> 
                            </div>
                            <div class="col-sm-2">
                                <input type="text" name="birthdd" value="<?php echo $day; ?>" maxlength="2" class="form-control" placeholder="일" size="4">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    $mail =  explode("@", $row['mail']);
                    $mail1 =  $mail[0];
                    $mail2 =  $mail[1];
                ?>       
                <div class="mb-3 row">
                    <label class="col-sm-2">이메일</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" name="mail1" value="<?php echo $mail1; ?>" maxlength="50" class="form-control"  placeholder="email">
                            </div> @
                            <div class="col-sm-3">
                                <select name="mail2" class="form-select">
                                    <option <?php if($mail2=="naver.com") echo "selected"; ?>>naver.com</option>
                                    <option <?php if($mail2=="daum.net") echo "selected"; ?>>daum.net</option>
                                    <option <?php if($mail2=="gmail.com") echo "selected"; ?>>gmail.com</option>
                                    <option <?php if($mail2=="nate.com") echo "selected"; ?>>nate.com</option>
                                </select>
                            </div>
                        </div>		
                    </div>		
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2">전화번호</label>
                    <div class="col-sm-3">
                        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" class="form-control">
                    </div>
                </div>        
                <div class="mb-3 row">
                    <label class="col-sm-2">주소</label>
                    <div class="col-sm-5">
                        <input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control">
                    </div>				
                </div>	        
                <div class="mb-3 row">
                    <div class="col-sm-offset-2 col-sm-10 ">
                        <input type="submit" class="btn btn-primary" value="회원수정" >
                        <a href="#" onClick=deleteConfirm() class="btn btn-danger">회원탈퇴</a>
                    </div>
                </div>
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
