<?php
header("Content-Type: text/html; charset=UTF-8");
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

//filename 배열
$tsql= "SELECT filename FROM image";
$getResults= sqlsrv_query($conn, $tsql);

//echo ("Reading data from table" . PHP_EOL);
if ($getResults == FALSE)
    echo (sqlsrv_errors());

$theVariable = [];  

while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {    
    $theVariable[] = $row['filename']; 
}

sqlsrv_free_stmt($getResults);

//lat 배열
$connectionInfo = array("UID" => "jaewon", "pwd" => "wodnjs1225!", "Database" => "db11", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:sv11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
$tsql2= "SELECT Lat FROM product";
$getResults2= sqlsrv_query($conn, $tsql2);

$theVariable2 = [];

//echo ("Reading data from table" . PHP_EOL);
if ($getResults2 == FALSE)
    echo (sqlsrv_errors());

while ($row2 = sqlsrv_fetch_array($getResults2, SQLSRV_FETCH_ASSOC)) {
    $theVariable2[] = $row2['Lat'];
}

sqlsrv_free_stmt($getResults2);

//lng 배열
$connectionInfo = array("UID" => "jaewon", "pwd" => "wodnjs1225!", "Database" => "db11", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:sv11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$tsql3= "SELECT Lng FROM product";
$getResults3= sqlsrv_query($conn, $tsql3);

$theVariable3 = [];

//echo ("Reading data from table" . PHP_EOL);
if ($getResults3 == FALSE)
    echo (sqlsrv_errors());

while ($row3 = sqlsrv_fetch_array($getResults3, SQLSRV_FETCH_ASSOC)) {
    $theVariable3[] =$row3['Lng'];
}

sqlsrv_free_stmt($getResults3);

//title 
$connectionInfo = array("UID" => "jaewon", "pwd" => "wodnjs1225!", "Database" => "db11", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:sv11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$tsql4= "SELECT title FROM product";
$getResults4= sqlsrv_query($conn, $tsql4);

$theVariable4 = [];

//echo ("Reading data from table" . PHP_EOL);
if ($getResults4 == FALSE)
    echo (sqlsrv_errors());

while ($row4 = sqlsrv_fetch_array($getResults4, SQLSRV_FETCH_ASSOC)) {
    $theVariable4[] = $row4['title'];
}

sqlsrv_free_stmt($getResults4);

//price
$connectionInfo = array("UID" => "jaewon", "pwd" => "wodnjs1225!", "Database" => "db11", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:sv11.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

$$tsql5= "SELECT price FROM product";
$getResults5= sqlsrv_query($conn, $tsql5);

$theVariable5 = [];

//echo ("Reading data from table" . PHP_EOL);
if ($getResults5 == FALSE)
    echo (sqlsrv_errors());

while ($row4 = sqlsrv_fetch_array($getResults5, SQLSRV_FETCH_ASSOC)) {
    $theVariable4[] = $row4['title'];
}

sqlsrv_free_stmt($getResults5);

?>

<html>
<head>
    <title> 직거래 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=	8c03ca589ff35989a8974da028de5137"></script>
    
</head>
<body>
<form>
<div align='center' id="map" style="width:50%;height:350px;"></div>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(35.16825697799745, 128.99625354800833), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

var positions1 = new Array("<?=implode("\",\"" , $theVariable2);?>");
var positions2 = new Array("<?=implode("\",\"" , $theVariable3);?>");
var imageSrc = new Array("<?=implode("\",\"" , $theVariable);?>");
var title = new Array("<?=implode("\",\"" , $theVariable4);?>");
var price = new Array("<?=implode("\",\"" , $theVariable5);?>");

for (var i = 0; i < positions1.length; i ++) {   
    // 마커 이미지의 이미지 크기 입니다
    var imageSize = new kakao.maps.Size(100, 60); 
    
    // 마커 이미지를 생성합니다    
    var markerImage = new kakao.maps.MarkerImage(imageSrc[i], imageSize); 
    
    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: new kakao.maps.LatLng(positions1[i], positions2[i]),// 마커를 표시할 위치
        image : markerImage // 마커 이미지 
    });

    // 인포윈도우를 생성합니다
    var infowindow = new kakao.maps.InfoWindow({
        content: '<div> 제목 : '+title[i]+'</br> 가격 : ' + price[i] +'</div>' ,
        removable : true
    });

    kakao.maps.event.addListener(marker, 'click', click(map,marker,infowindow));

}
    function click(map, marker, infowindow) {
        // 마커 위에 인포윈도우를 표시합니다
        return function(){
            infowindow.open(map, marker);
        }
    }

</script>
</form>
<button style="height:100px; width:100px; font-size: 25px;" onclick="location.href='./write.php'"> 글 작성 </button>
<button style="height:100px; width:100px; font-size: 20px;" onclick="location.href='./index.php'"> 메인화면 </button>
</body>
</html>