<?php
session_start();
if(isset($_SESSION['korreoa'], $_SESSION['mota'])){
	$korreoa = $_SESSION['korreoa'];
	session_destroy();
	echo "<script>alert('agur')</script>";
} 
else echo"<script>alert('arazoak egon dira sesioarekin')</script>";
echo "<script>location.href='layout.php';</script>";
?>