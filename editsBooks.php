<!doctype html>
<html class="h-100">
<head>
    <title>도서 편집</title>
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteConfirm(id) {
            if (confirm("해당 도서를 삭제하시겠습니까?")) {
                location.href = './deleteBook.php?id=' + id;
            } else {
                return;
            }
        }
    </script>
</head>
<body class="d-flex flex-column h-100">
<?php
    require "./menu.php";
    require "./dbconn.php";

    // 도서 편집 유형 확인
    $edit = $_GET["edit"] ?? '';
?>
<br>
<main>
    <div class="container py-5">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">도서 편집</h1>
                <p class="col-md-8 fs-4">BookList</p>
            </div>
        </div>

        <div class="row align-items-md-stretch text-center">
        <?php
            // 도서 목록 조회
            $sql = "SELECT * FROM book";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="col-md-4">
                <div class="h-100 p-5">
                    <img src="./resources/images/<?= htmlspecialchars($row['b_fileName']); ?>" style="width:100%">
                    <h2><?= htmlspecialchars($row["b_name"]); ?></h2>
                    <p><?= htmlspecialchars($row["b_author"]) . " | " . htmlspecialchars($row["b_releaseDate"]); ?></p>
                    <p><?= mb_substr(htmlspecialchars($row["b_description"]), 0, 90, 'utf-8') . "..."; ?></p>
                    <p><?= htmlspecialchars($row["b_unitPrice"]); ?>원</p>
                    <p>
                        <?php if ($edit === "update") { ?>
                            <a href="./updateBook.php?id=<?= htmlspecialchars($row["b_id"]); ?>">
                                <button class="btn btn-success" type="button">수정</button>
                            </a>
                        <?php } elseif ($edit === "delete") { ?>
                            <a href="#" onclick="deleteConfirm('<?= htmlspecialchars($row['b_id']); ?>')"
                               class="btn btn-danger" type="button">삭제</a>
                        <?php } ?>
                    </p>
                </div>
            </div>
        <?php
            }
            mysqli_free_result($result);
            mysqli_close($conn);
        ?>
        </div>
    </div>
</main>
<?php require "./footer.php"; ?>
</body>
</html>
