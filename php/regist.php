<? 
header('Content-Type: text/html; charset = UTF-8');

include "./dbconnect.php";

extract($_POST);
extract($_GET);

// if($name == "") {
//     echo "이름을 입력하세요";
//     exit;
// };

// if($id == "") {
//     echo "id를 입력하세요";
//     exit;
// };

$sql = "select uid from board where id='".$id."'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if($uid > 0) {
    $sql = "select * from board where idx=".$idx;
    $result = mysqli_query($conn, $sql);
    $old = mysqli_fetch_object($result);
}

if($uid != "") {
    $sql = "update board set title='".$title."', content='".$content."', id='".$id."', date='".$date."' where uid=".$uid;
} else {
    // if(mysqli_num_rows($result) > 0) {
    //     echo "이미 등록된 사용자입니다";
    //     exit;
    // }
    $sql = "insert into board (title,content,id,date) values ('$title', '$content', '$id', '$date')";
}

mysqli_query($conn, $sql) or die (mysqli_error($conn));