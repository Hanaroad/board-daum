<?
include 'dbconnect.php';

// 데이터 가져오기
$jsonString = file_get_contents('php://input');

// PHP로 문자열 JSON 데이터로 변환
$obj = json_decode($jsonString);

$sql = "delete from login2 where uid=".$obj->uid;
mysqli_query($conn, $sql) or die(mysqli_error($conn));

$sql = "select * from login2 where uid=".$obj->uid;
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if(mysqli_num_rows($result) > 0) {
    echo '삭제 실패';
}