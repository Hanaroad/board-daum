<?
include"./dbconnect.php";

// 데이터 가져오기
$jsonString = file_get_contents('php://input');

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

// PHP로 문자열을 JSON 형식으로 변환
$obj = json_decode($jsonString);

if($obj -> searchText != '') {
    $sql = "select * from board where content = '".$obj -> searchText."'" ;
} else {
    $sql = "select * from board";
}

$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$recordCnt = mysqli_num_rows($result);
$recordArray = [];

while($t = mysqli_fetch_object($result)) {
    array_push($recordArray, array(
        "idx" => $t -> idx,
        "title" => $t -> title,
        "content" => $t -> content,
        "id" => $t -> id,
        "date" => $t -> date,
    ));
}


$jsonResult = [
    "status" => 200,
    "response" => [
        "total" => $recordCnt,
        "result" => $recordArray
    ]
];

echo json_encode($jsonResult);
?>