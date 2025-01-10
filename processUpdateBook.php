<?php

// 도서 코드 유효성 검사 함수
function filterBookId($field) {
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if (preg_match("/^ISBN[0-9]{4,11}$/", $field)) {
        return $field;
    }
    return false;
}

// 도서명 유효성 검사 함수
function filterName($field) {
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    return (strlen($field) >= 4 && strlen($field) <= 50) ? $field : false;
}

// 가격 유효성 검사 함수
function filterPrice($field) {
    $field = trim($field);
    return (is_numeric($field) && $field >= 0) ? $field : false;
}

// 재고수 유효성 검사 함수
function filterStock($field) {
    $field = trim($field);
    return filter_var($field, FILTER_VALIDATE_INT);
}

// 상세 설명 유효성 검사
function filterDescription($field) {
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    return (strlen($field) >= 80) ? $field : false;
}

// 오류 메시지 초기화
$bookIdErr = $nameErr = $unitPriceErr = $descriptionErr = $unitsInStockErr = $bookImageErr = "";

// 데이터베이스 연결 파일 포함
require "./dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼 데이터 수신
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
    if (!$bookId || !filterBookId($bookId)) $bookIdErr = "ISBN과 숫자를 조합하여 5~12자까지 입력하세요";
    if (!$name || !filterName($name)) $nameErr = "최소 4자에서 최대 50자까지 입력하세요";
    if (!$unitPrice || !filterPrice($unitPrice)) $unitPriceErr = "숫자만 입력하세요";
    if (!$description || !filterDescription($description)) $descriptionErr = "최소 80자 이상 입력하세요";
    if (!$unitsInStock || !filterStock($unitsInStock)) $unitsInStockErr = "숫자만 입력하세요";

    if (!$bookIdErr && !$nameErr && !$unitPriceErr && !$descriptionErr && !$unitsInStockErr) {
        $target_path = "resources/images/";
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = $bookId . "." . $ext;

        if (!empty($filename) && move_uploaded_file($_FILES['bookImage']['tmp_name'], $target_path . $filename)) {
            $imageSql = ", b_fileName = '$filename'";
        } else {
            $imageSql = "";
        }

        $sql = "UPDATE book SET 
                b_name = '$name', 
                b_unitPrice = $unitPrice, 
                b_author = '$author', 
                b_description = '$description',  
                b_category = '$category', 
                b_unitsInStock = '$unitsInStock', 
                b_releaseDate = '$releaseDate', 
                b_condition = '$condition' 
                $imageSql 
                WHERE b_id = '$bookId'";

        if (mysqli_query($conn, $sql)) {
            header("Location:editsBooks.php?edit=update");
            exit();
        }
        mysqli_close($conn);
    }

    // 오류가 있으면 updateBook_Error.php로 이동
    require "./updateBook_Error.php";
}
?>
