<?php
// 도서 데이터를 관리하는 모델 역할을 수행하는 PHP 파일

// 도서 데이터 파일 열기
$handle = fopen("domain.dat", "r");
if (!$handle) {
    die("도서 데이터 파일을 열 수 없습니다.");
}

global $BookArray;

// 도서 데이터 로드
while (!feof($handle)) {
    $line = fgets($handle);
    if (trim($line) === '') continue; // 빈 줄 건너뛰기

    // 데이터를 | 문자로 분리
    $array = explode("|", $line);
    $id = trim($array[0]);

    $BookArray[$id] = [
        "name" => trim($array[1]),
        "unitPrice" => trim($array[2]),
        "author" => trim($array[3]),
        "description" => trim($array[4]),
        "category" => trim($array[5]),
        "unitsInStock" => trim($array[6]),
        "releaseDate" => trim($array[7]),
        "condition" => trim($array[8]),
        "filename" => trim($array[9]),
        "quantity" => trim($array[10])
    ];
}

fclose($handle);

// 모든 도서 데이터를 반환
function getAllBooks()
{
    global $BookArray;
    return $BookArray;
}

// 주어진 ID에 해당하는 도서 정보를 반환
function getBookById($id)
{
    global $BookArray;
    return $BookArray[$id] ?? null;
}

// 도서 추가 또는 업데이트
function addBook($bookId, $nbook)
{
    global $BookArray;

    $BookArray[$bookId] = [
        "name" => $nbook["name"],
        "unitPrice" => $nbook["unitPrice"],
        "author" => $nbook["author"],
        "description" => $nbook["description"],
        "category" => $nbook["category"],
        "unitsInStock" => $nbook["unitsInStock"],
        "releaseDate" => $nbook["releaseDate"],
        "condition" => $nbook["condition"],
        "filename" => $nbook["filename"],
        "quantity" => $nbook["quantity"]
    ];
}
?>
