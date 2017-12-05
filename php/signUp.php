<!DOCTYPE html>
<html>
  <head>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Erregistratu</title>
  </head>
  <body>
		<form id="erregistroF" name="erregistroF" action="" method="post">
			<label>Korreoa</label><input id="korreoa" name="korreoa" type="text" oninput="korreoaKonprobatu(this.value)">&nbsp;<label id="korreoEgoera"></label><br/><br/>
			<label >Deitura</label> <input id ="deitura" name="deitura" type="text" ><br/><br/>
			<label>Nick </label><input id="nick" name="nick" type="text" ><br/><br/>
			<label>Pasahitza</label><input id="pasahitza" name="pasahitza" type="password" oninput="pasahitzaKonprobatu(this.value)">&nbsp;<label id="pasahitzaEgoera"></label><br/><br/>
			<label>Pasahitza errepikatu</label><input id="pasahitza2" name="pasahitza2" type="password" ><br/><br/>
			<input id="botoiErregistroa" type="submit" name="botoiErregistroa"value="Erregistratu">
			<input id="botoiAtera" type="button" name="botoiAtera"value="Atzera"></br></br>
		</form>
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
		$("form").submit(function(){
			var emailRegex = /^[a-z]{3,}[0-9][0-9][0-9]+@ikasle\.ehu\.(?:eus|es)$/
			var deiRegex = /^[A-Z][a-z]{1,}[\s][A-Z][a-z]{1,}$/
			var nickRegex = /^[A-Za-z0-9]{1,}$/
			var korr = $("#korreoa").val().match(emailRegex) ==  $("#korreoa").val() 
			var dei = $("#deitura").val().match(deiRegex) == $("#deitura").val()
			var nick = $("#nick").val().match(nickRegex) == $("#nick").val()
			var pass = $.trim($("#pasahitza").val()).length > 0
			var pass2 = $.trim($("#pasahitza2").val()).length > 0
			var pasahitza = $.trim($("#pasahitza").val())
			var pasahitza2 = $.trim($("#pasahitza2").val())
			
			var boolean = true
			if(!korr){
               boolean =false
               $("#korreoa").css("background-color", "red")
            }
		    else $("#korreoa").css("background-color", "white")
			
			if(!dei){
               boolean =false
               $("#deitura").css("background-color", "red")
            }
		    else $("#deitura").css("background-color", "white")
			
			if(!nick){
               boolean =false
               $("#nick").css("background-color", "red")
            }
		    else $("#nick").css("background-color", "white")
			
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
			if($("#korreoEgoera").val()=="Korreo hau ez dago web sisteman erregistraturik")boolean = false;
			if($("#pasahitzaEgoera").val()=="pasahitza desegokia")boolean = false;
			return boolean;
  		});
		$("#botoiAtera").click(function(){
			location.href="layout.php"
		});
    });
</script>
</html>

<?php
 
if(isset($_POST['korreoa'], $_POST['deitura'], $_POST['nick'], $_POST['pasahitza'], $_POST['pasahitza2'])){
	$zenb=1;
	include "configure.php";
	global $esteka;
	$sql = "SELECT * FROM erabiltzaileak";
	$ema = mysqli_query($esteka, $sql);
	if (!$ema){
		echo("Errorea datuak sartzerakoan: ". mysqli_error($esteka));
	} 
		$aurkitua = False;
			while($row = mysqli_fetch_assoc($ema)){
				if($row['Korreoa'] == $_POST['korreoa']){
					$aurkitua = True;	
				}
			}
			if(!$aurkitua){
				$passkrip = password_hash($_POST['pasahitza'], PASSWORD_DEFAULT);
				$sql = "INSERT INTO erabiltzaileak VALUES(DEFAULT, '$_POST[korreoa]' , '$_POST[deitura]' , '$_POST[nick]' , '$passkrip')";
				$ema = mysqli_query($esteka, $sql);
				if (!$ema){
					echo("Errorea datuak sartzerakoan: ". mysqli_error($esteka));
				}
				else{
					$sql = "SELECT * FROM erabiltzaileak WHERE korreoa='$_POST[korreoa]'";
					$ema = mysqli_query($esteka, $sql);
					if (!$ema){
						echo("Errorea datuak sartzerakoan 1: ". mysqli_error($esteka));
					}
					else{
						$row = mysqli_fetch_assoc($ema);
						if(password_verify($_POST['pasahitza'], $row['Pasahitza'])){
							echo('<script>location.href="logIn.php"</script>');
							exit();
						}
						else echo('<span style="color: red;">ERROREA PASAHITZA LORTZEAN</span></br>');
					}
				}
			}
			else{
				echo('<span style="color: red;">KORREOA JADA EXISTITZEN DA</span></br>');
			}
			mysqli_close($esteka);
}	
?>