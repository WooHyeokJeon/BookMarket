<!doctype html>
<html class="h-100" >   
<title>회원 가입</title>
<head> 
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">    
    <script type="text/javascript">
	function checkForm() {
		if (!document.newMember.id.value) {
			alert("아이디를 입력하세요.");
			return false;
		}

		if (!document.newMember.password.value) {
			alert("비밀번호를 입력하세요.");
			return false;
		}

		if (document.newMember.password.value != document.newMember.password_confirm.value) {
			alert("비밀번호를 동일하게 입력하세요.");
			return false;
		}
	}
    </script>
     <!-- Custom styles for this template -->
</head>
<body class="d-flex flex-column h-100">   
  <?php    
    require "../menu.php";
    require "../dbconn.php";
  ?>
<br>
<main>
<div class="container py-5">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">회원 가입</h1>
            <p class="col-md-8 fs-4">Membership Joining</p>
        </div>
    </div>
    <div class="row align-items-md-stretch">      
        <div class="col-md-12">
            <div class="h-100 p-5">
                <form name="newMember" action="./processAddMember.php" method ="post"  onsubmit="return checkForm()">			
                    <div class="mb-3 row">
                        <label class="col-sm-2">아이디</label>
                        <div class="col-sm-3">
                            <input type="text" name="id" class="form-control" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">비밀번호</label>
                        <div class="col-sm-3">
                            <input type="password" name="password" class="form-control" >
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
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">성별</label>
                        <div class="col-sm-5">
                            <input name="gender" type="radio" value="남" /> 남 
                            <input name="gender" type="radio" value="여" /> 여
                        </div>
                    </div>       
                    <div class="mb-3 row">
                        <label class="col-sm-2">생일</label>           
                        <div class="col-sm-10  ">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" name="birthyy" maxlength="4"  class="form-control" placeholder="년(4자)" size="6"> 
                                </div>
                                <div class="col-sm-2">
                                    <select name="birthmm" class="form-select">
                                        <option value="">월</option>
                                        <option value="01">1</option>
                                        <option value="02">2</option>
                                        <option value="03">3</option>
                                        <option value="04">4</option>
                                        <option value="05">5</option>
                                        <option value="06">6</option>
                                        <option value="07">7</option>
                                        <option value="08">8</option>
                                        <option value="09">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select> 
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="birthdd" maxlength="2" class="form-control" placeholder="일" size="4">
                                </div>
				            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">이메일</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" name="mail1" maxlength="50" class="form-control"  placeholder="email">
                                </div> @
                                <div class="col-sm-3">
                                    <select name="mail2" class="form-select">
                                        <option>naver.com</option>
                                        <option>daum.net</option>
                                        <option>gmail.com</option>
                                        <option>nate.com</option>
                                    </select>
                                </div>
                            </div>		
                        </div>		
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">전화번호</label>
                        <div class="col-sm-3">
                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>        
                    <div class="mb-3 row">
                        <label class="col-sm-2">주소</label>
                        <div class="col-sm-5">
                        <input type="text" name="address" class="form-control">
                        </div>				
                    </div>	        
                    <div class="mb-3 row">
                        <div class="col-sm-offset-2 col-sm-10 ">
                            <input type="submit" class="btn btn-primary" value="등록" >
                            <input type="reset" class="btn btn-primary " value="취소 " onclick="reset()" >
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
