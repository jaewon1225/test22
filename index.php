<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:market01.database.windows.net,1433; Database = Market", "heesu", "dlvlwk12@");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "heesu", "pwd" => "dlvlwk12@", "Database" => "Market", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:market01.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$tsql= "SELECT id, pw
        FROM member
        WHERE id = 'gmltn6419'";

    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
     echo ($row['id'] . " " . $row['pw'] . PHP_EOL);
     $id = $row['id'];
     $pw = $row['pw'];
    }
    sqlsrv_free_stmt($getResults);
?>

<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <title> SILLA MARKET </title>
</head>
<body>
<form enctype="multipart/form-data" name="form" method="post" action="test.php">
    <table>
    <tr>
        <td>이미지:</td>
        <td><input type="file" name="imageform" /></td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" value="전송" />
        </td>
    </tr>
    </table>
</form>

<form>
    <div align="center" style="width:500px; height:400px; float:center; border:1px; background-color:green">
        <p align="center">
            <strong>아이디</strong>
            <input type="text" name="id" value="<?=$id?>">
        </p>
        
        <p align="center">
            <strong>비밀번호</strong>
            <input type="password" name="pw" value="<?=$pw?>">
        </p>
        
        <p align="center">
            <strong>이름</strong>
            <input type="text" name="name" value="이름 입력">
        </p>
        <p align="center">
        <button type="button" onClick="location.href='test.php'">test</button>
    </div>
</form>
<form>
<?php
$connectionInfo = array("UID" => "heesu", "pwd" => "dlvlwk12@", "Database" => "Market", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:market01.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$tsql2= "SELECT * FROM image";
$getResults1= sqlsrv_query($conn, $tsql2);

echo ("Reading data from table" . PHP_EOL);
if ($getResults1 == FALSE)
    echo (sqlsrv_errors());
while ($row2 = sqlsrv_fetch_array($getResults1, SQLSRV_FETCH_ASSOC)) {
    echo ($row2['filename'] . PHP_EOL);
    //$path = $row2['path'];
    $filename = $row2['filename'];
}
sqlsrv_free_stmt($getResults1);
?>
<td><img src="<?=$filename;?>" /></td>
</form>
</body>
</html>