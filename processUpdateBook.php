<?php

// 도서 코드 유효성 검사 함수
function filterBookId($field){   
  $field = filter_var(trim($field));    
 
  // ISBN과 숫자가 조합된 형식인지 확인 (4~11자리 숫자)
  if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^ISBN[0-9]{4,11}$/")))){
      return $field;
  } else{
      return FALSE;
  }
}    

// 도서명 유효성 검사 함수
function filterName($field){
  $field = filter_var(trim($field));    

  // 도서명이 4자 이상 50자 이하인지 확인
  if(strlen($field) >= 4 && strlen($field)<= 50){
      return $field;
  } else{
      return FALSE;
  }
}   

// 가격 유효성 검사 함수 (정수 또는 실수)
function filterPrice($field){       
  if(filter_var(trim($field), FILTER_VALIDATE_INT) || filter_var(trim($field), FILTER_VALIDATE_FLOAT) ){
      return $field;
  } else{
      return FALSE;
  }
}   

// 가격의 소수점 둘째 자리 제한 검사
function filterPriceFloat($field){     
  $field = filter_var(trim($field));    

  // 숫자 형식이며 소수점 둘째 자리까지인지 확인
  if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[\d]*\.?[\d]{0,2}$/")))){
      return $field;
  } else{
      return FALSE;
  }
}   

// 재고수 유효성 검사 함수 (정수 확인)
function filterStock($field){
  if(filter_var(trim($field), FILTER_VALIDATE_INT)){
      return $field;
  } else{
      return FALSE;
  }
}   

// 상세 설명 유효성 검사 (80자 이상)
function filterDescription($field){
  $field = filter_var(trim($field));
  if(!empty($field) && strlen($field) >= 80){
      return $field;
  } else{
      return FALSE;
  }
}   

// 오류 메시지 초기화
$bookIdErr =  $nameErr = $unitPriceErr = $descriptionErr = $unitsInStockErr = $bookImageErr = "";

// 데이터베이스 연결 파일 포함
require "./dbconn.php";

// POST 요청 처리
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // 폼 데이터 수신
    $bookId = $_POST["bookId"];
    $name = $_POST["name"];
    $unitPrice = $_POST["unitPrice"];
    $author = $_POST["author"];
    $description = $_POST["description"];	
    $category = $_POST["category"];
    $unitsInStock = $_POST["unitsInStock"];
    $releaseDate = $_POST["releaseDate"];		 
    $condition = $_POST["condition"];  
    $filename = $_FILES["bookImage"]["name"];

    // 도서 코드 유효성 검사
    if(empty($bookId)){    
      $bookIdErr  = "도서코드를 입력하세요";
    } else{      
        if(filterBookId($bookId) == FALSE){
            $bookIdErr  = "ISBN과 숫자를 조합하여 5~12자까지 입력하세요";    
        }
    }

    // 도서명 유효성 검사
    if(empty($name)){      
      $nameErr  = "도서명을 입력하세요";
    } else{    
      if(filterName($name) == FALSE){             
          $nameErr  = "최소 4자에서 최대 50자까지 입력하세요"; 
      }
    }

    // 가격 유효성 검사
    if(empty($unitPrice)){       
      $unitPriceErr = "가격을 입력하세요";
    } else{ 
      if(filterPrice($unitPrice) == FALSE){          
        $unitPriceErr =  "숫자만 입력하세요";         
      }
      else if (filterPrice($unitPrice) < 0)   
        $unitPriceErr ="양수를 입력하세요";
      else {      
        if(filterPriceFloat($unitPrice) == FALSE){          
          $unitPriceErr =  "소수점 둘째 자리까지만 입력하세요";         
        }
      }     
    }

    // 재고수 유효성 검사
    if(empty($unitsInStock)){       
      $unitsInStockErr = "재고수를 입력하세요";
    } else{    
        if(filterStock($unitsInStock)== FALSE){        
          $unitsInStockErr =  "숫자만 입력하세요";
        }  
    }

    // 상세 설명 유효성 검사
    if(empty($description)){      
        $descriptionErr = "상세설명을 입력하세요"; 
    } else{    
        if(filterDescription($description) == FALSE){            
            $descriptionErr = "최소 80자이상 입력하세요";
        }
    }  

    // 모든 입력값이 유효한 경우
    if($bookIdErr =="" && $nameErr =="" && $unitPriceErr =="" && $descriptionErr =="" && $unitsInStockErr =="" && $bookImageErr =="") {

      // 이미지 업로드 경로 및 파일 이름 설정
      $target_path = "resources/images/";
      $ext = pathinfo($filename, PATHINFO_EXTENSION); // 파일 확장자 추출
      $filename = $bookId.".".$ext;

      // 이미지 업로드 성공 시
      if(move_uploaded_file($_FILES['bookImage']['tmp_name'], $target_path.$filename)) {      
        $sql = "UPDATE book SET b_name='$name', b_unitPrice=$unitPrice, b_author='$author', 
        b_description='$description',  b_category= '$category', b_unitsInStock='$unitsInStock', 
        b_releaseDate='$releaseDate', b_condition= '$condition', b_fileName= '$filename' 
        WHERE b_id='$bookId'";
      }

      // 이미지 업로드 실패 시
      else{
        $sql = "UPDATE book SET b_name='$name', b_unitPrice=$unitPrice, b_author='$author', 
        b_description='$description',  b_category= '$category', b_unitsInStock='$unitsInStock', 
        b_releaseDate='$releaseDate', b_condition= '$condition' 
        WHERE b_id='$bookId'";
      }        

      // SQL 실행 및 성공 시 리디렉션
      if(mysqli_query($conn, $sql))     
        Header("Location:editBooks.php?edit=update"); // 수정 완료 후 페이지 이동
      
      mysqli_close($conn); // 데이터베이스 연결 종료
    }

    // 오류가 발생하면 updateBook_Error.php 로드
    require "./updateBook_Error.php";
}
?>
