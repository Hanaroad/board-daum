<? 
header('Content-Type: text/html; charset = UTF-8');

include "dbconnect.php";

extract($_POST);
extract($_GET);

if($name == "") {
    echo "이름을 입력하세요";
    exit;
};

if($id == "") {
    echo "id를 입력하세요";
    exit;
};

$sql = "select uid from login2 where id='".$id."'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if($uid > 0) {
    $sql = "select * from login2 where uid=".$uid;
    $result = mysqli_query($conn, $sql);
    $old = mysqli_fetch_object($result);
}

if($uid != "") {
    $sql = "update login2 set name='".$name."', id='".$id."', password='".$password."' where uid=".$uid;
} else {
    if(mysqli_num_rows($result) > 0) {
        echo "이미 등록된 사용자입니다";
        exit;
    }
    $sql = "insert into login2 (name,id,password) values ('$name', '$id', '$password')";
}

mysqli_query($conn, $sql) or die (mysqli_error($conn));