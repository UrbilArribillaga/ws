<?php
	ini_set("session.use_cookies", 1);
	session_start(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title> Password Recovey </title>
	</head>
	
	<body>
	
	<input id="botoiAtzera" type="button" value="Bueltatu">
		<form id="korreoaSartu" name="korreoaSartu" action="" method="post">
			<h1>Ez duzu pasahitza gogoratzen?</h1>
			<label>Korreoa</label><br/>
			<input id="korreoa" name="korreoa" type="text" oninput="korreoaKonprobatu(this.value)">&nbsp;<label id="korreoEgoera"></label><br/>
			<label>Nick-a</label><br/>
			<input id="nick" name="nick" type="text"><br/><br/>
			<input id="botoiaBidali" type="submit" value="Pasahitza berreskuratu">
		</form><br/>
		<form id="passrecovery" name="passrecovery" action="" method="post">
			<h2>Pasahitz berria sartu</h2>
			<label>Pasahitz berria</label><br/>
			<input id="pasahitz1" name="pasahitz1" type="password" oninput="pasahitzaKonprobatu(this.value)">&nbsp;<label id="pasahitzaEgoera"></label><br/>
			<label>Pasahitza berriz sartu</label><br/>
			<input id="pasahitz2" name="pasahitz2" type="password"><br/><br/>
			<input id="botoiaAldatu" type="submit" value="Pasahitza aldatu">
		</form><br/>
		
	</body>
	<script>
	xhro = new XMLHttpRequest();
	xhro.onreadystatechange = function(){
		if(xhro.readyState==4 && xhro.status==200){
			var emaitza = xhro.responseText;
			if(emaitza=="KEgokia")document.getElementById('korreoEgoera').innerHTML ="korreo egokia";
			else if(emaitza=="KDesegokia")document.getElementById('korreoEgoera').innerHTML ="Korreo hau ez dago web sisteman erregistraturik";
			else if(emaitza=="PEgokia")document.getElementById('pasahitzaEgoera').innerHTML ="Pasahitza egokia";
			else document.getElementById('pasahitzaEgoera').innerHTML ="pasahitza desegokia";	
			
		
		}	
	}
	function korreoaKonprobatu(korreoa){
		xhro.open("POST", "egiaztapena.php", true);
		xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhro.send("korreoa="+korreoa);
	}
	function pasahitzaKonprobatu(pasahitza){
		xhro.open("POST", "egiaztapena.php", true);
		xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhro.send("pasahitza="+pasahitza);
	}
	
	
	$(document).ready(function(){
		$("#korreoaSartu").submit(function(){
			var emailRegex = /^[a-z]{3,}[0-9][0-9][0-9]+@ikasle\.ehu\.(?:eus|es)$/
			var nickRegex = /^[A-Za-z0-9]{1,}$/
			var korr = $("#korreoa").val().match(emailRegex) ==  $("#korreoa").val() 
			var nick = $("#nick").val().match(nickRegex) == $("#nick").val()
			
			var boolean = true
			if(!korr){
               boolean =false
               $("#korreoa").css("background-color", "red")
            }
		    else $("#korreoa").css("background-color", "white")
			
			if(!nick){
               boolean =false
               $("#nick").css("background-color", "red")
            }
		    else $("#nick").css("background-color", "white")

			return boolean;
		});
		
		$("#passrecovery").submit(function(){
			var pass = $.trim($("#pasahitz1").val()).length > 0
			var pass2 = $.trim($("#pasahitz2").val()).length > 0
			var pasahitza = $.trim($("#pasahitz1").val())
			var pasahitza2 = $.trim($("#pasahitz2").val())
			
			var boolean = true			
			if(!pass){
               boolean =false
               $("#pasahitza").css("background-color", "red")
            }
		    else $("#pasahitza2").css("background-color", "white")
			
			if(!pass2){
               boolean =false
               $("#pasahitza2").css("background-color", "red")
            }
		    else $("#pasahitza2").css("background-color", "white")
			
			
			if(pasahitza != pasahitza2){
				boolean = false
				alert("Pasahitzak desberdinak dira")
			}
			return boolean;
		});
			
			
		$("#botoiAtzera").click(function(){
			<?php session_destroy(); ?>
			location.href="logIn.php"
		});
	});
	</script>
</html>
<?php
	
	if (!isset($_SESSION['korreoa'], $_SESSION['mota'])){
		echo '<style type="text/css">
		#passrecovery {
			display: none;
		}
		</style>';
		echo '<style type="text/css">
		#korreoaSartu {
			display: initial;
		}
		</style>';
		if(isset($_POST['korreoa'], $_POST['nick'])){
			$zenb=0;
			include "configure.php";
			global $esteka;
			$korreoa = $_POST['korreoa'];
			$sql = "SELECT * From erabiltzaileak WHERE Korreoa= '$korreoa'"; 
			$result = mysqli_query($esteka, $sql);
			if (mysqli_num_rows($result) > 0){
				$row = mysqli_fetch_assoc($result);
				if(strcmp($row['Nick'],$_POST['nick'])==0){
					$_SESSION['korreoa']= $korreoa;
				}
				else{
					echo('<span style="color: red;">KORREOA ETA NICK-A EZ DATOZ BAT</span>');
				}
			}
			else{
				echo('<span style="color: red;">KORREO OKERRA</span>');
			}
			mysqli_close($esteka);
		}
	}
	if(isset($_SESSION['korreoa'])){
		echo '<style type="text/css">
		#korreoaSartu {
			display: none;
		}
		</style>';
		echo '<style type="text/css">
		#passrecovery {
			display: initial;
		}
		</style>';
		if(isset($_POST['pasahitz1'], $_POST['pasahitz2'])){
			$zenb=1;
			include "configure.php";
			global $esteka;
			$pass=password_hash($_POST['pasahitz1'], PASSWORD_DEFAULT);
			$sql2="UPDATE erabiltzaileak SET Pasahitza='$pass' WHERE Korreoa='$_SESSION[korreoa]'";
			$result2= mysqli_query($esteka, $sql2);
			if($result2){
				session_destroy();
				mysqli_close($esteka);
				echo "<script>alert('Pasahitza ondo aldatu da')</script>";
				echo('<script>location.href="logIn.php"</script>');
			}
			else{
				session_destroy();
				mysqli_close($esteka);
				echo "<script>alert('Erreora pasahitza aldatzerakoan')</script>";
				echo('<script>location.href="logIn.php"</script>');
			}
		}
	}

?>