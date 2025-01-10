<?php
// 유효성 검사 함수 정의
function filterBookId($field) {
    $field = trim($field);
    return filter_var($field, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^ISBN[0-9]{4,11}$/"]]) ? $field : false;
}

function filterName($field) {
    $field = trim($field);
    return (strlen($field) >= 4 && strlen($field) <= 50) ? $field : false;
}

function filterPrice($field) {
    $field = trim($field);
    return (filter_var($field, FILTER_VALIDATE_FLOAT) && $field >= 0) ? $field : false;
}

function filterStock($field) {
    $field = trim($field);
    return filter_var($field, FILTER_VALIDATE_INT) ? $field : false;
}

function filterDescription($field) {
    $field = trim($field);
    return (!empty($field) && strlen($field) >= 10) ? $field : false;
}

// 에러 변수 초기화
$bookIdErr = $nameErr = $unitPriceErr = $descriptionErr = $unitsInStockErr = $bookImageErr = "";

// POST 요청 처리
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bookId = $_POST["bookId"] ?? '';
    $name = $_POST["name"] ?? '';
    $unitPrice = $_POST["unitPrice"] ?? '';
    $author = $_POST["author"] ?? '';
    $description = $_POST["description"] ?? '';
    $category = $_POST["category"] ?? '';
    $unitsInStock = $_POST["unitsInStock"] ?? '';
    $releaseDate = $_POST["releaseDate"] ?? '';
    $condition = $_POST["condition"] ?? '';
    $filename = $_FILES["bookImage"]["name"] ?? '';

    // 유효성 검사
    if (empty($bookId) || !filterBookId($bookId)) {
        $bookIdErr = "도서코드를 올바르게 입력하세요 (ISBN + 숫자, 5~12자).";
    }

    if (empty($name) || !filterName($name)) {
        $nameErr = "도서명을 최소 4자에서 최대 50자까지 입력하세요.";
    }

    if (empty($unitPrice) || !filterPrice($unitPrice)) {
        $unitPriceErr = "가격은 양수이며 소수점 둘째 자리까지만 입력 가능합니다.";
    }

    if (empty($unitsInStock) || !filterStock($unitsInStock)) {
        $unitsInStockErr = "재고수는 정수로 입력하세요.";
    }

    if (empty($description) || !filterDescription($description)) {
        $descriptionErr = "상세 설명은 최소 10자 이상 입력하세요.";
    }

    if (empty($filename)) {
        $bookImageErr = "이미지를 업로드하세요.";
    }

    // 데이터베이스 저장
    if (empty($bookIdErr) && empty($nameErr) && empty($unitPriceErr) && empty($descriptionErr) && empty($unitsInStockErr) && empty($bookImageErr)) {
        $target_path = "resources/images/";
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = $bookId . "." . $ext;

        if (move_uploaded_file($_FILES["bookImage"]["tmp_name"], $target_path . $filename)) {
            require "./dbconn.php";

            $sql = "INSERT INTO book (b_id, b_name, b_unitPrice, b_author, b_description, 
                    b_category, b_unitsInStock, b_releaseDate, b_condition, b_filename) 
                    VALUES ('$bookId', '$name', '$unitPrice', '$author', '$description', '$category', 
                    '$unitsInStock', '$releaseDate', '$condition', '$filename')";

            if (mysqli_query($conn, $sql)) {
                header("Location:books.php");
                exit();
            } else {
                echo "데이터베이스 저장 중 오류가 발생했습니다.";
            }
        } else {
            echo "이미지 업로드 중 오류가 발생했습니다.";
        }
    } else {
        require "./addBook_error.php";
    }
}
?>
