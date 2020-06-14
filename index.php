<?php
session_start();
$id = $_SESSION['userid'];
if(!isset($_SESSION['userid'])) // 세션 존재 X
{
    header ('Location: ./login.html');
}
?>

<html>
<head>
<title> SILLA MARKET </title>
</head>
<body>
<div align="center">
<a href=logout.php> Log Out </a>
접속자 ID : <label for="id"> <?=$id?> </label>
<br><br><br><br>
<button style="height:200px;width:200px; font-size: 50px;" onclick="location.href='direct.php'"> 직거래 </button>
<button style="height:200px;width:200px; font-size: 50px;" onclick="location.href='coupon.php'"> 쿠폰 </button>
</div>
</body>
</html>