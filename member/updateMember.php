<!doctype html>
<html class="h-100">
<head>
    <title>회원 수정</title>
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
        function checkForm() {
            const password = document.newMember.password.value;
            const confirmPassword = document.newMember.password_confirm.value;

            if (!password) {
                alert("비밀번호를 입력하세요.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("비밀번호를 동일하게 입력하세요.");
                return false;
            }

            return true;
        }

        function deleteConfirm() {
            if (confirm("회원을 탈퇴합니다!!")) {
                location.href = "./deleteMember.php";
            }
        }
    </script>
</head>
<body class="d-flex flex-column h-100">
<?php
    require "../menu.php";
    require "../dbconn.php";

    session_start();
    $sessionID = $_SESSION["sessionID"] ?? null;
    $sessionPW = $_SESSION["sessionPW"] ?? null;

    if (!$sessionID || !$sessionPW) {
        echo "<script>alert('로그인이 필요합니다.'); location.href='./loginMember.php';</script>";
        exit;
    }

    $sql = "SELECT * FROM member WHERE id = '$sessionID' AND password = '$sessionPW'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "<script>alert('회원 정보를 불러올 수 없습니다.'); location.href='./loginMember.php';</script>";
        exit;
    }
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
                <form name="newMember" action="./processUpdateMember.php" method="post" onsubmit="return checkForm()">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="mb-3 row">
                        <label class="col-sm-2">아이디</label>
                        <div class="col-sm-3">
                            <input type="text" value="<?= $row['id'] ?>" disabled class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">비밀번호</label>
                        <div class="col-sm-3">
                            <input type="password" name="password" value="<?= $row['password'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">비밀번호 확인</label>
                        <div class="col-sm-3">
                            <input type="password" name="password_confirm" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">성명</label>
                        <div class="col-sm-3">
                            <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">성별</label>
                        <div class="col-sm-5">
                            <input type="radio" name="gender" value="남" <?= $row['gender'] === "남" ? "checked" : "" ?>> 남
                            <input type="radio" name="gender" value="여" <?= $row['gender'] === "여" ? "checked" : "" ?>> 여
                        </div>
                    </div>
                    <?php
                        [$year, $month, $day] = explode("/", $row['birth']);
                    ?>
                    <div class="mb-3 row">
                        <label class="col-sm-2">생일</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <input type="text" name="birthyy" value="<?= $year ?>" maxlength="4" class="form-control" placeholder="년(4자)">
                                </div>
                                <div class="col-sm-2">
                                    <select name="birthmm" class="form-select">
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?= sprintf("%02d", $i) ?>" <?= $month == $i ? "selected" : "" ?>><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="birthdd" value="<?= $day ?>" maxlength="2" class="form-control" placeholder="일">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        [$mail1, $mail2] = explode("@", $row['mail']);
                    ?>
                    <div class="mb-3 row">
                        <label class="col-sm-2">이메일</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" name="mail1" value="<?= $mail1 ?>" maxlength="50" class="form-control">
                                </div> @
                                <div class="col-sm-3">
                                    <select name="mail2" class="form-select">
                                        <?php foreach (["naver.com", "daum.net", "gmail.com", "nate.com"] as $domain): ?>
                                            <option <?= $mail2 === $domain ? "selected" : "" ?>><?= $domain ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">전화번호</label>
                        <div class="col-sm-3">
                            <input type="text" name="phone" value="<?= $row['phone'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">주소</label>
                        <div class="col-sm-5">
                            <input type="text" name="address" value="<?= $row['address'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-primary" value="회원수정">
                            <a href="#" onclick="deleteConfirm()" class="btn btn-danger">회원탈퇴</a>
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
    mysqli_free_result($result);
    mysqli_close($conn);
?>
</body>
</html>
