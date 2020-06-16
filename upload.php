<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();

$id=$_SESSION['userid'];

$filename =  date("YmdHis").".jpg";
move_uploaded_file($_FILES['imageform']['tmp_name'], $filename);

$title=$_POST['title'];

$price=$_POST['price'];
$dbLat = $_POST['dbLat'];
$dbLng = $_POST['dbLng'];

// PHP Data Objects(PDO) Sample Code:
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:sv11.database.windows.net,1433; Database = db11", "jaewon", "wodnjs1225!");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "jaewon", "pwd" => "wodnjs1225!", "Database" => "db11", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:sv11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
//$path = $_SERVER['DOCUMENT_ROOT'].'/testBBS/';
//$path = "./";

$tsql= "INSERT INTO product VALUES ('$title','$price','$dbLat','$dbLng')";

$getResults= sqlsrv_query($conn, $tsql);

sqlsrv_free_stmt($getResults);

$connectionInfo = array("UID" => "jaewon", "pwd" => "wodnjs1225!", "Database" => "db11", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:sv11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$tsql2= "INSERT INTO image (filename) VALUES ('$filename')";

$getResults2= sqlsrv_query($conn, $tsql2);

if ($getResults2 == FALSE)
    echo (sqlsrv_errors());

if($tsql2){
    echo "글 작성 완료! <br>\n";
    echo "<a href=./direct.php>back page</a>";
}

sqlsrv_free_stmt($getResults2);
?>